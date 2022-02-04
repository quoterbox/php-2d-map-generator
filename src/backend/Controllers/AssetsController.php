<?php

namespace Backend\Controllers;

use Backend\Services\AssetsService;
use Backend\Services\AssetsServiceInterface;

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
