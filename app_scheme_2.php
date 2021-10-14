<?php

class Map
{
    private $widthPixels;
    private $heightPixels;
    private $widthTiles;
    private $heightTiles;

    public function load(){}
    public function saveToFile(){}
    public function saveToManyFiles(){}
    public function getArray(){}
    public function getTile(){}
    public function getWidthInTiles(){}
    public function getHeightInTiles(){}
    public function getWidthInPixels(){}
    public function getHeightInPixels(){}
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
    private Map $map;
    private AssetInterface $assets;
    private int $xSize;
    private int $ySize;

    public function __construct(AssetInterface $assets, int $xSize, $ySize)
    {
        $this->assets = $assets;
        $this->xSize = $xSize;
        $this->ySize = $ySize;
    }

    public function build() :void {}
    public function getMap() : Map{return $this->map;}
}


class WFCMapBuilder extends MapBuilder
{
    public function __construct(AssetInterface $assets, int $xSize, $ySize)
    {
        parent::__construct($assets, $xSize, $ySize);
    }

    public function build() : void {}
}

$assetsCollection = new AssetFilesCollection('Assets\Pack\\', 'png');
$assetsCollection->loadAssets();

$mapBuilder = new WFCMapBuilder($assetsCollection, 10, 10);

$mapBuilder->build();

$map = $mapBuilder->getMap();


























