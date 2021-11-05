<?php

namespace Test\Unit\App\Asset;

use App\Asset\AssetFilesCollection;
use PHPUnit\Framework\TestCase;

class AssetFilesCollectionTest extends TestCase
{
    public function testCountGetAssets()
    {
        $assets = (self::createAssetFilesCollection())->getAssets();
        self::assertCount(5, $assets);
    }

    public function testGetAssetName()
    {
        $assets = (self::createAssetFilesCollection())->getAssets();
        self::assertEquals('1_0_G_R_R_R.png', $assets[0]->getNameExt());
        self::assertEquals('1_0_R_G_R_R.png', $assets[1]->getNameExt());
        self::assertEquals('1_0_R_R_G_R.png', $assets[2]->getNameExt());
        self::assertEquals('1_0_R_R_R_G.png', $assets[3]->getNameExt());
        self::assertEquals('3_1_G.png', $assets[4]->getNameExt());
    }

    public function testGetAssetPath()
    {
        $assets = (self::createAssetFilesCollection())->getAssets();
        self::assertEquals('src\public\assets\Test\1_0_G_R_R_R.png', $assets[0]->getPath());
        self::assertEquals('src\public\assets\Test\1_0_R_G_R_R.png', $assets[1]->getPath());
        self::assertEquals('src\public\assets\Test\1_0_R_R_G_R.png', $assets[2]->getPath());
        self::assertEquals('src\public\assets\Test\1_0_R_R_R_G.png', $assets[3]->getPath());
        self::assertEquals('src\public\assets\Test\3_1_G.png', $assets[4]->getPath());
    }

    private static function createAssetFilesCollection() : AssetFilesCollection
    {
        return new AssetFilesCollection('src\public\assets\Test\\', 'png');
    }
}
