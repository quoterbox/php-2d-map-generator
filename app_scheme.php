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




interface AssetInterface
{
    public function getAssets();
    public function loadAssets();
}


class AssetFilesCollection implements AssetInterface
{
    private $assets = [];
    private $assetFiles = [];
    private $assetsPath;
    private $assetsExt;

    public function __construct(string $assetsPath, string $assetsExt)
    {
        $this->assetsPath = $assetsPath;
        $this->assetsExt = $assetsExt;
    }

    public function getAssets() : array {return $this->assets;}

    public function loadAssets() : void
    {
        foreach ($files as &$file){

            $file = $this->getFileInfo($file);
        }

        return [];
    }

    private function getFileInfo(string $assetName) : array {return [];}
}


class Asset
{
    private string $assetPath;
    private string $assetName;
    private string $assetNameExt;
    private string $assetExt;

    public function __construct(string $assetPath, string $assetName, string $assetNameExt, string $assetExt)
    {
        $this->assetPath = $assetPath;
        $this->assetName = $assetName;
        $this->assetNameExt = $assetNameExt;
        $this->assetExt = $assetExt;
    }

    public function getPath() : string
    {
        return $this->assetPath;
    }

    public function getName() : string
    {
        return $this->assetName;
    }

    public function getNameExt() : string
    {
        return $this->assetNameExt;
    }

    public function getExt() : string
    {
        return $this->assetExt;
    }
}

class Spawner
{
    private $map;
    private $algorithm;

    public function __construct(Map $map, string $algorithm){}
    public function saveToFile(string $destPath, string $destFileExt){}
    public function saveToSeparateFiles(string $destFolder, string $destFilesExt){}
}


class Map
{
    private $assetsPath;
    private $xSize;
    private $ySize;

    public function __construct(AssetFilesCollection $assetsCollection, int $xSize, int $ySize){}

    public function build(MapBuilder $builder) : void
    {
        $builder->buildMap();

    }

    public function loadMapFromArray(array $map){}
    public function addTile(){}

    private function getNeighborTiles(Tile $tile) : array {return [];}
}

class Tile
{
    private $width = 100;
    private $height = 100;
    private $xCoord = 0;
    private $yCoord = 0;

    private AssetInterface $asset;
    private $type;
    private $topSide;
    private $rightSide;
    private $bottomSide;
    private $leftSide;

    public function __construct(string $assetPath, int $xSize, int $ySize){}
}



abstract class MapBuilder
{
    abstract public function buildMap();
    abstract public function addTile();
    abstract public function getMap();
}

class WFCMapBuilder extends MapBuilder
{
    private

    public function buildMap(){}
    public function addTile(){}
    public function getMap(){}
}



$WFCMapBuilder = new WFCMapBuilder();


$assetsCollection = new AssetFilesCollection('Assets\Pack\\', 'png');
$assetsCollection->loadAssets();
//$assetsCollection->rotateAssets();


$map = new Map($assetsCollection, 10, 10);
$map->build($WFCMapBuilder);
$map->loadFromArray();
$map->saveToFile();
$map->saveToManyFiles();
$map->getArray();
















//abstract class MapBuilder
//{
//    abstract public function buildMap();
//    abstract public function addTile();
//    abstract public function getMap();
//}
//
//class WFCMapBuilder extends MapBuilder
//{
//    public function buildMap(){}
//    public function addTile(){}
//    public function getMap(){}
//}

//MapBuilder $mapBuilder = MapBuilder();
//MapBuilder $wfcMapBuilder = new WFCMapBuilder();
//
//$TilesSpawner = new TilesSpawner($wfcMapBuilder);
//$map = $wfcMapBuilder->getMap();



































