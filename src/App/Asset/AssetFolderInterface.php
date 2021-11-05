<?php
namespace App\Asset;

interface AssetFolderInterface
{
    /**
     * @param string $path
     */
    public function __construct(string $path);

    /**
     * @return array
     */
    public function getFolderList(): array;
}
