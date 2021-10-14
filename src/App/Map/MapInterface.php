<?php

namespace App\Map;

use App\Map\Tile;

interface MapInterface
{
    public function load(array $mapArray) : void;
    public function saveToFile(string $destPath, string $destFileExt) : string;
    public function saveToManyFiles(string $destPath, string $destFileExt) : string;
    public function getArray() : array;
    public function getTile(int $xCoord, int $yCoord) : Tile;
    public function getWidthInTiles() : int;
    public function getHeightInTiles() : int;
    public function getWidthInPixels() : int;
    public function getHeightInPixels() : int;
}
