<?php
$callStartTime = microtime(true);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Asset\AssetFilesCollection;
use App\Generator\Algorithm\SimpleTileBuilder;

try{

    $assetsCollection = new AssetFilesCollection('Assets\Angles_2\\', 'png');
    $assets = $assetsCollection->getAssets();

    $mapBuilder = new SimpleTileBuilder($assets, 10, 10);
    $mapBuilder->build();
    $map = $mapBuilder->getMap();

    for($x = 0; $x < $map->getWidthInTiles(); $x++){
        for($y = 0; $y < $map->getHeightInTiles(); $y++){
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
