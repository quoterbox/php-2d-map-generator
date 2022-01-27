<?php

namespace Test\Unit\App\Asset;

use App\Asset\AssetFolderCollection;
use App\Asset\AssetFolderCollectionInterface;
use PHPUnit\Framework\TestCase;

class AssetFolderCollectionTest extends TestCase
{
    private AssetFolderCollectionInterface $assetFolder;

    public function setUp(): void
    {
        $this->assetFolder = new AssetFolderCollection('src\public\assets\TestFolders\\');
    }

    public function testGetFolderList()
    {
        $assetsFolders = $this->assetFolder->getAssetsFolders();

        self::assertCount(5, $assetsFolders);
        self::assertEquals('TestFolder1', $assetsFolders[0]->getName());
        self::assertEquals('src\public\assets\TestFolders\TestFolder1\\', $assetsFolders[0]->getPath());
        self::assertEquals('TestFolder2', $assetsFolders[1]->getName());
        self::assertEquals('src\public\assets\TestFolders\TestFolder2\\', $assetsFolders[1]->getPath());
        self::assertEquals('TestFolder3', $assetsFolders[2]->getName());
        self::assertEquals('src\public\assets\TestFolders\TestFolder3\\', $assetsFolders[2]->getPath());
        self::assertEquals('TestFolder4', $assetsFolders[3]->getName());
        self::assertEquals('src\public\assets\TestFolders\TestFolder4\\', $assetsFolders[3]->getPath());
        self::assertEquals('TestFolder5', $assetsFolders[4]->getName());
        self::assertEquals('src\public\assets\TestFolders\TestFolder5\\', $assetsFolders[4]->getPath());
    }
}
