<?php

namespace App\Map;

interface MapInterface
{
    /**
     * @param int $xSize
     * @param int $ySize
     */
    public function __construct(int $xSize, int $ySize);

    /**
     * @return array
     */
    public function getTilesArray() : array;

    /**
     * @param TileInterface $tile
     * @param int $xCoord
     * @param int $yCoord
     */
    public function addTile(TileInterface $tile, int $xCoord, int $yCoord) : void;

    /**
     * @param int $xCoord
     * @param int $yCoord
     * @return TileInterface
     */
    public function getTile(int $xCoord, int $yCoord) : TileInterface;

    /**
     * @return int
     */
    public function getWidthInTiles() : int;

    /**
     * @return int
     */
    public function getHeightInTiles() : int;

    /**
     * @return int
     */
    public function getWidthInPixels() : int;

    /**
     * @return int
     */
    public function getHeightInPixels() : int;
}
