<?php

namespace App\Asset;

class Asset
{
    private string $assetPath;
    private string $assetName;
    private string $assetNameExt;
    private string $assetExt;

    public function __construct(string $assetPath, string $assetName, string $assetNameExt, string $assetExt)
    {
        $this->assetPath = $assetPath;
        $this->assetName = $assetName;
        $this->assetNameExt = $assetNameExt;
        $this->assetExt = $assetExt;
    }

    public function getPath() : string
    {
        return $this->assetPath;
    }

    public function getName() : string
    {
        return $this->assetName;
    }

    public function getNameExt() : string
    {
        return $this->assetNameExt;
    }

    public function getExt() : string
    {
        return $this->assetExt;
    }
}
