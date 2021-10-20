<?php

namespace App\ImageSaver;

use App\Map\MapInterface;

interface ImageSaverInterface
{
    public function __construct(MapInterface $map);
    public function saveToFile(string $destPath, string $destFileExt, string $destFileName = '') : string;
    public function saveToManyFiles(string $destPath, string $destFileExt) : void;
}
