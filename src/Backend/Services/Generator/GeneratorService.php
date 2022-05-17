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
    private string $oneFileMapPath = 'saved/FromImageSaver/OneFileMap/';

    /**
     * @var string
     */
    private string $manyFilesMapPath = 'saved/FromImageSaver/ManyFilesMap/';

    /**
     * @var string
     */
    private string $savedMapExt = 'png';

    /**
     * @var string
     */
    private string $userId;

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
        $this->userId = md5(session_id() . "loc2d");
        $this->manyFilesMapPath = $this->manyFilesMapPath . DIRECTORY_SEPARATOR . $this->userId . DIRECTORY_SEPARATOR;

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
        $className = $this->algorithmNamespace . $mapParams->getAlgorithmName();

        $mapBuilder = new $className($assets, $mapParams->getWidth(), $mapParams->getHeight());
        $mapBuilder->build();
        return $mapBuilder->getMap();
    }

    /**
     * @return MapSaverInterface
     * @throws \Exception
     */
    public function generateOneFileMap() : MapSaverInterface
    {
        $this->mapSaver->saveToFile($this->oneFileMapPath, $this->savedMapExt, 'map' . $this->userId);
        return $this->mapSaver;
    }

    /**
     * @return MapSaverInterface
     * @throws \Exception
     */
    public function generateManyFilesMap() : MapSaverInterface
    {
        $this->mapSaver->saveToManyFiles($this->manyFilesMapPath, $this->savedMapExt);
        return $this->mapSaver;
    }
}
