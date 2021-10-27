<?php

namespace Test\Unit\App\MapSaver;

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
        $this->removeTestFiles('Saved\Temp\Test\\');

        $asset = self::createAsset('Assets\Test\1_0_G_R_R_R.png', "1_0_G_R_R_R.png", "png");
        $tile = self::createTile($asset);
        $map = self::createMap(2,2);

        $map->addTile($tile, 0,0);
        $map->addTile($tile, 1,0);
        $map->addTile($tile, 0,1);
        $map->addTile($tile, 1,1);

        $this->mapSaver = self::createMapSaver($map);
    }

    public function testSaveMapToFilePNGWithoutName()
    {
        $savePath = $this->mapSaver->saveToFile('Saved\Temp\Test\FullMap\\', 'png');
        self::assertDirectoryExists('Saved\Temp\Test\FullMap\\');
        self::assertFileExists($savePath);
    }

    public function testSaveMapToFileJPGWithoutName()
    {
        $savePath = $this->mapSaver->saveToFile('Saved\Temp\Test\FullMap\\', 'jpg');
        self::assertDirectoryExists('Saved\Temp\Test\FullMap\\');
        self::assertFileExists($savePath);
    }

    public function testSaveMapToFileGIFWithoutName()
    {
        $savePath = $this->mapSaver->saveToFile('Saved\Temp\Test\FullMap\\', 'gif');
        self::assertDirectoryExists('Saved\Temp\Test\FullMap\\');
        self::assertFileExists($savePath);
    }

    public function testSaveMapToFileWEBPWithoutName()
    {
        $savePath = $this->mapSaver->saveToFile('Saved\Temp\Test\FullMap\\', 'webp');
        self::assertDirectoryExists('Saved\Temp\Test\FullMap\\');
        self::assertFileExists($savePath);
    }

    public function testSaveMapToFilePNGWithName()
    {
        $this->mapSaver->saveToFile('Saved\Temp\Test\FullMap\\', 'png' , 'TestMap');
        self::assertFileExists('Saved\Temp\Test\FullMap\TestMap.png');
    }

    public function testSaveMapToFileJPGWithName()
    {
        $this->mapSaver->saveToFile('Saved\Temp\Test\FullMap\\', 'jpg', 'TestMap');
        self::assertFileExists('Saved\Temp\Test\FullMap\TestMap.jpg');
    }

    public function testSaveMapToFileGIFWithName()
    {
        $this->mapSaver->saveToFile('Saved\Temp\Test\FullMap\\', 'gif', 'TestMap');
        self::assertFileExists('Saved\Temp\Test\FullMap\TestMap.gif');
    }

    public function testSaveMapToFileWEBPWithName()
    {
        $this->mapSaver->saveToFile('Saved\Temp\Test\FullMap\\', 'webp', 'TestMap');
        self::assertFileExists('Saved\Temp\Test\FullMap\TestMap.webp');
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

    private static function createAsset(string $assetPath, string $assetNameExt, string $assetExt) : AssetInterface
    {
        return new Asset($assetPath, $assetNameExt, $assetExt);
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