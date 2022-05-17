<?php

namespace Backend\Services\Generator;

use App\MapSaver\MapSaverInterface;
use Backend\Services\Map\MapParamsStructureInterface;

interface GeneratorServiceInterface
{
    /**
     * @param MapParamsStructureInterface $mapParams
     */
    public function __construct(MapParamsStructureInterface $mapParams);

    /**
     * @return MapSaverInterface
     */
    public function generateOneFileMap() : MapSaverInterface;

    /**
     * @return MapSaverInterface
     */
    public function generateManyFilesMap() : MapSaverInterface;
}
