<?php

namespace App\MapSaver;

use App\Map\MapInterface;
use App\Asset\AssetInterface;
use Exception;

class MapSaver implements MapSaverInterface
{
    /**
     * @var MapInterface
     */
    private MapInterface $map;
    /**
     * @var int
     */
    private int $width;
    /**
     * @var int
     */
    private int $height;
    /**
     * @var string
     */
    private string $destExt;
    /**
     * @var array|string[]
     */
    private array $availableSaveExt = ['png','jpg','gif','jpeg','webp'];

    /**
     * @var string
     */
    private string $savedImagePath = '';
    /**
     * @var string
     */
    private string $savedImageName = '';

    /**
     * @var string
     */
    private string $fileNamePrefix = 'map';

    /**
     * @var false|\GdImage|resource
     */
    private $gdImgObject;

    /**
     * @param MapInterface $map
     */
    public function __construct(MapInterface $map)
    {
        $this->map = $map;
        $this->width = $this->map->getWidthInPixels();
        $this->height = $this->map->getHeightInPixels();
        $this->gdImgObject = imagecreatetruecolor($this->width, $this->height);
    }

    /**
     * @param string $destPath
     * @param string $destFileExt
     * @return array
     * @throws Exception
     */
    public function saveToManyFiles(string $destPath, string $destFileExt) : array
    {
        $this->destExt = $destFileExt;
        $Files = [];

        for($y = 0; $y < $this->map->getHeightInTiles(); $y++){

            for($x = 0; $x < $this->map->getWidthInTiles(); $x++){

                $destFileName = 'row_' . $y . '__col_' . $x;
                $savePath = $this->makeDestFileName($destPath, $destFileExt, $destFileName);

                $oneTileImg = $this->imageCreate($this->map->getTile($x, $y)->getAsset()->getPath(), $this->map->getTile($x, $y)->getAsset()->getExt());
                $this->saveGDResourceToImage($oneTileImg, $savePath);
                $Files[] = $savePath;
            }
        }

        return $Files;
    }

    /**
     * @param string $destPath
     * @param string $destFileExt
     * @param string $destFileName
     * @return string
     * @throws Exception
     */
    public function saveToFile(string $destPath, string $destFileExt, string $destFileName = '') : string
    {
        if($this->isNeedOldImage($destFileExt, $destFileName)){

            return $this->savedImagePath;

        }elseif($this->isNeedRename($destFileExt, $destFileName)){

            return $this->renameImage($this->savedImagePath, $destPath, $destFileExt, $destFileName);

        }elseif($this->isNeedConvert($destFileExt)){

            return $this->convertImageToFormat($this->savedImagePath, $destPath, $destFileExt, $destFileName);

        }else{
            return $this->saveNewFile($destPath, $destFileExt, $destFileName);
        }
    }

    /**
     * @param string $destFileExt
     * @param string $destFileName
     * @return bool
     */
    private function isNeedOldImage(string $destFileExt, string $destFileName) : bool
    {
        return $this->isAlreadySaved() && $this->isSameExt($destFileExt) && $this->isSameName($destFileName);
    }

    /**
     * @param string $destFileExt
     * @param string $destFileName
     * @return bool
     */
    private function isNeedRename(string $destFileExt, string $destFileName) : bool
    {
        return $this->isAlreadySaved() && $this->isSameExt($destFileExt) && !$this->isSameName($destFileName);
    }

    /**
     * @param string $destFileExt
     * @return bool
     */
    private function isNeedConvert(string $destFileExt) : bool
    {
        return $this->isAlreadySaved() && !$this->isSameExt($destFileExt);
    }

    /**
     * @param string $imageFromPath
     * @param string $destPath
     * @param string $destFileExt
     * @param string $destFileName
     * @return string
     * @throws Exception
     */
    private function renameImage(string $imageFromPath, string $destPath, string $destFileExt, string $destFileName) : string
    {
        $newFilePath = $this->makeDestFileName($destPath, $destFileExt, $destFileName);

        if(copy($imageFromPath, $newFilePath)){
            return $newFilePath;
        }else{
            throw new Exception('An error occurred while copy or rename file');
        }
    }

    /**
     * @param string $imageFromPath
     * @param string $destPath
     * @param string $destFileExt
     * @param string $destFileName
     * @return string
     * @throws Exception
     */
    private function convertImageToFormat(string $imageFromPath, string $destPath, string $destFileExt, string $destFileName) : string
    {
        $oldImg = $this->imageCreate($imageFromPath, $this->destExt);
        imagecopy($this->gdImgObject, $oldImg, 0, 0, 0, 0, $this->width, $this->height);
        $newFilePath = $this->makeDestFileName($destPath, $destFileExt, $destFileName);

        return $this->saveGDResourceToImage($this->gdImgObject, $newFilePath);
    }

