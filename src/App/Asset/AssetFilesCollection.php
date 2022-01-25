<?php

namespace App\Asset;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use Exception;

class AssetFilesCollection implements AssetCollectionInterface
{
    /**
     * @var array|string[]
     */
    private array $availableExt = ['png','jpg','gif','jpeg','webp'];
    /**
     * @var array|AssetInterface[]
     */
    private array $assets = [];
    /**
     * @var string
     */
    private string $assetsPath;
    /**
     * @var string
     */
    private string $assetsExt;

    /**
     * @param string $assetsPath
     * @param string $assetsExt
     * @throws Exception
     */
    public function __construct(string $assetsPath, string $assetsExt = '')
    {
        $this->setAssetsPath($assetsPath);
        $this->setAssetsExt($assetsExt);
        $this->loadAssets();
    }

    /**
     * @return array
     */
    public function getAssets() : array
    {
        return $this->assets;
    }

    /**
     * @param string $assetsPath
     * @throws Exception
     */
    private function setAssetsPath(string $assetsPath) : void
    {
        if($this->isValidPath($assetsPath)){
            $this->assetsPath = $assetsPath;
        }else{
            throw new Exception("Invalid assets path");
        }
    }

    /**
     * @param string $assetsExt
     * @throws Exception
     */
    private function setAssetsExt(string $assetsExt) : void
    {
        if($this->isValidAssetsExt($assetsExt)) {
            $this->assetsExt = $assetsExt;
        }else{
            $this->assetsExt = '';
        }
    }

    /**
     * @param string $assetsPath
     * @return bool
     */
    private function isValidPath(string $assetsPath) : bool
    {
        return is_dir($assetsPath);
    }

    /**
     * @param string $assetsExt
     * @return bool
     */
    private function isValidAssetsExt(string $assetsExt) : bool
    {
        return in_array($assetsExt, $this->availableExt);
    }

    /**
     * @throws Exception
     */
    private function loadAssets() : void
    {
        $dir = new RecursiveDirectoryIterator($this->assetsPath);
        $dirIterators = new RecursiveIteratorIterator($dir);

        foreach($dirIterators as $dirIterator){

            if ($dirIterator->isFile()) {

                if( !$this->assetsExt && $this->isValidAssetsExt($dirIterator->getExtension())
                    || $this->assetsExt === $dirIterator->getExtension()
                )
                {
                    $this->assets[] = self::createAsset($dirIterator);
                }

            }

        }
    }

    /**
     * @param SplFileInfo $dirItr
     * @return AssetInterface
     * @throws Exception
     */
    private static function createAsset(SplFileInfo $dirItr) : AssetInterface
    {
        return new Asset($dirItr->getPathname(), $dirItr->getFilename(), $dirItr->getExtension());
    }
}
