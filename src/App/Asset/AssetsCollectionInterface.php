<?php

namespace App\Asset;

interface AssetsCollectionInterface
{
    /**
     * @return array
     */
    public function getAssets() : array;


    public function getAssetsArray() : array;
}
