<?php

namespace App\ImageSaver;

use App\Map\MapInterface;

class ImageSaver
{
    private MapInterface $map;
    private int $width;
    private int $height;
    private int $destExt;

    /**
     * @var false|\GdImage|resource
     */
    private $gdImgObject;

    public function __construct(MapInterface $map)
    {
        $this->map = $map;
        $this->width = $this->map->getWidthInPixels();
        $this->height = $this->map->getHeightInPixels();
        $this->gdImgObject = imagecreatetruecolor($this->width, $this->height);
    }

    public function saveToFile(string $destPath, string $destFileExt, string $destFileName = '') : void
    {

    }

    public function saveToManyFiles(string $destPath, string $destFileExt) : void
    {

    }


    private function imageCreate(string $filePath)
    {
        switch ($this->destExt){
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



}