    /**
     * @param string $destPath
     * @param string $destFileExt
     * @param string $destFileName
     * @return string
     * @throws Exception
     */
    private function saveNewFile(string $destPath, string $destFileExt, string $destFileName) : string
    {
        $this->destExt = $destFileExt;

        $savePath = $this->makeDestFileName($destPath, $destFileExt, $destFileName);

        if($this->saveMapToFile($savePath)){

            $this->savedImagePath = $savePath;
            $this->savedImageName = $destFileName;

            return $savePath;
        }else{
            throw new Exception('An error occurred while saving the file');
        }
    }

    /**
     * @param string $savePath
     * @return bool
     */
    private function saveMapToFile(string $savePath) : bool
    {
        $cnt_row = 0;
        for($y = 0; $y < $this->map->getHeightInTiles(); $y++){

            $cnt_col = 0;

            $tile = $this->map->getTile(0, $y);

            for($x = 0; $x < $this->map->getWidthInTiles(); $x++){

                $tile = $this->map->getTile($x, $y);

                $oneTileImg = $this->imageCreate($tile->getAsset()->getPath(), $tile->getAsset()->getExt());
                imagecopy($this->gdImgObject, $oneTileImg, $cnt_col, $cnt_row, 0, 0, $this->width, $this->height);

                $cnt_col += $tile->getHeight();
            }

            $cnt_row += $tile->getWidth();
        }

        return $this->saveGDResourceToImage($this->gdImgObject, $savePath);
    }

    /**
     * @param string $destPath
     * @param string $destFileExt
     * @param string $destFileName
     * @return string
     * @throws Exception
     */
    private function makeDestFileName(string $destPath, string $destFileExt, string $destFileName) : string
    {
        if(!$this->isValidPath($destPath)){
            if(!mkdir($destPath,0777, true)){
                throw new Exception('Invalid save path');
            }
        }

        if(!$this->isValidAssetsExt($destFileExt)){
            throw new Exception('Invalid file extension to save');
        }

        if(!empty($destFileName)){
            return $destPath . $destFileName . '.' . $destFileExt;
        }else{
            return $this->makeUniqFileName($destPath, $destFileExt);
        }
    }

    /**
     * @param string $destPath
     * @param string $destFileExt
     * @return string
     * @throws Exception
     */
    private function makeUniqFileName(string $destPath, string $destFileExt) : string
    {
        $fileName = $this->fileNamePrefix . '_' . time();

        $uniqFileName = $destPath . $fileName . '.' . $destFileExt;

        for($i = 1; $i < 999; $i++){

            if(!file_exists($uniqFileName)){
                break;
            }

            $uniqFileName = $destPath . $fileName . '_' . $i . '.' . $destFileExt;
        }

        if(file_exists($uniqFileName)){
            throw new Exception('Invalid file name. A file with the same name already exists.');
        }

        return $uniqFileName;
    }

    /**
     * @param string $filePath
     * @param string $assetExt
     * @return false|\GdImage|resource|void
     */
    private function imageCreate(string $filePath, string $assetExt)
    {
        switch ($assetExt){
            case 'png':
                return imagecreatefrompng($filePath);
            case 'jpeg':
            case 'jpg':
                return imagecreatefromjpeg($filePath);
            case 'webp':
                return imagecreatefromwebp($filePath);
            case 'gif':
                return imagecreatefromgif($filePath);
        }
    }

    /**
     * @param $image
     * @param string $filePath
     * @return bool
     */
    private function saveGDResourceToImage($image, string $filePath) : bool
    {
        switch ($this->destExt){
            case 'png':
                return imagepng($image, $filePath);
            case 'jpeg':
            case 'jpg':
                return imagejpeg($image, $filePath);
            case 'webp':
                return imagewebp($image, $filePath);
            case 'gif':
                return imagegif($image, $filePath);
        }

        return false;
    }

    /**
     * @param string $assetsExt
     * @return bool
     */
    private function isValidAssetsExt(string $assetsExt) : bool
    {
        return in_array($assetsExt, $this->availableSaveExt);
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
     * @return bool
     */
    private function isAlreadySaved() : bool
    {
        return (bool)$this->savedImagePath;
    }

    /**
     * @param string $destFileExt
     * @return bool
     */
    private function isSameExt(string $destFileExt) : bool
    {
        return $this->destExt === $destFileExt;
    }

    /**
     * @param string $destFileName
     * @return bool
     */
    private function isSameName(string $destFileName) : bool
    {
        return $this->savedImageName === $destFileName;
    }
}
