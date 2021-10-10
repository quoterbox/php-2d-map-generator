<?php
$callStartTime = microtime(true);

require "Lib/Lib.php";
require "LocationGenerator/TilesSpawner.php";

use LocationGenerator\TilesSpawner;

//$AssetPack = "RiverPath";
//$AssetPack = "Angles";
//$AssetPack = "Angles_2";
//$AssetPack = "Rivers";
$AssetPack = "Rivers_2";

$assetPath = "Assets" . DIRECTORY_SEPARATOR . $AssetPack. DIRECTORY_SEPARATOR;
$filesExt = "png";

// 50 tiles * 200x * 200y ~ 3 seconds / 50 tiles * 10x * 10y ~ 0.05 seconds
$xSize = 10;
$ySize = 10;


// new TileRotator($assetPath);

// Template Tile Name XX_XX_XX_XX_XX_XX or XX_XX_XX if second XX = 1
$TilesSpawner = new TilesSpawner($assetPath, $filesExt, $xSize, $ySize);

$TilesSpawner->buildLocation();
$TilesSpawner->saveInFile("Saved/", "png");
$map = $TilesSpawner->getMapArray();


//
// API
//
// $TilesSpawner->getMapArray();
// $TilesSpawner->setStartTile($assetName);
// $TilesSpawner->setStartCell($x, $y);
// $TilesSpawner->setCell($assetName, $x, $y);
// $TilesSpawner->saveInFile($path, $format);
// $TilesSpawner->buildLocation();
// SpawnerAlgorithm $algo = new WFC2D();
// $TilesSpawner->setAlgorithm($algo);
//
//
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php for($x = 0; $x < $xSize; $x++):?>
        <?php for($y = 0; $y < $ySize; $y++):?>
            <?php if(!empty($map[$x][$y]['path'])):?>
                <img src="<?=$map[$x][$y]['path']?>" alt="<?=$map[$x][$y]['name']?>">
            <?php else:?>
                <img src="<?="Assets" . DIRECTORY_SEPARATOR . 'empty.' . $filesExt?>" alt="empty">
            <?php endif?>
        <?php endfor;?>
        <br>
    <?php endfor;?>

    <?php
    $callEndTime = microtime(true);
    $callTime = $callEndTime - $callStartTime;
    messInfo($callTime);
//    messInfo($map);
    ?>
</body>
</html>


