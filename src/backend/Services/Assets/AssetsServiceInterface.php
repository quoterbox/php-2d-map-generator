<?php

namespace Backend\Services\Assets;

interface AssetsServiceInterface
{
    /**
     * @param string $assetsPath
     */
    public function __construct(string $assetsPath);

    /**
     * @return array
     */
    public function getAssetPacks(): array;
}
