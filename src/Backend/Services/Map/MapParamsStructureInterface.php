<?php

namespace Backend\Services\Map;

interface MapParamsStructureInterface
{
    /**
     * @return string
     */
    public function getAssetsPath(): string;

    /**
     * @return string
     */
    public function getAssetsExt(): string;

    /**
     * @return string
     */
    public function getPackName(): string;

    /**
     * @return string
     */
    public function getAlgorithmName(): string;

    /**
     * @return int
     */
    public function getWidth(): int;

    /**
     * @return int
     */
    public function getHeight(): int;

    /**
     * @return string
     */
    public function getFullAssetsPath(): string;
}
