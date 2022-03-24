<?php

namespace Backend\Controllers;

use Backend\Services\Generator\GeneratorService;
use Backend\Services\Map\MapParamsStructure;

class GeneratorController
{
    /**
     * @param array $MapParams
     * @return string
     * @throws \Exception
     */
    public function generateOneFileMap(array $MapParams) : string
    {
        $mapParams = new MapParamsStructure($MapParams);
        $generatorService = new GeneratorService($mapParams);

        return json_encode($generatorService->generateOneFileMap());
    }

    /**
     * @param array $MapParams
     * @return string
     * @throws \Exception
     */
    public function generateManyFilesMap(array $MapParams) : string
    {
        $mapParams = new MapParamsStructure($MapParams);
        $generatorService = new GeneratorService($mapParams);

        return json_encode($generatorService->generateManyFilesMap());
    }
}

