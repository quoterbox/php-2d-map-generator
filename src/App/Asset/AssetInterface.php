<?php

namespace App\Asset;

interface AssetInterface
{
    public function __construct(string $assetPath, string $assetNameExt, string $assetExt);
    public function getPath() : string;
    public function getName() : string;
    public function getNameExt() : string;
    public function getExt() : string;
    public function getWidth() : int;
    public function getHeight() : int;
}
