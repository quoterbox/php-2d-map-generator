<?php

namespace App\Asset;

use Exception;

class Asset implements AssetInterface
{
    private const EMPTY_ASSET_NAME = "EMP";
    /**
     * @var string
     */
    private string $nameDataDelimiter = '_';
    /**
     * @var string
     */
    private string $assetPath;
    /**
     * @var string
     */
    private string $assetName;
    /**
     * @var string
     */
    private string $assetNameExt;
    /**
     * @var string
     */
    private string $assetExt;
    /**
     * @var int
     */
    private int $assetWidth;
    /**
     * @var int
     */
    private int $assetHeight;
    /**
     * @var int
     */
    private int $tileType;
    /**
     * @var string
     */
    private string $tileTopSide;
    /**
     * @var string
     */
    private string $tileRightSide;
    /**
     * @var string
     */
    private string $tileBottomSide;
    /**
     * @var string
     */
    private string $tileLeftSide;

    /**
     * @param string $assetPath
     * @param string $assetName
     * @param string $assetExt
     * @throws Exception
     */
    public function __construct(string $assetPath, string $assetName, string $assetExt)
    {
        $this->setAssetExt($assetExt);
        $this->setAssetNameExt($assetName, $assetExt);
        $this->setAssetName($assetName);
        $this->setAssetPath($assetPath, $this->assetNameExt);
        $this->setAssetSize($this->assetPath);

        if($this->isEmptyAsset($this->assetName)){
            $this->setPropsEmptyAsset();
        }else{
            $this->setPropsFromName($this->assetName);
        }
    }

    /**
     * @return string
     */
    public function getPath() : string
    {
        return $this->assetPath;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->assetName;
    }

    /**
     * @return string
     */
    public function getNameExt() : string
    {
        return $this->assetNameExt;
    }

    /**
     * @return string
     */
    public function getExt() : string
    {
        return $this->assetExt;
    }

    /**
     * @return int
     */
    public function getWidth() : int
    {
        return $this->assetWidth;
    }

    /**
     * @return int
     */
    public function getHeight() : int
    {
        return $this->assetHeight;
    }

    /**
     * @return int
     */
    public function getType() : int
    {
        return $this->tileType;
    }

    /**
     * @return string
     */
    public function getTopSide() : string
    {
        return $this->tileTopSide;
    }

    /**
     * @return string
     */
    public function getRightSide() : string
    {
        return $this->tileRightSide;
    }

    /**
     * @return string
     */
    public function getBottomSide() : string
    {
        return $this->tileBottomSide;
    }

    /**
     * @return string
     */
    public function getLeftSide() : string
    {
        return $this->tileLeftSide;
    }

    /**
     * @param string $sideName
     * @return string
     */
    public function getSideByName(string $sideName) : string
    {
        if($sideName === "top"){
            return $this->getTopSide();
        }elseif($sideName === "bottom"){
            return $this->getBottomSide();
        }elseif($sideName === "left"){
            return $this->getLeftSide();
        }elseif($sideName === "right"){
            return $this->getRightSide();
        }

        return "";
    }

    /**
     * @param string $assetExt
     * @throws Exception
     */
    private function setAssetExt(string $assetExt) : void
    {
        if(strpos($assetExt, ".") === false && strlen($assetExt) > 1){
            $this->assetExt = $assetExt;
        }else{
            throw new Exception("Invalid asset extension: " . $assetExt);
        }
    }

    /**
     * @param string $assetPath
     * @param string $assetNameExt
     * @return void
     * @throws Exception
     */
    private function setAssetPath(string $assetPath, string $assetNameExt) : void
    {
        if(is_file($assetPath . $assetNameExt)){
            $this->assetPath = $assetPath . $assetNameExt;
        }else{
            throw new Exception("Invalid asset path: " . $assetPath . $assetNameExt);
        }
    }

    /**
     * @param string $assetName
     * @param string $assetExt
     * @return void
     * @throws Exception
     */
    private function setAssetNameExt(string $assetName, string $assetExt) : void
    {
        if(strpos($assetName, ".") === false && strpos($assetExt, ".") === false){
            $this->assetNameExt = $assetName . '.' . $assetExt;
        }else{
            throw new Exception("Invalid asset name: " . $assetName . ' with extension: ' . $assetExt);
        }
    }

    /**
     * @param string $assetName
     * @return void
     * @throws Exception
     */
    private function setAssetName(string $assetName) : void
    {
        if(strpos($assetName, ".") === false && strlen($assetName) > 1){
            $this->assetName = $assetName;
        }else{
            throw new Exception("Invalid asset name: " . $assetName);
        }
    }

    /**
     * @param string $assetPath
     * @throws Exception
     */
    private function setAssetSize(string $assetPath) : void
    {
        list($width, $height) = getimagesize($assetPath);

        $this->setAssetWidth($width);
        $this->setAssetHeight($height);
    }

    /**
     * @param int $width
     * @throws Exception
     */
    private function setAssetWidth(int $width) : void
    {
        if($width > 0){
            $this->assetWidth = $width;
        }else{
            throw new Exception("Invalid asset width: " . $width);
        }
    }

    /**
     * @param int $height
     * @throws Exception
     */
    private function setAssetHeight(int $height) : void
    {
        if($height > 0){
            $this->assetHeight = $height;
        }else{
            throw new Exception("Invalid asset height: " . $height);
        }
    }

    /**
     * @param string $assetName
     */
    private function setPropsFromName(string $assetName) : void
    {
        $rawProps = $this->getDataFromName($assetName);
        $sameSides = $rawProps[1];

        $this->tileType = $rawProps[0];
        $this->tileTopSide = $rawProps[2];
        $this->tileRightSide = $sameSides ? $rawProps[2] : $rawProps[3];
        $this->tileBottomSide = $sameSides ? $rawProps[2] : $rawProps[4];
        $this->tileLeftSide = $sameSides ? $rawProps[2] : $rawProps[5];
    }

    /**
     * @param string $assetName
     * @return array
     * @throws Exception
     */
    private function getDataFromName(string $assetName) : array
    {
        $rawProps = [];

        if($this->isValidName($assetName)){
            $rawProps = explode($this->nameDataDelimiter, $assetName);
        }

        return $rawProps;
    }

    /**
     * @param string $assetName
     * @return bool
     * @throws Exception
     *
     * Template for name where '_' is delimiter ##_##_##_##_##_## or ##_##_## if 2-d parameters is 1
     * position 0 - type
     * position 1 - all sides are same (1) or not (0)
     * position 2 - top side
     * position 3 - right side
     * position 4 - bottom side
     * position 5 - left side
     */
    private function isValidName(string $assetName) : bool
    {
        $rawProps = explode($this->nameDataDelimiter, $assetName);

        if(empty($rawProps)
            || count($rawProps) !== 6 && empty($rawProps[1])
            || count($rawProps) !== 3 && !empty($rawProps[1]))
        {
            throw new Exception("Invalid asset name: " . $assetName);
        }

        return true;
    }

    /**
     * @param string $assetName
     * @return bool
     */
    private function isEmptyAsset(string $assetName) : bool
    {
        return strpos($assetName, self::EMPTY_ASSET_NAME) !== false;
    }

    /**
     * @return void
     */
    private function setPropsEmptyAsset() : void
    {
        $this->tileType = 0;
        $this->tileTopSide = false;
        $this->tileRightSide = false;
        $this->tileBottomSide = false;
        $this->tileLeftSide = false;
    }
}
