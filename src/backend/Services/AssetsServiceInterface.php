<?php

namespace Backend\Services;

interface AssetsServiceInterface
{
    public function __construct(string $assetsPath);

    /**
     * @return array
     */
    public function getAssetPacks(): array;
}
