<?php

namespace App\Map;

use App\Asset\AssetInterface;

interface TileInterface
{
    /**
     * @param AssetInterface $asset
     */
    public function __construct(AssetInterface $asset);

    /**
     * @return int
     */
    public function getWidth() : int;

    /**
     * @return int
     */
    public function getHeight() : int;

    /**
     * @return int
     */
    public function getXCoord() : int;

    /**
     * @return int
     */
    public function getYCoord() : int;

    /**
     * @return AssetInterface
     */
    public function getAsset() : AssetInterface;

    /**
     * @return int
     */
    public function getType() : int;

    /**
     * @return string
     */
    public function getTopSide() : string;

    /**
     * @return string
     */
    public function getRightSide() : string;

    /**
     * @return string
     */
    public function getBottomSide() : string;

    /**
     * @return string
     */
    public function getLeftSide() : string;

    /**
     * @param string $sideName
     * @return string
     */
    public function getInvertedSide(string $sideName) : string;
}
