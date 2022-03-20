<?php
$callStartTime = microtime(true);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/backend/route.php';

use App\Asset\AssetsCollection;
use App\Asset\AssetFolderCollection;
use App\Generator\Algorithm\SimpleTileBuilder;
use App\MapSaver\MapSaver;

try{

    $assetFolderCollection = new AssetFolderCollection('assets\Tiles\\');
    $assetsFolders = $assetFolderCollection->getAssetsFolders();

    $oneFolder = $assetsFolders[0];

//    $assetsCollection = new AssetsCollection('assets\Tiles\Angles\\', 'png');
//    $assetsCollection = new AssetsCollection('assets\Tiles\Angles\\');
    $assetsCollection = new AssetsCollection($oneFolder->getPath(), 'png');
    $assets = $assetsCollection->getAssets();

    $mapBuilder = new SimpleTileBuilder($assets, 5, 5);
    $mapBuilder->build();
    $map = $mapBuilder->getMap();

    $mapSaver = new MapSaver($map);
    $mapSaver->saveToFile('saved\FromImageSaver\FullMap3\\', 'png', 'MyMap2');
    $mapSaver->saveToFile('saved\FromImageSaver\FullMap3\\', 'png');
    $mapSaver->saveToFile('saved\FromImageSaver\FullMap3\\', 'jpg');
    $mapSaver->saveToFile('saved\FromImageSaver\FullMap3\\', 'webp');
    $mapSaver->saveToFile('saved\FromImageSaver\FullMap3\\', 'gif');
    $mapSaver->saveToManyFiles('saved\FromImageSaver\TilesMap3\\', 'png');

    for($y = 0; $y < $map->getHeightInTiles(); $y++){
        for($x = 0; $x < $map->getWidthInTiles(); $x++){
            echo "<img src=" . $map->getTile($x, $y)->getAsset()->getPath() . " alt=" . $map->getTile($x, $y)->getAsset()->getName() . ">";
        }
        echo "<br>";
    }

}catch (Exception $e){
    debug($e->getMessage());
}


$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
messInfo("Generation time: " . $callTime . " sec");
