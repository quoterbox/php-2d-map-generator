<?php

namespace App\Map;

use App\Asset\AssetInterface;
use Exception;
use JsonSerializable;

class Tile implements TileInterface, JsonSerializable
{
    /**
     * @var int
     */
    private int $width;

    /**
     * @var int
     */
    private int $height;

    /**
     * @var int
     */
    private int $xCoord;

    /**
     * @var int
     */
    private int $yCoord;

    /**
     * @var string
     */
    private string $imgPath = '';

    /**
     * @var AssetInterface
     */
    private AssetInterface $asset;

    /**
     * @var int
     */
    private int $type;

    /**
     * @var string
     */
    private string $topSide;

    /**
     * @var string
     */
    private string $rightSide;

    /**
     * @var string
     */
    private string $bottomSide;

    /**
     * @var string
     */
    private string $leftSide;

    /**
     * @param AssetInterface $asset
     */
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'img' => $this->getImgPath(),
        ];
    }

    /**
     * @param string $imgPath
     * @return void
     */
    public function setImgPath(string $imgPath): void
    {
        if(!empty($imgPath)){
            $this->imgPath = $imgPath;
        }
    }

    /**
     * @param int $xCoord
     * @throws Exception
     */
    public function setXCoord(int $xCoord) : void
    {
        if($xCoord > 0){
            $this->xCoord = $xCoord;
        }else{
            throw new Exception("Invalid X coordinate");
        }
    }

    /**
     * @param int $yCoord
     * @throws Exception
     */
    public function setYCoord(int $yCoord) : void
    {
        if($yCoord > 0){
            $this->yCoord = $yCoord;
        }else{
            throw new Exception("Invalid Y coordinate");
        }
    }

    /**
     * @return string
     */
    public function getImgPath(): string
    {
        return $this->imgPath;
    }

    /**
     * @return int
     */
    public function getWidth() : int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight() : int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getXCoord() : int
    {
        return $this->xCoord;
    }

    /**
     * @return int
     */
    public function getYCoord() : int
    {
        return $this->yCoord;
    }

    /**
     * @return AssetInterface
     */
    public function getAsset() : AssetInterface
    {
        return $this->asset;
    }

    /**
     * @return int
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getTopSide() : string
    {
        return $this->topSide;
    }

    /**
     * @return string
     */
    public function getRightSide() : string
    {
        return $this->rightSide;
    }

    /**
     * @return string
     */
    public function getBottomSide() : string
    {
        return $this->bottomSide;
    }

    /**
     * @return string
     */
    public function getLeftSide() : string
    {
        return $this->leftSide;
    }

    /**
     * @param string $sideName
     * @return string
     */
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
