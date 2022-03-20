<?php

namespace Backend\Controllers;

use Backend\Services\GeneratorService;

class GeneratorController
{
    public function generateOneFileMap(array $data): string
    {
        $generatorService = new GeneratorService($data);
        $response = $generatorService->generateOneFileMap();

        debug($data);

        return json_decode($response);
    }

    public function generateManyFilesMap(array $data)
    {
        $generatorService = new GeneratorService($data);
        $response = $generatorService->generateManyFilesMap();

        debug($data);

        return json_decode($response);
    }
}
