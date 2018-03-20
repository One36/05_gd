<?php
$src = 'source/3.jpg';
$imgInfo = getimagesize($src);
$srcWidth = $imgInfo[0];
$srcHeight = $imgInfo[1];

$srcImg = imagecreatefromjpeg($src);

// gleiche Breite (alle Images)
/*
 *  2100 Höhe
 *  2800 Breite
 * 
 *  2800   $dstWidth (200)
 *  ---- = ---
 *  2100    $dstHeight 
 *  
 * 
 *  $dstWidth = 200;
 *  $dstHeight = 2100*200/2800
 *  $dstHeight = $srcHeight * $dstWidth / $srcWidth;
 *  $dstHeight = 2100 * 200 / 1000
 */

    $dstWidth = 200;
    $dstHeight = intval($srcHeight * $dstWidth / $srcWidth);

    $pInfo = pathinfo ($src);
    $dstFilename = $pInfo['filename'];
    $dstExtension = $pInfo['extension'];
    
    $dstPath = './dest/' . $dstFilename . '_' . $dstWidth . 'x' . $dstHeight . '.' . $dstExtension;
    $dstPathRetina = './dest/' . $dstFilename . '_' . $dstWidth . 'x' . $dstHeight . '@2x' . '.' . $dstExtension;
    
    
    $dstImg = imagecreatetruecolor($dstWidth, $dstHeight);
    imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $dstWidth, $dstHeight, $srcWidth, $srcHeight);
    imagejpeg($dstImg, $dstPath);
    
    $dstImgRetina = imagecreatetruecolor($dstWidth * 2, $dstHeight * 2);
    imagecopyresampled($dstImgRetina, $srcImg, 0, 0, 0, 0, $dstWidth*2, $dstHeight*2, $srcWidth, $srcHeight);
    imagejpeg($dstImgRetina, $dstPathRetina);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP - 05 GD</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/styles.css" rel="stylesheet" type="text/css"/>
        <script src="assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <h1>PHP - GD Image Manipulation</h1>
        <div class="container">
            <img class="rounded" src="<?php echo $dstImg ?>">
        </div>

        <hr>
        <pre>
            <?php
//            var_dump($pInfo);
            ?>
        </pre>
    </body>
</html>
