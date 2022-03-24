<?php

namespace Backend\Services\Assets;

interface AssetsServiceInterface
{
    public function __construct(string $assetsPath);

    /**
     * @return array
     */
    public function getAssetPacks(): array;
}
