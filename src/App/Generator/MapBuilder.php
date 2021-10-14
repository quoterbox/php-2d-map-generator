<?php

namespace App\Generator;

use App\Asset\AssetInterface;
use App\Map\Map;

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
