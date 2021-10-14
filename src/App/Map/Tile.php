<?php

namespace App\Map;

use App\Asset\AssetInterface;

class Tile
{
    private int $width = 100;
    private int $height = 100;
    private int $xCoord = 0;
    private int $yCoord = 0;

    private AssetInterface $asset;
    private int $type;
    private string $topSide;
    private string $rightSide;
    private string $bottomSide;
    private string $leftSide;

    public function __construct(string $assetPath, int $xSize, int $ySize){}
}
