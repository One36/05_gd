<?php
define('PATH_THUMBS', './dest/');

/**
 * Dreisatzberechnung
 * gibt gesuchten Wert zurück
 * 
 * @param float $x1 - Erster Wert (z.B. Breite)
 * @param float $y1 - Zweiter Wert (z.B. Höhe)
 * @param float $x2 - Dritter Wert (z.B. neue Breite)
 * @return float (z.B. neue Höhe)
 */
function calcDimension($x1, $y1, $x2) {

    return $y1 * $x2 / $x1;
}

function getRandName($prefix = '') {
    return str_replace('.', '_', uniqid($prefix, true));
}

// Quellbild wird als Objekt zurückgegeben
function getGdImage($path) {

    $info = getimagesize($path);
    $img = false;
    switch ($info[2]) {
        case 1:
            $img = imagecreatefromgif($path);
            break;
        case 2:
            $img = imagecreatefromjpeg($path);
            break;
        case 3:
            $img = imagecreatefrompng($path);
            break;
        default:
            $img = false;
            break;
    }
    return $img;
}

function createResample($srcImg, $srcWidth, $srcHeight, $dstWidth, $dstHeight, $filetype, $path, $filename) {
    $dstPath = false;
    $dstImg = imagecreatetruecolor($dstWidth, $dstHeight);
    imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $dstWidth, $dstHeight, $srcWidth, $srcHeight);

    if ($filetype === 2) {

        $dstPath = $path . $filename . '.jpeg';
        imagejpeg($dstImg, $dstPath);
    } elseif ($filetype === 3) {
        $dstPath = $path . $filename . '.png';
        imagepng($dstImg, $dstPath);
    } else {
        return false;
    }
    return $dstPath;
}

$src = './source/1.jpg';
$srcImg = getGdImage($src);
$name = getRandName();
$info = getimagesize($src);
$dstWidth = 100;
$dstHeight = intval(calcDimension($info[0], $info[1], $dstWidth));
$newImage = createResample($srcImg, $info[0], $info[1], $dstWidth, $dstHeight, IMAGETYPE_JPEG, PATH_THUMBS, $name);


//var_dump($newImage);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP - 05 GD Create Thumbs</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/styles.css" rel="stylesheet" type="text/css"/>
        <script src="assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <h1>PHP - GD Create Thumbs</h1>
        <div class="container">
            <!--<img class="rounded" src="<?php echo $image ?>">-->
        </div>

        <hr>
        <pre>
            <?php
//            var_dump($pInfo);
            ?>
        </pre>
    </body>
</html>
