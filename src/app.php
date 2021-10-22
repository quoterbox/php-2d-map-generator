<?php
$callStartTime = microtime(true);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Asset\AssetFilesCollection;
use App\Generator\Algorithm\SimpleTileBuilder;
use App\MapSaver\MapSaver;

try{

    $assetsCollection = new AssetFilesCollection('Assets\Angles\\', 'png');
    $assets = $assetsCollection->getAssets();

    $mapBuilder = new SimpleTileBuilder($assets, 5, 5);
    $mapBuilder->build();
    $map = $mapBuilder->getMap();

    $mapSaver = new MapSaver($map);
    $mapSaver->saveToFile('Saved\FromImageSaver\FullMap2\\', 'png', 'MyMap2');
    $mapSaver->saveToFile('Saved\FromImageSaver\FullMap2\\', 'png');
    $mapSaver->saveToFile('Saved\FromImageSaver\FullMap2\\', 'jpg');
    $mapSaver->saveToFile('Saved\FromImageSaver\FullMap2\\', 'webp');
    $mapSaver->saveToFile('Saved\FromImageSaver\FullMap2\\', 'gif');
    $mapSaver->saveToManyFiles('Saved\FromImageSaver\TilesMap2\\', 'png');

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
