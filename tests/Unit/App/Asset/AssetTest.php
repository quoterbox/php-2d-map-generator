<?php

namespace Test\Unit\App\Asset;

use App\Asset\Asset;
use App\Asset\AssetInterface;
use PHPUnit\Framework\TestCase;

class AssetTest extends TestCase
{

    public function testSetAssetExtension()
    {
        self::assertEquals('png', (self::createAsset())->getExt());
    }

    public function testSetAssetPath()
    {
        self::assertEquals('src\public\assets\Test\\1_0_G_R_R_R.png', (self::createAsset())->getPath());
    }

    public function testSetAssetName()
    {
        self::assertEquals('1_0_G_R_R_R', (self::createAsset())->getName());
    }

    public function testSetAssetNameExt()
    {
        self::assertEquals('1_0_G_R_R_R.png', (self::createAsset())->getNameExt());
    }

    public function testSetAssetSize()
    {
        self::assertEquals(100, (self::createAsset())->getWidth());
        self::assertEquals(100, (self::createAsset())->getHeight());
    }

    public function testSetPropsEmptyAsset()
    {
        $asset = new Asset('src\public\assets\\EMP.png', "EMP.png", "png");

        self::assertEquals(0, $asset->getType());
        self::assertEmpty($asset->getTopSide());
        self::assertEmpty($asset->getRightSide());
        self::assertEmpty($asset->getBottomSide());
        self::assertEmpty($asset->getLeftSide());
    }

    public function testSetPropsFromName()
    {
        self::assertEquals(1, (self::createAsset())->getType());
        self::assertEquals('G', (self::createAsset())->getTopSide());
        self::assertEquals('R', (self::createAsset())->getRightSide());
        self::assertEquals('R', (self::createAsset())->getBottomSide());
        self::assertEquals('R', (self::createAsset())->getLeftSide());
    }

    public function testGetSideByName()
    {
        self::assertEquals('G', (self::createAsset())->getSideByName("top"));
        self::assertEquals('R', (self::createAsset())->getSideByName("right"));
        self::assertEquals('R', (self::createAsset())->getSideByName("bottom"));
        self::assertEquals('R', (self::createAsset())->getSideByName("left"));
    }

    private static function createAsset() : AssetInterface
    {
        return new Asset('src\public\assets\Test\\1_0_G_R_R_R.png', "1_0_G_R_R_R.png", "png");
    }
}
