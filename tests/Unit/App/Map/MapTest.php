<?php


namespace Test\Unit\App\Map;

use App\Asset\Asset;
use App\Asset\AssetInterface;
use App\Map\Map;
use App\Map\MapInterface;
use App\Map\Tile;
use App\Map\TileInterface;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    private MapInterface $map;
    private TileInterface $tile;

    public function setUp(): void
    {
        $asset = self::createAsset();
        $this->tile = self::createTile($asset);
        $this->map = self::createMap(10,15);
    }

    public function testGetEmptyArray()
    {
        self::assertEmpty((self::createMap(5, 5))->getArray());
    }

    public function testAddTile()
    {
        $x = 3;
        $y = 9;

        $this->map->addTile($this->tile, $x, $y);

        self::assertEquals(1, $this->map->getTile($x, $y)->getType());
        self::assertEquals('G', $this->map->getTile($x, $y)->getTopSide());
        self::assertEquals('R', $this->map->getTile($x, $y)->getRightSide());
        self::assertEquals('R', $this->map->getTile($x, $y)->getBottomSide());
        self::assertEquals('R', $this->map->getTile($x, $y)->getLeftSide());
        self::assertEquals('R', $this->map->getTile($x, $y)->getLeftSide());
        self::assertEquals(100, $this->map->getTile($x, $y)->getWidth());
        self::assertEquals(100, $this->map->getTile($x, $y)->getHeight());
        self::assertEquals('Assets\Test\1_0_G_R_R_R.png', $this->map->getTile($x, $y)->getAsset()->getPath());
    }

    public function testSetMapWidthInTiles()
    {
        self::assertEquals(10, (self::createMap(10, 15))->getWidthInTiles());
    }

    public function testSetMapHeightInTiles()
    {
        self::assertEquals(15, (self::createMap(10, 15))->getHeightInTiles());
    }

    public function testSetWidthInPixels()
    {
        $this->map->addTile($this->tile, 3, 9);
        $this->map->addTile($this->tile, 4, 9);

        self::assertEquals(200, $this->map->getWidthInPixels());
    }

    public function testSetHeightPixels()
    {
        $this->map->addTile($this->tile, 3, 8);
        $this->map->addTile($this->tile, 3, 9);
        $this->map->addTile($this->tile, 3, 10);

        self::assertEquals(300, $this->map->getHeightInPixels());
    }

    private static function createTile(AssetInterface $asset) : TileInterface
    {
        return new Tile($asset);
    }

    private static function createAsset() : AssetInterface
    {
        return new Asset('Assets\Test\1_0_G_R_R_R.png', "1_0_G_R_R_R.png", "png");
    }

    private static function createMap(int $width, int $height) : MapInterface
    {
        return new Map($width,$height);
    }
}
