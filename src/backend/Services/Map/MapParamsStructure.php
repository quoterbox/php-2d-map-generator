<?php

namespace Backend\Services\Map;

class MapParamsStructure implements MapParamsStructureInterface
{
    /**
     * @var string
     */
    private string $assetsPath = 'assets\Tiles\\';
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
     * @param array $MapParams
     */
    public function __construct(array $MapParams)
    {
        $this->packName = $MapParams['packName'];
        $this->algorithmName = $MapParams['algorithmName'];
        $this->mapWidth = $MapParams['mapWidth'];
        $this->mapHeight = $MapParams['mapHeight'];
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
        return $this->getAssetsPath() . $this->getPackName() . '\\';
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
