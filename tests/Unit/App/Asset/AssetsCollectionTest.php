<?php

namespace Test\Unit\App\Asset;

use App\Asset\AssetsCollection;
use PHPUnit\Framework\TestCase;

class AssetsCollectionTest extends TestCase
{
    public function testCountGetAssetsWithExtension()
    {
        $assets = (self::createAssetFilesCollectionWithExtension())->getAssets();
        self::assertCount(5, $assets);
    }

    public function testCountGetAssetsNoExtension()
    {
        $assets = (self::createAssetFilesCollectionNoExtension())->getAssets();
        self::assertCount(8, $assets);
    }

    public function testGetAssetsNameWithExtension()
    {
        $assets = (self::createAssetFilesCollectionWithExtension())->getAssets();
        self::assertEquals('1_0_G_R_R_R.png', $assets[0]->getNameExt());
        self::assertEquals('1_0_R_G_R_R.png', $assets[1]->getNameExt());
        self::assertEquals('1_0_R_R_G_R.png', $assets[2]->getNameExt());
        self::assertEquals('1_0_R_R_R_G.png', $assets[3]->getNameExt());
        self::assertEquals('3_1_G.png', $assets[4]->getNameExt());
    }

    public function testGetAssetsNameNoExtension()
    {
        $assets = (self::createAssetFilesCollectionNoExtension())->getAssets();
        self::assertEquals('1_0_G_G_R_R.jpg', $assets[0]->getNameExt());
        self::assertEquals('1_0_G_R_R_R.png', $assets[1]->getNameExt());
        self::assertEquals('1_0_R_G_G_R.jpg', $assets[2]->getNameExt());
        self::assertEquals('1_0_R_G_R_R.png', $assets[3]->getNameExt());
        self::assertEquals('1_0_R_R_G_R.png', $assets[4]->getNameExt());
        self::assertEquals('1_0_R_R_R_G.png', $assets[5]->getNameExt());
        self::assertEquals('2_1_G.gif', $assets[6]->getNameExt());
        self::assertEquals('3_1_G.png', $assets[7]->getNameExt());
    }

    public function testGetAssetsPathWithExtension()
    {
        $assets = (self::createAssetFilesCollectionWithExtension())->getAssets();
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_G_R_R_R.png', $assets[0]->getPath());
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_G_R_R.png', $assets[1]->getPath());
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_R_G_R.png', $assets[2]->getPath());
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_R_R_G.png', $assets[3]->getPath());
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '3_1_G.png', $assets[4]->getPath());
    }

    public function testGetAssetsPathNoExtension()
    {
        $assets = (self::createAssetFilesCollectionNoExtension())->getAssets();
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_G_G_R_R.jpg', $assets[0]->getPath());
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_G_R_R_R.png', $assets[1]->getPath());
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_G_G_R.jpg', $assets[2]->getPath());
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_G_R_R.png', $assets[3]->getPath());
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_R_G_R.png', $assets[4]->getPath());
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_R_R_G.png', $assets[5]->getPath());
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '2_1_G.gif', $assets[6]->getPath());
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '3_1_G.png', $assets[7]->getPath());
    }

    public function testGetAssetsNameLikeArrayWithExtension()
    {
        $assets = (self::createAssetFilesCollectionWithExtension())->getAssetsLikeArray();
        self::assertEquals('1_0_G_R_R_R.png', $assets[0]['nameExt']);
        self::assertEquals('1_0_R_G_R_R.png', $assets[1]['nameExt']);
        self::assertEquals('1_0_R_R_G_R.png', $assets[2]['nameExt']);
        self::assertEquals('1_0_R_R_R_G.png', $assets[3]['nameExt']);
        self::assertEquals('3_1_G.png', $assets[4]['nameExt']);
    }

    public function testGetAssetsNameLikeArrayNoExtension()
    {
        $assets = (self::createAssetFilesCollectionNoExtension())->getAssetsLikeArray();
        self::assertEquals('1_0_G_G_R_R.jpg', $assets[0]['nameExt']);
        self::assertEquals('1_0_G_R_R_R.png', $assets[1]['nameExt']);
        self::assertEquals('1_0_R_G_G_R.jpg', $assets[2]['nameExt']);
        self::assertEquals('1_0_R_G_R_R.png', $assets[3]['nameExt']);
        self::assertEquals('1_0_R_R_G_R.png', $assets[4]['nameExt']);
        self::assertEquals('1_0_R_R_R_G.png', $assets[5]['nameExt']);
        self::assertEquals('2_1_G.gif', $assets[6]['nameExt']);
        self::assertEquals('3_1_G.png', $assets[7]['nameExt']);
    }

    public function testGetAssetsPathLikeArrayWithExtension()
    {
        $assets = (self::createAssetFilesCollectionWithExtension())->getAssetsLikeArray();
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_G_R_R_R.png', $assets[0]['path']);
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_G_R_R.png', $assets[1]['path']);
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_R_G_R.png', $assets[2]['path']);
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_R_R_G.png', $assets[3]['path']);
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '3_1_G.png', $assets[4]['path']);
    }

    public function testGetAssetsPathLikeArrayNoExtension()
    {
        $assets = (self::createAssetFilesCollectionNoExtension())->getAssetsLikeArray();
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_G_G_R_R.jpg', $assets[0]['path']);
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_G_R_R_R.png', $assets[1]['path']);
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_G_G_R.jpg', $assets[2]['path']);
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_G_R_R.png', $assets[3]['path']);
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_R_G_R.png', $assets[4]['path']);
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '1_0_R_R_R_G.png', $assets[5]['path']);
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '2_1_G.gif', $assets[6]['path']);
        self::assertEquals('src/public/assets/Test' . DIRECTORY_SEPARATOR . '3_1_G.png', $assets[7]['path']);
    }

    private static function createAssetFilesCollectionWithExtension() : AssetsCollection
    {
        return new AssetsCollection('src/public/assets/Test/', 'png');
    }

    private static function createAssetFilesCollectionNoExtension() : AssetsCollection
    {
        return new AssetsCollection('src/public/assets/Test/');
    }
}
