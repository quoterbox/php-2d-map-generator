<?php

namespace Backend\Services;

interface AlgorithmsServiceInterface
{
    /**
     * @param string $algorithmsPath
     * @param string $fileExt
     */
    public function __construct(string $algorithmsPath, string $fileExt);

    /**
     * @return array
     */
    public function getAlgorithms(): array;
}
