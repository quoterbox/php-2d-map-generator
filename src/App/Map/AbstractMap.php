<?php

namespace App\Map;

abstract class AbstractMap implements MapInterface
{
    private int $widthPixels;
    private int $heightPixels;
    private int $widthTiles;
    private int $heightTiles;
}
