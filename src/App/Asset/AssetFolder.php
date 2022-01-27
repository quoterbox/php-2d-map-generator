<?php

namespace App\Asset;

class AssetFolder implements AssetFolderInterface
{
    /**
     * @var string
     */
    private string $path;

    /**
     * @var string
     */
    private string $name;

    /**
     * @param string $name
     * @param string $path
     */
    public function __construct(string $name, string $path)
    {
        $this->name = $name;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}
