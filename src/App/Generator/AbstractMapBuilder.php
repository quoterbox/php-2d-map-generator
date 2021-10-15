<?php

namespace App\Generator;

use App\Map\Map;

abstract class AbstractMapBuilder
{
    protected Map $map;
    protected array $assets;
    protected int $xSize;
    protected int $ySize;

    public function __construct(array $assets, int $xSize, $ySize)
    {
        $this->assets = $assets;
        $this->xSize = $xSize;
        $this->ySize = $ySize;
        $this->map = $this->createMap($xSize, $ySize);
    }

    abstract public function build() : void;

    public function getMap() : Map
    {
        return $this->map;
    }

    protected function createMap(int $xSize, int $ySize) : Map
    {
        return new Map($this->xSize, $this->ySize);
    }
}
