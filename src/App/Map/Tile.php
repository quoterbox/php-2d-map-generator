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

    public function __construct(AssetInterface $asset, int $xSize, int $ySize)
    {
        $this->asset = $asset;
        $this->width = $xSize;
        $this->height = $ySize;
        $this->type = $asset->getType();
        $this->topSide = $asset->getTopSide();
        $this->rightSide = $asset->getRightSide();
        $this->bottomSide = $asset->getBottomSide();
        $this->leftSide = $asset->getLeftSide();
    }

    public function getWidth() : int
    {
        return $this->width;
    }

    public function getHeight() : int
    {
        return $this->height;
    }

    public function getXCoord() : int
    {
        return $this->xCoord;
    }

    public function getYCoord() : int
    {
        return $this->yCoord;
    }

    public function getAsset() : AssetInterface
    {
        return $this->asset;
    }

    public function getType() : int
    {
        return $this->type;
    }

    public function getTopSide() : string
    {
        return $this->topSide;
    }

    public function getRightSide() : string
    {
        return $this->rightSide;
    }

    public function getBottomSide() : string
    {
        return $this->bottomSide;
    }

    public function getLeftSide() : string
    {
        return $this->leftSide;
    }
}
