<?php
namespace App\Asset;

interface AssetFolderCollectionInterface
{
    /**
     * @param string $path
     */
    public function __construct(string $path);

    /**
     * @return array
     */
    public function getAssetsFolders(): array;
}
