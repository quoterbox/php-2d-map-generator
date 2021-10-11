<?php
require "Lib/Lib.php";
require "LocationGenerator/TilesSpawner.php";

use LocationGenerator\TilesSpawner;

$AssetPack = "Rivers_2";
$assetPath = "Assets" . DIRECTORY_SEPARATOR . $AssetPack. DIRECTORY_SEPARATOR;
$filesExt = "png";
$xSize = 10;
$ySize = 10;


$TileRotator = new TileRotator();
$TileRotator->rotateAssets($assetPath, $saveFolder);



$AssetSystem = new AssetSystem();

$files = $AssetSystem->readFiles($filePath) : array;
$AssetSystem->saveInFile($fileFromPath, $fileDestPath, $fileDestExt = 'png') : string;
$AssetSystem->saveFileInTiles($fileFromPath, $fileDestPath, $fileDestExt = 'png') : string;
$AssetSystem->detectFileExt($filePath) : string;
$tile = $AssetSystem->getFileInfo($filePath) : array;



$tiles = [
    [
        'name' => 'tile1',
        'path' => 'Assets\Rivers_2\1_0_G_G_G_R.png',
        'name_ext' => '1_0_G_G_G_R.png',
        'ext' => 'png',
        'type' => '1',
        'top' => 'G',
        'right' => 'G',
        'bottom' => 'G',
        'left' => 'R',
        'width' => 100,
        'height' => 100,
        'xTile' => 0,
        'yTile' => 0
    ],
    [
        'name' => 'tile2',
        'path' => 'Assets\Rivers_2\1_0_G_G_R_G.png',
        'name_ext' => '1_0_G_G_R_G.png',
        'ext' => 'png',
        'type' => '1',
        'top' => 'G',
        'right' => 'G',
        'bottom' => 'R',
        'left' => 'G',
        'width' => 100,
        'height' => 100,
        'xTile' => 0,
        'yTile' => 1
    ]
];
new Map($tiles);



SpawnerAlgorithm $algo = new WFC2D($tiles, $xSize, $ySize, $map);
$map = $algo->buildMap();

$algo->setStartCoords();
$algo->setStartCoords();
$algo->setFirstTile();
$algo->getNeighborTiles();
$algo->getFitTile();



$TilesSpawner = new TilesSpawner($assetPath, $filesExt, $xSize, $ySize);


// Private
$TilesSpawner->loadTiles($assetsPath);
$TilesSpawner->generateMap($tiles, $xSize, $ySize, $algo);



// Public
$TilesSpawner->setAlgorithm("WFC2D");
$TilesSpawner->setMap($map) : void;
$TilesSpawner->getMap() : array;
$TilesSpawner->setStartTile($assetName) : void;
$TilesSpawner->setStartCell($x, $y) : void;
$TilesSpawner->setCell($assetName, $x, $y) : void;
$TilesSpawner->saveInFile($path, $format) : string;
$TilesSpawner->buildLocation();
