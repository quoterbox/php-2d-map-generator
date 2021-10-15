<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Asset\AssetFilesCollection;
use App\Generator\Algorithm\SimpleTileBuilder;


try{

    $assetsCollection = new AssetFilesCollection('Assets\Rivers_2\\', 'png');
    $assets = $assetsCollection->getAssets();

    $firstAsset = $assets[0];
    debug($firstAsset->getWidth());

    $mapBuilder = new SimpleTileBuilder($assets, 10, 10);
    $mapBuilder->build();
    $map = $mapBuilder->getMap();

}catch (Exception $e){
    debug($e->getMessage());
}





//$callStartTime = microtime(true);
//
//$callEndTime = microtime(true);
//$callTime = $callEndTime - $callStartTime;
//messInfo($callTime);
