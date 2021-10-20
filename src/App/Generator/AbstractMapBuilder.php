<?php

namespace App\Generator;

use App\Map\MapInterface;
use App\Map\Map;

abstract class AbstractMapBuilder
{
    /**
     * @var MapInterface
     */
    protected MapInterface $map;
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
     * @return MapInterface
     */
    public function getMap() : MapInterface
    {
        return $this->map;
    }

    /**
     * @param int $xSize
     * @param int $ySize
     * @return MapInterface
     * @throws \Exception
     */
    protected function createMap(int $xSize, int $ySize) : MapInterface
    {
        return new Map($xSize, $ySize);
    }
}
