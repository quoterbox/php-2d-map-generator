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
        $this->assetFolder = new AssetFolder('src\public\assets\TestFolders\\');
    }

    public function testGetFolderList()
    {
        $foldersList = $this->assetFolder->getFolderList();

        self::assertCount(5, $foldersList);
        self::assertEquals('TestFolder1', $foldersList[0]['name']);
        self::assertEquals('src\public\assets\TestFolders\TestFolder1\\', $foldersList[0]['path']);
        self::assertEquals('TestFolder2', $foldersList[1]['name']);
        self::assertEquals('src\public\assets\TestFolders\TestFolder2\\', $foldersList[1]['path']);
        self::assertEquals('TestFolder3', $foldersList[2]['name']);
        self::assertEquals('src\public\assets\TestFolders\TestFolder3\\', $foldersList[2]['path']);
        self::assertEquals('TestFolder4', $foldersList[3]['name']);
        self::assertEquals('src\public\assets\TestFolders\TestFolder4\\', $foldersList[3]['path']);
        self::assertEquals('TestFolder5', $foldersList[4]['name']);
        self::assertEquals('src\public\assets\TestFolders\TestFolder5\\', $foldersList[4]['path']);
    }
}
