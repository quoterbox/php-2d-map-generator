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


class AssetsCollection
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

    public function loadFilesFromFolder() : void
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
    private $assetPath;
    private $assetName;
    private $assetNameExt;
    private $assetExt;


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

    public function __construct(AssetsCollection $assetsCollection, int $xSize, int $ySize){}
//    public function __construct(string $assetsPath, int $xSize, int $ySize){}
    public function build() : void {}

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

//    private $assetPath;
//    private $assetName;
//    private $assetNameExt;
//    private $assetExt;

    private $type;
    private $topSide;
    private $rightSide;
    private $bottomSide;
    private $leftSide;

    public function __construct(string $assetPath, int $xSize, int $ySize){}
}



$assetsPath = 'Assets\Pack\\';
$assetsExt = 'png';

$assetsCollection = new AssetsCollection($assetsPath, $assetsExt);
$assetsCollection->loadFilesFromFolder();



$xSize = 10;
$ySize = 10;

$map = new Map($assetsCollection, $xSize, $ySize);

$map->build();





abstract class MapBuilder
{
    abstract public function buildMap();
    abstract public function addTile();
    abstract public function getMap();
}

class WFCMapBuilder extends MapBuilder
{
    public function buildMap()
    {
        // TODO: Implement buildMap() method.
    }

    public function addTile()
    {
        // TODO: Implement addTile() method.
    }

    public function getMap()
    {
        // TODO: Implement getMap() method.
    }
}

MapBuilder $mapBuilder = MapBuilder();

MapBuilder $wfcMapBuilder = new WFCMapBuilder();








































