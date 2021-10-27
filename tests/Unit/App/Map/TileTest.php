<?php

namespace Test\Unit\App\Map;

use App\Asset\Asset;
use App\Asset\AssetInterface;
use App\Map\Tile;
use App\Map\TileInterface;
use PHPUnit\Framework\TestCase;

class TileTest extends TestCase
{
    private TileInterface $tile;

    public function setUp(): void
    {
        $asset = self::createAsset();
        $this->tile = self::createTile($asset);
    }

    public function testSetAsset()
    {
        self::assertEquals('Assets\Test\1_0_R_G_R_R.png', $this->tile->getAsset()->getPath());
        self::assertEquals('1_0_R_G_R_R.png', $this->tile->getAsset()->getNameExt());
        self::assertEquals('1_0_R_G_R_R', $this->tile->getAsset()->getName());
        self::assertEquals('png', $this->tile->getAsset()->getExt());
    }

    public function testSetWidth()
    {
        self::assertEquals(100, $this->tile->getWidth());
    }

    public function testSetHeight()
    {
        self::assertEquals(100, $this->tile->getHeight());
    }

    public function testSetType()
    {
        self::assertEquals(1, $this->tile->getType());
    }

    public function testSetTopSide()
    {
        self::assertEquals('R', $this->tile->getTopSide());
    }

    public function testSetRightSide()
    {
        self::assertEquals('G', $this->tile->getRightSide());
    }

    public function testSetBottomSide()
    {
        self::assertEquals('R', $this->tile->getBottomSide());
    }

    public function testSetLeftSide()
    {
        self::assertEquals('R', $this->tile->getLeftSide());
    }

    public function testGetInvertTopSide()
    {
        self::assertEquals('R', $this->tile->getInvertedSide('top'));
    }

    public function testGetInvertRightSide()
    {
        self::assertEquals('R', $this->tile->getInvertedSide('right'));
    }

    public function testGetInvertBottomSide()
    {
        self::assertEquals('R', $this->tile->getInvertedSide('bottom'));
    }

    public function testGetInvertLeftSide()
    {
        self::assertEquals('G', $this->tile->getInvertedSide('left'));
    }

    private static function createTile(AssetInterface $asset) : TileInterface
    {
        return new Tile($asset);
    }

    private static function createAsset() : AssetInterface
    {
        return new Asset('Assets\Test\1_0_R_G_R_R.png', "1_0_R_G_R_R.png", "png");
    }
}
