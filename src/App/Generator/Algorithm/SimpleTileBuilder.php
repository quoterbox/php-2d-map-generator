<?php
/**
 * --*{"id": 0,"name":"SimpleTileBuilder","title":"Simple Tile Model", "desc": "Simple Tile Model provides you with the fastest method to generate your map from tiles. It checks every single tile if it's fit for other closest tiles row by row."}*--
 **/

namespace App\Generator\Algorithm;

use App\Asset\AssetInterface;
use App\Asset\Asset;
use App\Generator\AbstractMapBuilder;
use App\Map\MapInterface;
use App\Map\Tile;

class SimpleTileBuilder extends AbstractMapBuilder
{
    private const EMPTY_ASSET_NAME = 'EMP';
    private const EMPTY_ASSET_PATH = 'assets' . DIRECTORY_SEPARATOR;
    private const EMPTY_ASSET_EXT = 'png';
    private int $EMPTY_ASSET_WIDTH = 100;
    private int $EMPTY_ASSET_HEIGHT = 100;

    /**
     * @var MapInterface
     */
    protected MapInterface $map;
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
        $xCurr = 0;
        $yCurr = 0;
        //$xCurr = $this->setStartCoord($this->xSize);
        //$yCurr = $this->setStartCoord($this->ySize);

        $startAssetIndex = $this->selectStartTileIndex($this->assets);

        $this->setUpAssetDimension($this->assets[$startAssetIndex]);

        $this->map->addTile(new Tile($this->assets[$startAssetIndex]), $xCurr, $yCurr);

        $xStart = $xCurr + 1;
        $this->feedForward($xStart, $this->xSize, $yCurr, $this->ySize);

        $xStart = $xCurr - 1;
        $this->feedBackward($xStart, $this->xSize, $yCurr);
    }

    /**
     * @param AssetInterface $asset
     * @return void
     */
    private function setUpAssetDimension(AssetInterface $asset): void
    {
        $this->EMPTY_ASSET_WIDTH = $asset->getWidth();
        $this->EMPTY_ASSET_HEIGHT = $asset->getHeight();
    }

    /**
     * @param int $xStart
     * @param int $xEnd
     * @param int $yStart
     * @param int $yEnd
     */
    private function feedForward(int $xStart, int $xEnd, int $yStart, int $yEnd) : void
    {
        $cnt_y = 0;

        for ($yCurr = $yStart; $yCurr < $yEnd; $yCurr++){

            for ($xCurr = $xStart; $xCurr < $xEnd; $xCurr++){

                $asset = $this->getFitAsset($xCurr, $yCurr);
                $this->map->addTile(new Tile($asset), $xCurr, $yCurr);

            }

            if($cnt_y == 0){
                $xStart = 0;
            }

            $cnt_y++;
        }
    }

    /**
     * @param int $xStart
     * @param int $xEnd
     * @param int $yStart
     */
    private function feedBackward(int $xStart, int $xEnd, int $yStart) : void
    {
        $cnt_y = 0;

        for ($yCurr = $yStart; $yCurr >= 0; $yCurr--){

            for ($xCurr = $xStart; $xCurr >= 0; $xCurr--){

                $asset = $this->getFitAsset($xCurr, $yCurr);
                $this->map->addTile(new Tile($asset), $xCurr, $yCurr);

            }

            if($cnt_y == 0){
                $xStart = $xEnd - 1;
            }

            $cnt_y++;
        }
    }

    /**
     * @param int $xCurr
     * @param int $yCurr
     * @return AssetInterface
     * @throws \Exception
     */
    private function getFitAsset(int $xCurr, int $yCurr) : AssetInterface
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
     * @return AssetInterface
     */
    private function chooseOneAsset(array $assets) : AssetInterface
    {
        if(empty($assets)){
            $emptyAssetName = self::EMPTY_ASSET_NAME . '_' . $this->EMPTY_ASSET_WIDTH . '_' . $this->EMPTY_ASSET_HEIGHT;
            return new Asset(self::EMPTY_ASSET_PATH, $emptyAssetName, self::EMPTY_ASSET_EXT);
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
