<?php

namespace App\Asset;

interface AssetInterface
{
    public function getAssets() : array;
    public function loadAssets();
}
