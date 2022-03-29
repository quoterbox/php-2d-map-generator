<?php

namespace Backend\Services\Generator;

use Backend\Services\Map\MapParamsStructureInterface;

interface GeneratorServiceInterface
{
    /**
     * @param MapParamsStructureInterface $mapParams
     */
    public function __construct(MapParamsStructureInterface $mapParams);

    /**
     * @return string
     */
    public function generateOneFileMap() : string;

    /**
     * @return string
     */
    public function generateManyFilesMap() : string;
}
