<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Asset\AssetFilesCollection;
use App\Generator\Algorithm\SimpleTileBuilder;


try{

    $assetsCollection = new AssetFilesCollection('Assets\Rivers_2\\', 'png');
    $assets = $assetsCollection->getAssets();

//    $firstAsset = $assets[0];
//    debug($assets);
//    debug($firstAsset->getWidth());


//    $asset = new App\Asset\Asset('Assets' . DIRECTORY_SEPARATOR . "EMP.png","EMP.png","png");
//    var_dump($asset->getType());
//    debug($asset->getLeftSide());
//    debug($asset);


    $mapBuilder = new SimpleTileBuilder($assets, 10, 10);
    $mapBuilder->build();
    $map = $mapBuilder->getMap();

//    $mapArray = $map->getArray();
//    debug($mapArray);

}catch (Exception $e){
    debug($e->getMessage());
}





//$callStartTime = microtime(true);
//
//$callEndTime = microtime(true);
//$callTime = $callEndTime - $callStartTime;
//messInfo($callTime);
