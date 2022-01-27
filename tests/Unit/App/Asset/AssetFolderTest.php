<?php

namespace Test\Unit\App\Asset;

use App\Asset\AssetFolder;
use App\Asset\AssetFolderInterface;
use PHPUnit\Framework\TestCase;

class AssetFolderTest extends TestCase
{
    private AssetFolderInterface $assetFolder;

    public function setUp(): void
    {
        $this->assetFolder = new AssetFolder('TestFolder1','src\public\assets\TestFolders\TestFolder1\\');
    }

    public function testGetFolderList()
    {
        self::assertEquals('TestFolder1', $this->assetFolder->getName());
        self::assertEquals('src\public\assets\TestFolders\TestFolder1\\', $this->assetFolder->getPath());
    }
}
