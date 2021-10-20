<?php

namespace App\ImageSaver;

use App\Map\MapInterface;

/**
 *
 */
interface ImageSaverInterface
{
    /**
     * @param MapInterface $map
     */
    public function __construct(MapInterface $map);

    /**
     * @param string $destPath
     * @param string $destFileExt
     * @param string $destFileName
     * @return string
     */
    public function saveToFile(string $destPath, string $destFileExt, string $destFileName = '') : string;

    /**
     * @param string $destPath
     * @param string $destFileExt
     */
    public function saveToManyFiles(string $destPath, string $destFileExt) : void;
}
