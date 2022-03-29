<?php

namespace Backend\Services\Generator;

use App\Asset\AssetsCollection;
use App\Map\MapInterface;
use App\MapSaver\MapSaver;
use App\MapSaver\MapSaverInterface;
use Backend\Services\Map\MapParamsStructureInterface;

class GeneratorService implements GeneratorServiceInterface
{
    /**
     * @var string
     */
    private string $algorithmNamespace = 'App\Generator\Algorithm\\';

    /**
     * @var string
     */
    private string $oneFileMapPath = 'saved\FromImageSaver\OneFileMap\\';

    /**
     * @var string
     */
    private string $manyFilesMapPath = 'saved\FromImageSaver\ManyFilesMap\\';

    /**
     * @var string
     */
    private string $savedMapExt = 'png';

    /**
     * @var MapInterface
     */
    private MapInterface $map;

    /**
     * @var MapSaverInterface|MapSaver
     */
    private MapSaverInterface $mapSaver;

    /**
     * @param MapParamsStructureInterface $mapParams
     * @throws \Exception
     */
    public function __construct(MapParamsStructureInterface $mapParams)
    {
        $assets = $this->createAssetsCollection($mapParams);
        $this->map = $this->buildMap($mapParams, $assets);
        $this->mapSaver = new MapSaver($this->map);

    }

    /**
     * @param MapParamsStructureInterface $mapParams
     * @return array
     * @throws \Exception
     */
    private function createAssetsCollection(MapParamsStructureInterface $mapParams): array
    {
        $assetsCollection = new AssetsCollection($mapParams->getFullAssetsPath(), $mapParams->getAssetsExt());
        return $assetsCollection->getAssets();
    }

    /**
     * @param MapParamsStructureInterface $mapParams
     * @param array $assets
     * @return MapInterface
     */
    private function buildMap(MapParamsStructureInterface $mapParams, array $assets): MapInterface
    {
        $mapBuilder = new ($this->algorithmNamespace . $mapParams->getAlgorithmName())($assets, $mapParams->getWidth(), $mapParams->getHeight());
        $mapBuilder->build();
        return $mapBuilder->getMap();
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function generateOneFileMap() : string
    {
        $this->mapSaver->saveToFile($this->oneFileMapPath, $this->savedMapExt);

        return json_encode($this->mapSaver);

        //return $this->mapSaver->saveToFile($this->oneFileMapPath, $this->savedMapExt);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function generateManyFilesMap() : string
    {
        $this->mapSaver->saveToManyFiles($this->manyFilesMapPath, $this->savedMapExt);

        return json_encode($this->mapSaver);

        //return $this->mapSaver->saveToManyFiles($this->manyFilesMapPath, $this->savedMapExt);
    }
}