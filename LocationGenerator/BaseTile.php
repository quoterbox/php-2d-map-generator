<?php
namespace LocationGenerator;

class BaseTile
{
	private $type;

	private $topSide;
    private $rightSide;
    private $bottomSide;
    private $leftSide;

	private $xCoord = 0;
	private $yCoord = 0;

    private $assetName;

	public function __construct(string $assetName, int $xCoord, int $yCoord)
	{

	}
}