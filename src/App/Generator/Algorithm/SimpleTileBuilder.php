<?php

namespace App\Generator\Algorithm;

use App\Generator\AbstractMapBuilder;
use App\Map\Map;

class SimpleTileBuilder extends AbstractMapBuilder
{
    protected Map $map;
    protected array $assets;
    protected int $xSize;
    protected int $ySize;

    public function build() : void
    {



    }

    private function selectStartTileIndex(array $tiles) : int
    {
        return rand(0, count($tiles) - 1);
    }

    private function setStartCoord(int $size) : int
    {
        return round($size/2, 0, PHP_ROUND_HALF_DOWN);
    }
}
