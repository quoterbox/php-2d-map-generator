<?php

namespace Backend\Controllers;

use Backend\Services\Algorithms\AlgorithmsService;
use Backend\Services\Algorithms\AlgorithmsServiceInterface;

class AlgorithmsController
{
    /**
     * @var \Backend\Services\Algorithms\AlgorithmsServiceInterface|AlgorithmsService
     */
    private AlgorithmsServiceInterface $algorithmsService;

    /**
     *
     */
    public function __construct()
    {
        $this->algorithmsService = new AlgorithmsService('../App/Generator/Algorithm/', 'php');
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
