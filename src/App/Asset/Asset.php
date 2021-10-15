<?php

namespace App\Asset;

use Exception;

class Asset implements AssetInterface
{
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
}
