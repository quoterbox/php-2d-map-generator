<?php
namespace App\Asset;

interface AssetFolderInterface
{
    /**
     * @param string $name
     * @param string $path
     */
    public function __construct(string $name, string $path);

    /**
     * @return mixed
     */
    public function getName(): string;

    /**
     * @return mixed
     */
    public function getPath(): string;
}
