<?php

namespace Backend\Controllers;

use Backend\Services\Assets\AssetsService;
use Backend\Services\Assets\AssetsServiceInterface;

class AssetsController
{
    /**
     * @var AssetsServiceInterface|AssetsService
     */
    private AssetsServiceInterface $assetsService;

    /**
     *
     */
    public function __construct()
    {
        $this->assetsService = new AssetsService('assets\Tiles\\');
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getAssets(): string
    {
        return json_encode($this->assetsService->getAssetPacks());
    }
}
