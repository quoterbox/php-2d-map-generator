<?php

namespace Backend\Services\Map;

class MapParamsStructure implements MapParamsStructureInterface
{
    /**
     * @var string
     */
    private string $assetsPath = 'assets/Tiles/';

    /**
     * @var string
     */
    private string $assetsExt = 'png';

    /**
     * @var string|mixed
     */
    private string $packName;

    /**
     * @var string|mixed
     */
    private string $algorithmName;

    /**
     * @var int|mixed
     */
    private int $mapWidth;

    /**
     * @var int|mixed
     */
    private int $mapHeight;

    /**
     * @var int
     */
    private int $minMapWidth = 2;

    /**
     * @var int
     */
    private int $maxMapWidth = 10;

    /**
     * @var int
     */
    private int $minMapHeight = 2;

    /**
     * @var int
     */
    private int $maxMapHeight = 10;

    /**
     * @param array $MapParams
     */
    public function __construct(array $MapParams)
    {
        $this->packName = $MapParams['packName'];
        $this->algorithmName = $MapParams['algorithmName'];
        $this->setMapWidth($MapParams['mapWidth']);
        $this->setMapHeight($MapParams['mapHeight']);
    }

    /**
     * @param int $mapWidth
     * @return void
     */
    private function setMapWidth(int $mapWidth)
    {
        $this->mapWidth = $mapWidth;

        if($mapWidth < $this->minMapWidth){
            $this->mapWidth = $this->minMapWidth;
        }

        if($this->maxMapWidth < $mapWidth){
            $this->mapWidth = $this->maxMapWidth;
        }
    }

    /**
     * @param int $mapHeight
     * @return void
     */
    private function setMapHeight(int $mapHeight)
    {
        $this->mapHeight = $mapHeight;

        if($mapHeight < $this->minMapHeight){
            $this->mapHeight = $this->minMapHeight;
        }

        if($this->maxMapHeight < $mapHeight){
            $this->mapHeight = $this->maxMapHeight;
        }
    }

    /**
     * @return string
     */
    public function getAssetsPath(): string
    {
        return $this->assetsPath;
    }

    /**
     * @return string
     */
    public function getAssetsExt(): string
    {
        return $this->assetsExt;
    }

    /**
     * @return string
     */
    public function getFullAssetsPath(): string
    {
        return $this->getAssetsPath() . $this->getPackName() . '/';
    }

    /**
     * @return string
     */
    public function getPackName(): string
    {
        return $this->packName;
    }

    /**
     * @return string
     */
    public function getAlgorithmName(): string
    {
        return $this->algorithmName;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->mapWidth;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->mapHeight;
    }

}
