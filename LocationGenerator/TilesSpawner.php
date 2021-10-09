<?php
namespace LocationGenerator;

use \LocationGenerator\BaseTile;

class TilesSpawner
{
    private $availableExt = ['png','jpg','gif','jpeg','webp','bmp'];
	private $assetsPath;
    private $filesExt;
    private $tiles;
    private $xSize = 2;
    private $ySize = 2;
    private $tileWidth = 1;
    private $tileHeight = 1;
    private $map = [[]];
    private $saveFileExt;
    private $saveFilePath;
    private $saveFileWidth;
    private $saveFileHeight;

	public function __construct(string $assetsPath, string $filesExt, int $xSize, int $ySize)
	{
        $this->assetsPath = $assetsPath;
        $this->filesExt = $filesExt;
        $this->setXSize($xSize);
        $this->setYSize($ySize);
	}

    public function buildLocation() : void
    {
        $this->getTiles($this->assetsPath, $this->filesExt);
        $this->map = WFC($this->tiles, $this->xSize, $this->ySize);
    }

    public function getMapArray() : array
    {
        return $this->map;
    }

    public function saveInFile(string $savePath, string $fileExt) : string
    {
        $this->saveFilePath = $savePath;
        $this->setSaveFileExt($fileExt);
        $this->calcSaveFileDimension();

        $dest = imagecreatetruecolor($this->saveFileWidth, $this->saveFileHeight);

        foreach ($this->map as $row){
            foreach ($row as $col){
                imagecopy($dest, $col['path'], $dx, $dy, 0, 0, $this->saveFileWidth, $this->saveFileHeight);
            }
        }



        return $this->saveFilePath;
    }

    private function setOneTileDimension()
    {
        $firstTile = current($this->map);

        $this->tileWidth = $firstTile['width'];
        $this->tileHeight = $firstTile['width'];
    }

    private function calcSaveFileDimension() : void
    {
        $this->saveFileWidth = $this->tileWidth * $this->xSize;
        $this->saveFileHeight = $this->tileHeight * $this->ySize;
    }

    private function setSaveFileExt(string $fileExt) : void
    {
        $fileExt = str_replace(['.',',',':','/','\\'], '', $fileExt);
        $fileExt = mb_strtolower($fileExt);

        if(in_array($fileExt,$this->availableExt)){
            $this->saveFileExt = $fileExt;
        }else{
            debug("File extension is not support.");
        }
    }

    private function setXSize(int $xSize) : void
    {
        $this->xSize = $xSize < 2 ? 2 : $xSize;
    }

    private function setYSize(int $ySize) : void
    {
        $this->ySize = $ySize < 2 ? 2 : $ySize;
    }

    private function getTiles(string $assetsPath, string $filesExt) : void
    {
        $this->tiles = readFiles($assetsPath, $filesExt);

        foreach ($this->tiles as &$tile){
            $tile = getDataFromName($tile);
        }

        $this->setOneTileDimension();
    }

    private function spawnTile(string $assetName, int $xCurr, int $yCurr) : void
    {
        $this->currentTile = new BaseTile($assetName, $xCurr, $yCurr);
    }

    private function spawnNextTile(BaseTile $currentTile)
    {

    }
}