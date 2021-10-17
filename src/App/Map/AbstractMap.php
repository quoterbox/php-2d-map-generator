<?php

namespace App\Map;

use Exception;

abstract class AbstractMap implements MapInterface
{
    /**
     * @var int
     */
    protected int $widthPixels = 0;
    /**
     * @var int
     */
    protected int $heightPixels = 0;
    /**
     * @var int
     */
    protected int $widthTiles;
    /**
     * @var int
     */
    protected int $heightTiles;
    /**
     * @var array|array[]
     */
    protected array $tiles = [[]];

    /**
     * @param array $mapArray
     */
    abstract public function load(array $mapArray) : void;

    /**
     * @param string $destPath
     * @param string $destFileExt
     * @return string
     */
    abstract public function saveToFile(string $destPath, string $destFileExt) : string;

    /**
     * @param string $destPath
     * @param string $destFileExt
     * @return string
     */
    abstract public function saveToManyFiles(string $destPath, string $destFileExt) : string;

    /**
     * @return array
     */
    public function getArray() : array
    {
        return $this->tiles;
    }

    /**
     * @param int $xSize
     * @param int $ySize
     * @throws Exception
     */
    public function __construct(int $xSize, int $ySize)
    {
        $this->setWidthTiles($xSize);
        $this->setHeightTiles($ySize);
    }

    /**
     * @return int
     */
    public function getWidthInTiles() : int
    {
        return $this->widthTiles;
    }

    /**
     * @return int
     */
    public function getHeightInTiles() : int
    {
        return $this->heightTiles;
    }

    /**
     * @return int
     */
    public function getWidthInPixels() : int
    {
        return $this->widthPixels;
    }

    /**
     * @return int
     */
    public function getHeightInPixels() : int
    {
        return $this->heightPixels;
    }

    /**
     * @param int $xSize
     * @throws Exception
     */
    protected function setWidthTiles(int $xSize) : void
    {
        if($xSize > 0){
            $this->widthTiles = $xSize;
        }else{
            throw new Exception("Invalid width of Map");
        }
    }

    /**
     * @param int $ySize
     * @throws Exception
     */
    protected function setHeightTiles(int $ySize) : void
    {
        if($ySize > 0){
            $this->heightTiles = $ySize;
        }else{
            throw new Exception("Invalid height of Map");
        }
    }

    /**
     * @param \App\Map\Tile $tile
     * @param int $xCoord
     * @param int $yCoord
     */
    public function addTile(Tile $tile, int $xCoord, int $yCoord) : void
    {
        $this->tiles[$xCoord][$yCoord] = $tile;
    }

    /**
     * @param int $xCoord
     * @param int $yCoord
     * @return \App\Map\Tile
     * @throws Exception
     */
    public function getTile(int $xCoord, int $yCoord) : Tile
    {
        if(empty($this->tiles[$xCoord][$yCoord])){
            throw new Exception("Tile with coordinates x=" . $xCoord . " y=" . $yCoord . " does not exist");
        }else{
            return $this->tiles[$xCoord][$yCoord];
        }
    }

    /**
     * @param int $xCoord
     * @param int $yCoord
     * @return bool
     */
    public function isExistTile(int $xCoord, int $yCoord) : bool
    {
        return !empty($this->tiles[$xCoord][$yCoord]);
    }

    public function getNeighborTiles(int $x, int $y) : array
    {
        return [
            'top' => $this->isExistTile($x - 1, $y) ? $this->getTile($x - 1, $y) : false,
            'right' => $this->isExistTile($x, $y + 1) ? $this->getTile($x, $y + 1) : false,
            'bottom' => $this->isExistTile($x + 1, $y) ? $this->getTile($x + 1, $y) : false,
            'left' => $this->isExistTile($x, $y - 1) ? $this->getTile($x, $y - 1) : false,
        ];
    }
}
