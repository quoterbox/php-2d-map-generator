<?php

namespace App\Asset;

use Exception;

class Asset implements AssetInterface
{
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
     * @param string $assetNameExt
     * @param string $assetExt
     * @throws Exception
     */
    public function __construct(string $assetPath, string $assetNameExt, string $assetExt)
    {
        $this->setAssetExt($assetExt);
        $this->setAssetPath($assetPath);
        $this->setAssetNameExt($assetNameExt);
        $this->setAssetName($this->assetNameExt, $this->assetExt);
        $this->setAssetSize($this->assetPath);
        $this->setPropsFromName($this->assetName);
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
     * @throws Exception
     */
    private function setAssetPath(string $assetPath) : void
    {
        if(is_file($assetPath)){
            $this->assetPath = $assetPath;
        }else{
            throw new Exception("Invalid asset path: " . $assetPath);
        }
    }

    /**
     * @param string $assetNameExt
     * @throws Exception
     */
    private function setAssetNameExt(string $assetNameExt) : void
    {
        if(strpos($assetNameExt, ".")){
            $this->assetNameExt = $assetNameExt;
        }else{
            throw new Exception("Invalid asset name with extension: " . $assetNameExt);
        }
    }

    /**
     * @param string $assetNameExt
     * @param string $assetExt
     */
    private function setAssetName(string $assetNameExt, string $assetExt) : void
    {
        $this->assetName = str_replace("." . $assetExt, "", $assetNameExt);
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
     * 0 - type
     * 1 - all sides are same (1) or not (0)
     * 2 - top side
     * 3 - right side
     * 4 - bottom side
     * 5 - left side
     */
    private function isValidName(string $assetName) : bool
    {
        $rawProps = explode($this->nameDataDelimiter, $assetName);

        if( empty($rawProps)
            || count($rawProps) !== 6 && empty($rawProps[1])
            || count($rawProps) !== 3 && !empty($rawProps[1]))
        {
            throw new Exception("Invalid asset name: " . $assetName);
        }

        return true;
    }
}
