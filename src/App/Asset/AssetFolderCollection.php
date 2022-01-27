<?php

namespace App\Asset;

use DirectoryIterator;

class AssetFolderCollection implements AssetFolderCollectionInterface
{
    /**
     * @var string
     */
    private string $path;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return array|AssetFolderInterface[]
     */
    public function getAssetsFolders(): array
    {
        $assetFolders = [];
        $dirIterators = new DirectoryIterator($this->path);

        foreach($dirIterators as $dirIterator) {

            if ( $dirIterator->isDir() && !$dirIterator->isDot() ) {

                $assetFolders[] = new AssetFolder($dirIterator->getFileName(), $dirIterator->getPathname() . DIRECTORY_SEPARATOR);

            }
        }

        return $assetFolders;
    }
}
