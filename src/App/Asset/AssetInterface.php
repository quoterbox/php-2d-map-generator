<?php

namespace App\Asset;

interface AssetInterface
{
    /**
     * @param string $assetPath
     * @param string $assetNameExt
     * @param string $assetExt
     */
    public function __construct(string $assetPath, string $assetNameExt, string $assetExt);

    /**
     * @return string
     */
    public function getPath() : string;

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @return string
     */
    public function getNameExt() : string;

    /**
     * @return string
     */
    public function getExt() : string;

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
    public function getSideByName(string $sideName) : string;
}
