<?php

namespace App\ImageSaver;

interface ImageSaverInterface
{
    public function openImageResource(string $imagePath, string $imageExt);
    public function saveToFile(string $destPath, string $destFileExt) : bool;
}
