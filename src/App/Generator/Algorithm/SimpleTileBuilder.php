<?php

namespace App\Generator\Algorithm;

use App\Generator\AbstractMapBuilder;
use App\Asset\Asset;
use App\Map\Map;
use App\Map\Tile;

class SimpleTileBuilder extends AbstractMapBuilder
{
    private const EMPTY_ASSET_NAME = 'EMP.png';

    private const EMPTY_ASSET_PATH = 'Assets' . DIRECTORY_SEPARATOR . self::EMPTY_ASSET_NAME;

    private const EMPTY_ASSET_EXT = 'png';
    /**
     * @var Map
     */
    protected Map $map;
    /**
     * @var array
     */
    protected array $assets;
    /**
     * @var int
     */
    protected int $xSize;
    /**
     * @var int
     */
    protected int $ySize;

    public function build() : void
    {
        $xCurr = $this->setStartCoord($this->xSize);
        $yCurr = $this->setStartCoord($this->ySize);

        $startAssetIndex = $this->selectStartTileIndex($this->assets);
        $this->map->addTile(new Tile($this->assets[$startAssetIndex]), $xCurr, $yCurr);

        $yStart = ++$yCurr;
        $this->feedForward($xCurr, $this->xSize, $yStart, $this->ySize);

        $yStart = $yCurr - 2;
        $this->feedBackward($xCurr, $this->xSize, $yStart);
    }

    /**
     * @param int $xStart
     * @param int $xEnd
     * @param int $yStart
     * @param int $yEnd
     */
    private function feedForward(int $xStart, int $xEnd, int $yStart, int $yEnd) : void
    {
        $cnt_x = 0;

        for ($xCurr = $xStart; $xCurr < $xEnd; $xCurr++){

            for ($yCurr = $yStart; $yCurr < $yEnd; $yCurr++){

                $asset = $this->getFitAsset($xCurr, $yCurr);
                $this->map->addTile(new Tile($asset), $xCurr, $yCurr);

            }

            if($cnt_x == 0){
                $yStart = 0;
            }

            $cnt_x++;
        }
    }

    /**
     * @param int $xStart
     * @param int $yStart
     * @param int $yEnd
     */
    private function feedBackward(int $xStart, int $yStart, int $yEnd) : void
    {
        $cnt_x = 0;

        for ($xCurr = $xStart; $xCurr >= 0; $xCurr--){

            for ($yCurr = $yStart; $yCurr >= 0; $yCurr--){

                $asset = $this->getFitAsset($xCurr, $yCurr);
                $this->map->addTile(new Tile($asset), $xCurr, $yCurr);

            }

            if($cnt_x == 0){
                $yStart = $yEnd - 1;
            }

            $cnt_x++;
        }
    }

    /**
     * @param int $xCurr
     * @param int $yCurr
     * @return Asset
     */
    private function getFitAsset(int $xCurr, int $yCurr) : Asset
    {
        $neighborTiles = $this->map->getNeighborTiles($xCurr, $yCurr);
        $neededSides = $this->getSidesFitAsset($neighborTiles);
        $allFitAssets = $this->getAllFitAssets($neededSides);

        return $this->chooseOneAsset($allFitAssets);
    }

    /**
     * @param array $neighborTiles
     * @return array
     */
    private function getSidesFitAsset(array $neighborTiles) : array
    {
        $neededSides = [];

        foreach ($neighborTiles as $sideName => $neighborTile){
            $neededSides[$sideName] = !empty($neighborTile) ? $neighborTile->getInvertedSide($sideName) : false;
        }

        return $neededSides;
    }

    /**
     * @param array $neededSides
     * @return array
     */
    private function getAllFitAssets(array $neededSides) : array
    {
        $neededAssets = [];

        foreach ($this->assets as $asset){

            $isNeeded = true;

            foreach ($neededSides as $needSideName => $neededSide){

                // if cell from this side is empty, then will be fit any side
                if(!empty($neededSide)){

                    if($asset->getSideByName($needSideName) !== $neededSide){
                        $isNeeded = false;
                    }

                }

            }

            if($isNeeded){
                $neededAssets[] = $asset;
            }
        }

        return $neededAssets;
    }

    /**
     * @param array $assets
     * @return Asset
     */
    private function chooseOneAsset(array $assets) : Asset
    {
        if(empty($assets)){
            return new Asset(self::EMPTY_ASSET_PATH, self::EMPTY_ASSET_NAME, self::EMPTY_ASSET_EXT);
        }else{
            $randIndex = rand(0, count($assets) - 1);
            return $assets[$randIndex];
        }
    }

    /**
     * @param array $assets
     * @return int
     */
    private function selectStartTileIndex(array $assets) : int
    {
        return rand(0, count($assets) - 1);
    }

    /**
     * @param int $size
     * @return int
     */
    private function setStartCoord(int $size) : int
    {
        return round($size/2, 0, PHP_ROUND_HALF_DOWN);
    }
}
