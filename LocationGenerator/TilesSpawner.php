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
        $fileName = time();
        $this->saveFilePath = $savePath;
        $this->setSaveFileExt($fileExt);

        $this->calcSaveFileDimension();

        $dest = imagecreatetruecolor($this->saveFileWidth, $this->saveFileHeight);

        $d_row = 0;

        for($row = 0; $row < $this->xSize; $row++){

            $d_col = 0;

            for($col = 0; $col < $this->ySize; $col++){

                $oneTileImg = imagecreatefrompng($this->map[$row][$col]['path']);

                imagecopy($dest, $oneTileImg, $d_col, $d_row, 0, 0, $this->saveFileWidth, $this->saveFileHeight);

                $d_col += $this->tileHeight;
            }

            $d_row += $this->tileWidth;
        }

        imagepng($dest, $this->saveFilePath . $fileName . '.' . $this->saveFileExt);

        return $this->saveFilePath;
    }

    private function setOneTileDimension()
    {
        $firstTile = current($this->tiles);

        $this->tileWidth = $firstTile['width'];
        $this->tileHeight = $firstTile['height'];
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
