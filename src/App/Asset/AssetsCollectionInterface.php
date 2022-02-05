<?php

namespace App\Asset;

interface AssetsCollectionInterface
{
    /**
     * @return array
     */
    public function getAssets(): array;

    /**
     * @return array
     */
    public function getAssetsLikeArray(): array;
}
