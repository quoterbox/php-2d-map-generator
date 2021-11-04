<?php

namespace App\Generator;

use App\Map\MapInterface;

interface MapBuilderInterface
{
    /**
     * @param array $assets
     * @param int $xSize
     * @param $ySize
     */
    public function __construct(array $assets, int $xSize, int $ySize);

    public function build() : void;

    /**
     * @return MapInterface
     */
    public function getMap() : MapInterface;
}
