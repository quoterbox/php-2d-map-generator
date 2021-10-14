<?php

namespace App\Map;

class Map extends AbstractMap
{
    public function load(array $mapArray) : void {}
    public function saveToFile(string $destPath, string $destFileExt) : string {return "";}
    public function saveToManyFiles(string $destPath, string $destFileExt) : string {return "";}
    public function getArray() : array {return [];}
    public function getTile(int $xCoord, int $yCoord) : Tile {return $tile;}
    public function getWidthInTiles() : int {return 0;}
    public function getHeightInTiles() : int {return 0;}
    public function getWidthInPixels() : int {return 0;}
    public function getHeightInPixels() : int {return 0;}
}
