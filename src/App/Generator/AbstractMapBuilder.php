<?php

namespace App\Generator;

use App\Map\Map;

abstract class AbstractMapBuilder
{
    /**
     * @var Map
     */
    protected Map $map;
    /**
     * @var array
     */
    protected array $assets;
    /**
     * @var int
     */
    protected int $xSize;
    /**
     * @var int
     */
    protected int $ySize;

    /**
     * @param array $assets
     * @param int $xSize
     * @param $ySize
     */
    public function __construct(array $assets, int $xSize, $ySize)
    {
        $this->assets = $assets;
        $this->xSize = $xSize;
        $this->ySize = $ySize;
        $this->map = $this->createMap($xSize, $ySize);
    }

    abstract public function build() : void;

    /**
     * @return Map
     */
    public function getMap() : Map
    {
        return $this->map;
    }

    /**
     * @param int $xSize
     * @param int $ySize
     * @return Map
     * @throws \Exception
     */
    protected function createMap(int $xSize, int $ySize) : Map
    {
        return new Map($this->xSize, $this->ySize);
    }
}
