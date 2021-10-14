<?php

namespace App\Asset;

use Exception;

class AssetFilesCollection implements AssetInterface
{
    private array $availableExt = ['png','jpg','gif','jpeg','webp'];
    private array $assets = [];
    private string $assetsPath;
    private string $assetsExt;

    public function __construct(string $assetsPath, string $assetsExt)
    {
        $this->setAssetPath($assetsPath);
        $this->setAssetsExt($assetsExt);
    }

    private function setAssetPath(string $assetsPath) : void
    {
        if($this->isValidPath($assetsPath)){
            $this->assetsPath = $assetsPath;
        }else{
            throw new Exception("Invalid asset path");
        }
    }

    private function setAssetsExt(string $assetsExt) : void
    {
        if($this->isValidAssetsExt($assetsExt)){
            $this->assetsExt = $assetsExt;
        }else{
            throw new Exception("Invalid assets extension");
        }
    }

    private function isValidPath(string $assetsPath) : bool
    {
        return is_dir($assetsPath);
    }

    private function isValidAssetsExt(string $assetsExt) : bool
    {
        return in_array($assetsExt, $this->availableExt);
    }

    public function getAssets() : array {return $this->assets;}

    public function loadAssets() : void
    {




//        foreach ($files as &$file){
//
//            $file = $this->getFileInfo($file);
//        }
//
//        return [];
    }

    private function getFileInfo(string $assetName) : array {return [];}


}
