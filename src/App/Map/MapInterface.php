<?php

namespace App\Map;

interface MapInterface
{
    public function __construct(int $xSize, int $ySize);
    public function load(array $mapArray) : void;
    public function saveToFile(string $destPath, string $destFileExt) : string;
    public function saveToManyFiles(string $destPath, string $destFileExt) : string;
    public function getArray() : array;
    public function addTile(Tile $tile, int $xCoord, int $yCoord) : void;
    public function getTile(int $xCoord, int $yCoord) : Tile;
    public function getWidthInTiles() : int;
    public function getHeightInTiles() : int;
    public function getWidthInPixels() : int;
    public function getHeightInPixels() : int;
}
