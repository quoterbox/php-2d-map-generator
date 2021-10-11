<?php
require "Lib/Lib.php";
require "LocationGenerator/TilesSpawner.php";

use LocationGenerator\TilesSpawner;

$AssetPack = "Rivers_2";
$assetPath = "Assets" . DIRECTORY_SEPARATOR . $AssetPack. DIRECTORY_SEPARATOR;
$filesExt = "png";
$xSize = 10;
$ySize = 10;


Helper\Asset::TileRotate($assetPath);




$TilesSpawner = new TilesSpawner($assetPath, $filesExt, $xSize, $ySize);

$TilesSpawner->buildLocation();
$TilesSpawner->saveInFile("Saved/", "png");
$map = $TilesSpawner->getMapArray();


$TilesSpawner->getMapArray();
$TilesSpawner->setStartTile($assetName);
$TilesSpawner->setStartCell($x, $y);
$TilesSpawner->setCell($assetName, $x, $y);
$TilesSpawner->saveInFile($path, $format);
$TilesSpawner->buildLocation();
SpawnerAlgorithm $algo = new WFC2D();
$TilesSpawner->setAlgorithm($algo);

