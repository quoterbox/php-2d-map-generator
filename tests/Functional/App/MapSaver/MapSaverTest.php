<?php

namespace Test\Functional\App\MapSaver;

use App\Asset\Asset;
use App\Asset\AssetInterface;
use App\Map\Map;
use App\Map\MapInterface;
use App\Map\Tile;
use App\Map\TileInterface;
use App\MapSaver\MapSaver;
use App\MapSaver\MapSaverInterface;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use PHPUnit\Framework\TestCase;


class MapSaverTest extends TestCase
{
    private MapSaverInterface $mapSaver;

    public function setUp(): void
    {
        $this->removeTestFiles('src\public\saved\Temp\Test\\');

        $asset = self::createAsset('src\public\assets\Test\\', "1_0_G_R_R_R", "png");
        $tile = self::createTile($asset);
        $map = self::createMap(2,3);

        $map->addTile($tile, 0,0);
        $map->addTile($tile, 1,0);
        $map->addTile($tile, 0,1);
        $map->addTile($tile, 1,1);
        $map->addTile($tile, 0,2);
        $map->addTile($tile, 1,2);

        $this->mapSaver = self::createMapSaver($map);
    }

    public function testSaveMapToFilePNGWithoutName()
    {
        $savePath = $this->mapSaver->saveToFile('src\public\saved\Temp\Test\FullMap\\', 'png');
        self::assertDirectoryExists('src\public\saved\Temp\Test\FullMap\\');
        self::assertFileExists($savePath);
    }

    public function testSaveMapToFileJPGWithoutName()
    {
        $savePath = $this->mapSaver->saveToFile('src\public\saved\Temp\Test\FullMap\\', 'jpg');
        self::assertDirectoryExists('src\public\saved\Temp\Test\FullMap\\');
        self::assertFileExists($savePath);
    }

    public function testSaveMapToFileGIFWithoutName()
    {
        $savePath = $this->mapSaver->saveToFile('src\public\saved\Temp\Test\FullMap\\', 'gif');
        self::assertDirectoryExists('src\public\saved\Temp\Test\FullMap\\');
        self::assertFileExists($savePath);
    }

    public function testSaveMapToFileWEBPWithoutName()
    {
        $savePath = $this->mapSaver->saveToFile('src\public\saved\Temp\Test\FullMap\\', 'webp');
        self::assertDirectoryExists('src\public\saved\Temp\Test\FullMap\\');
        self::assertFileExists($savePath);
    }

    public function testSaveMapToFilePNGWithName()
    {
        $this->mapSaver->saveToFile('src\public\saved\Temp\Test\FullMap\\', 'png' , 'TestMap');
        self::assertFileExists('src\public\saved\Temp\Test\FullMap\TestMap.png');
    }

    public function testSaveMapToFileJPGWithName()
    {
        $this->mapSaver->saveToFile('src\public\saved\Temp\Test\FullMap\\', 'jpg', 'TestMap');
        self::assertFileExists('src\public\saved\Temp\Test\FullMap\TestMap.jpg');
    }

    public function testSaveMapToFileGIFWithName()
    {
        $this->mapSaver->saveToFile('src\public\saved\Temp\Test\FullMap\\', 'gif', 'TestMap');
        self::assertFileExists('src\public\saved\Temp\Test\FullMap\TestMap.gif');
    }

    public function testSaveMapToFileWEBPWithName()
    {
        $this->mapSaver->saveToFile('src\public\saved\Temp\Test\FullMap\\', 'webp', 'TestMap');
        self::assertFileExists('src\public\saved\Temp\Test\FullMap\TestMap.webp');
    }

    public function testSizeImageForSavedMap()
    {
        $this->mapSaver->saveToFile('src\public\saved\Temp\Test\FullMap\\', 'png' , 'TestMap');

        list($width, $height) = getimagesize('src\public\saved\Temp\Test\FullMap\TestMap.png');

        self::assertEquals(200, $width);
        self::assertEquals(300, $height);
    }

    private function removeTestFiles(string $dir): void
    {
        if(is_dir($dir)){
            $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
            $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);

            foreach ($ri as $file){
                $file->isDir() ? rmdir($file) : unlink($file);
            }
        }
    }

    private static function createTile(AssetInterface $asset) : TileInterface
    {
        return new Tile($asset);
    }

    private static function createAsset(string $assetPath, string $assetName, string $assetExt) : AssetInterface
    {
        return new Asset($assetPath, $assetName, $assetExt);
    }

    private static function createMap(int $width, int $height) : MapInterface
    {
        return new Map($width,$height);
    }

    private function createMapSaver(MapInterface $map) : MapSaverInterface
    {
        return new MapSaver($map);
    }
}
