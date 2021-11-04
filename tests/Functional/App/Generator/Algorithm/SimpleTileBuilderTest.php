<?php

namespace Test\Functional\App\Generator\Algorithm;

use App\Asset\AssetFilesCollection;
use App\Generator\Algorithm\SimpleTileBuilder;
use App\Generator\MapBuilderInterface;
use PHPUnit\Framework\TestCase;

class SimpleTileBuilderTest extends TestCase
{
    private MapBuilderInterface $mapBuilder;

    public function setUp(): void
    {
        $assetsCollection = new AssetFilesCollection('Assets\Test\\', 'png');
        $assets = $assetsCollection->getAssets();

        $this->mapBuilder = new SimpleTileBuilder($assets, 5, 7);
        $this->mapBuilder->build();
    }

    public function testWidthInTilesForBuiltMap()
    {
        $map = $this->mapBuilder->getMap();
        self::assertEquals(5, $map->getWidthInTiles());
    }

    public function testHeightInTilesForBuiltMap()
    {
        $map = $this->mapBuilder->getMap();
        self::assertEquals(7, $map->getHeightInTiles());
    }

    public function testWidthInPixelsForBuiltMap()
    {
        $map = $this->mapBuilder->getMap();
        self::assertEquals(500, $map->getWidthInPixels());
    }

    public function testHeightInPixelsForBuiltMap()
    {
        $map = $this->mapBuilder->getMap();
        self::assertEquals(700, $map->getHeightInPixels());
    }

    /**
     * @dataProvider getCasesForTilesFitInRow
     * @param $x1
     * @param $y1
     * @param $x2
     * @param $y2
     */
    public function testPairTilesFitInRowForBuiltMap($x1, $y1, $x2, $y2)
    {
        $map = $this->mapBuilder->getMap();
        $tile_1 = $map->getTile($x1,$y1);
        $tile_2 = $map->getTile($x2,$y2);

        self::assertEquals($tile_1->getRightSide(), $tile_2->getLeftSide());
    }

    /**
     * @dataProvider getCasesForTilesFitInColumn
     * @param $x1
     * @param $y1
     * @param $x2
     * @param $y2
     */
    public function testPairTilesFitInColumnForBuiltMap($x1, $y1, $x2, $y2)
    {
        $map = $this->mapBuilder->getMap();
        $tile_1 = $map->getTile($x1,$y1);
        $tile_2 = $map->getTile($x2,$y2);

        self::assertEquals($tile_1->getBottomSide(), $tile_2->getTopSide());
    }

    /**
     * @return array
     */
    public function getCasesForTilesFitInRow(): array
    {
        $Cases = [];

        $xSize = 5;
        $ySize = 7;

        for($y = 0; $y < $ySize; $y++){
            // Don't check the last tile in row, because it has been checked in the previous step
            for($x = 0; $x < $xSize - 1; $x++) {
                $x1 = $x + 1;
                $Cases['coords__' . $x . '_' . $y . '__' . $x1 . '_' . $y] = [$x, $y, $x1, $y];
            }
        }

        return $Cases;
    }

    /**
     * @return array
     */
    public function getCasesForTilesFitInColumn(): array
    {
        $Cases = [];

        $xSize = 5;
        $ySize = 7;

        // Don't check the last tile in column, because it has been checked in the previous step
        for($y = 0; $y < $ySize - 1; $y++){

            $y1 = $y + 1;

            for($x = 0; $x < $xSize; $x++) {
                $Cases['coords__' . $x . '_' . $y . '__' . $x . '_' . $y1] = [$x, $y, $x, $y1];
            }
        }

        return $Cases;
    }
}
