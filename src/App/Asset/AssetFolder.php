<?php

namespace App\Asset;

use DirectoryIterator;

class AssetFolder implements AssetFolderInterface
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
     */
    public function getFolderList(): array
    {
        $assetFolders = [];
        $dirIterators = new DirectoryIterator($this->path);

        foreach($dirIterators as $dirIterator) {

            if ($dirIterator->isDir() && !$dirIterator->isDot() ) {

                $assetFolders[] = [
                    "name" => $dirIterator->getFileName(),
                    "path" => $dirIterator->getPathname() . DIRECTORY_SEPARATOR,
                ];

            }
        }

        return $assetFolders;
    }
}
