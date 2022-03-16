<?php

namespace Backend\Controllers;

use Backend\Services\AlgorithmsService;
use Backend\Services\AlgorithmsServiceInterface;

class AlgorithmsController
{
    /**
     * @var string
     */
    private string $algorithmsPath = '..\App\Generator\Algorithm\\';

    /**
     * @var string
     */
    private string $fileExt = 'php';

    /**
     * @var AlgorithmsServiceInterface|AlgorithmsService
     */
    private AlgorithmsServiceInterface $algorithmsService;

    /**
     *
     */
    public function __construct()
    {
        $this->algorithmsService = new AlgorithmsService($this->algorithmsPath, $this->fileExt);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getAlgorithms(): string
    {
        return json_encode($this->algorithmsService->getAlgorithms());
    }
}
