<?php
$callStartTime = microtime(true);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/backend/route.php';

use App\Asset\AssetFolder;
use App\Asset\AssetFilesCollection;
use App\Generator\Algorithm\SimpleTileBuilder;
use App\MapSaver\MapSaver;

try{

    $assetFolders = new AssetFolder('assets\TestFolders\\');
    $foldersList = $assetFolders->getFolderList();

    $assetsCollection = new AssetFilesCollection('assets\Tiles\Angles\\', 'png');
//    $assetsCollection = new AssetFilesCollection('assets\Tiles\Angles\\');
    $assets = $assetsCollection->getAssets();

    messInfo($assets);
    debug($foldersList);

    $mapBuilder = new SimpleTileBuilder($assets, 5, 5);
    $mapBuilder->build();
    $map = $mapBuilder->getMap();

    $mapSaver = new MapSaver($map);
    $mapSaver->saveToFile('saved\FromImageSaver\FullMap2\\', 'png', 'MyMap2');
    $mapSaver->saveToFile('saved\FromImageSaver\FullMap2\\', 'png');
    $mapSaver->saveToFile('saved\FromImageSaver\FullMap2\\', 'jpg');
    $mapSaver->saveToFile('saved\FromImageSaver\FullMap2\\', 'webp');
    $mapSaver->saveToFile('saved\FromImageSaver\FullMap2\\', 'gif');
    $mapSaver->saveToManyFiles('saved\FromImageSaver\TilesMap2\\', 'png');

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
