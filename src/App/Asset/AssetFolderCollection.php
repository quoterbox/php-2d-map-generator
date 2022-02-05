<?php

namespace App\Asset;

use Exception;
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
     * @return array
     * @throws Exception
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

        if(empty($assetFolders)){
            throw new Exception("Asset folder is empty");
        }

        return $assetFolders;
    }
}
