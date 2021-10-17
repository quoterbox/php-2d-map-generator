<?php

namespace App\Map;

use App\Asset\AssetInterface;
use Exception;

class Tile
{
    private int $width;
    private int $height;
    private int $xCoord;
    private int $yCoord;
    private AssetInterface $asset;
    private int $type;
    private string $topSide;
    private string $rightSide;
    private string $bottomSide;
    private string $leftSide;

    public function __construct(AssetInterface $asset)
    {
        $this->asset = $asset;
        $this->width = $asset->getWidth();
        $this->height = $asset->getHeight();
        $this->type = $asset->getType();
        $this->topSide = $asset->getTopSide();
        $this->rightSide = $asset->getRightSide();
        $this->bottomSide = $asset->getBottomSide();
        $this->leftSide = $asset->getLeftSide();
    }

    public function setXCoord(int $xCoord) : void
    {
        if($xCoord > 0){
            $this->xCoord = $xCoord;
        }else{
            throw new Exception("Invalid X coordinate");
        }
    }

    public function setYCoord(int $yCoord) : void
    {
        if($yCoord > 0){
            $this->yCoord = $yCoord;
        }else{
            throw new Exception("Invalid Y coordinate");
        }
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

    public function getInvertedSide(string $sideName) : string
    {
        if($sideName === "top"){
            return $this->getBottomSide();
        }elseif($sideName === "bottom"){
            return $this->getTopSide();
        }elseif($sideName === "left"){
            return $this->getRightSide();
        }elseif($sideName === "right"){
            return $this->getLeftSide();
        }

        return "";
    }
}
