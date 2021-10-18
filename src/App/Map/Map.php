<?php

namespace App\Map;

class Map extends AbstractMap
{
    /**
     * @param array $mapArray
     */
    public function load(array $mapArray) : void
    {

    }

    /**
     * @param string $destPath
     * @param string $destFileExt
     * @return string
     */
    public function saveToFile(string $destPath, string $destFileExt) : string
    {
        return "";
    }

    /**
     * @param string $destPath
     * @param string $destFileExt
     * @return string
     */
    public function saveToManyFiles(string $destPath, string $destFileExt) : string
    {
        return "";
    }
}
