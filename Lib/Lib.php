<?php
function debug($message) : void
{
    messInfo($message);
    die("DEBUG END");
}

function messInfo($text) : void
{
	echo '<pre>';
	print_r($text);
	echo '</pre>';
}

function readFiles(string $folder, string $filesExt) : array
{
    $files = [];
    $validExt = [$filesExt];

    $dir = new RecursiveDirectoryIterator($folder);
    $dirIterator = new RecursiveIteratorIterator($dir);

    foreach($dirIterator as $val){

        if($val->isFile()){

            $file_path = $val->getPathname();

            $arPath = explode('.',$file_path);
            $file_path_ext = end($arPath);
            $fileExt = $val->getExtension();
            $fileNameExt = $val->getFilename();

            if( in_array($file_path_ext, $validExt) ){

                list($width, $height) = getimagesize($file_path);

                $files[] = [
                    'path' => $file_path,
                    'name' => str_replace("." . $fileExt, "", $fileNameExt),
                    'name_ext' => $fileNameExt,
                    'ext' => $fileExt,
                    'width' => $width,
                    'height' => $height
                ];
            }
        }

    }

    return $files;
}

function getDataFromName(array $tile) : array
{
    $Props = [];
    $delimiter = '_';
    $assetName = $tile['name'];
    $assetPath = $tile['path'];
    $assetExt = $tile['ext'];
    $assetNameExt = $tile['name_ext'];
    $assetWidth = $tile['width'];
    $assetHeight = $tile['height'];

    if(strpos($assetName, $delimiter) !== false){

        $RawProps = explode($delimiter, $assetName);
        $cntProps = count($RawProps);

        if($cntProps !== 6 && empty($RawProps[1]) || $cntProps !== 3 && !empty($RawProps[1])){
            debug('Invalid file name: ' . $assetName);
        }

        $wholeSides = $RawProps[1];

        $Props = [
            'name' => $assetName,
            'path' => $assetPath,
            'name_ext' => $assetNameExt,
            'ext' => $assetExt,
            'type' => $RawProps[0],
            'top' => $RawProps[2],
            'right' => $wholeSides ? $RawProps[2] : $RawProps[3],
            'bottom' => $wholeSides ? $RawProps[2] : $RawProps[4],
            'left' => $wholeSides ? $RawProps[2] : $RawProps[5],
            'width' => $assetWidth,
            'height' => $assetHeight
        ];

    }else{
        debug('Invalid file name: ' . $assetName);
    }

    return $Props;
}

function selectStartTileIndex(array $tiles) : int
{
    return rand(0, count($tiles) - 1);
}

function setStartCoord(int $size) : int
{
    return round($size/2, 0, PHP_ROUND_HALF_DOWN);
}

function WFC(array $tiles, int $xSize, int $ySize) : array
{
    $map = [];

    $xCurr = setStartCoord($xSize);
    $yCurr = setStartCoord($ySize);

    // First tile
    $startTileIndex = selectStartTileIndex($tiles);
    $map[$xCurr][$yCurr] = $tiles[$startTileIndex];

    $xInit = $xCurr;
    $yInitRB = ++$yCurr;
    $yInitLT = $yCurr - 2;

    //
    //  Tiles to Right and Bottom
    //

    $cnt_x = 0;

    for ($xCurr = $xInit; $xCurr < $xSize; $xCurr++){
        for ($yCurr = $yInitRB; $yCurr < $ySize; $yCurr++){
            $neighborTiles = getNeighborTiles($map, $xCurr, $yCurr);
            $map[$xCurr][$yCurr] = getFitTile($tiles, $neighborTiles);
        }

        if($cnt_x == 0){
            $yInitRB = 0;
        }

        $cnt_x++;
    }

    //
    //  Tiles to Left and Top
    //

    $cnt_x = 0;

    for ($xCurr = $xInit; $xCurr >= 0; $xCurr--){
        for ($yCurr = $yInitLT; $yCurr >= 0; $yCurr--){
            $neighborTiles = getNeighborTiles($map, $xCurr, $yCurr);
            $map[$xCurr][$yCurr] = getFitTile($tiles, $neighborTiles);
        }

        if($cnt_x == 0){
            $yInitLT = $ySize - 1;
        }

        $cnt_x++;
    }

    return $map;
}

function getFitTile(array $tiles, array $neighborTiles) : array
{
    $neededSides = [];

    foreach ($neighborTiles as $sideName => $neighborTile){

        $invertSide = invertSideName($sideName);
        $neededSides[$sideName] = !empty($neighborTile) ? $neighborTile[$invertSide] : false;

    }

    return getNeededTile($tiles, $neededSides);
}

function chooseOneTile(array $tiles) : array
{
    if(empty($tiles)){

        //debug('No fit tile!');

        return [
            'name' => 'empty',
            'path' => 'Assets' . DIRECTORY_SEPARATOR . 'empty.png',
            'name_ext' => 'empty.png',
            'ext' => 'png',
            'type' => '1',
            'top' => false,
            'right' => false,
            'bottom' => false,
            'left' => false,
        ];

    }else{
        $cntTiles = count($tiles);
        $randIndex = rand(0, $cntTiles - 1);

        return $tiles[$randIndex];
    }
}

function getNeededTile(array $tiles, array $neededSides) : array
{
    $neededTiles = [];

    foreach ($tiles as $tile){

        $isNeeded = true;

        foreach ($neededSides as $needSideName => $neededSide){

            // если клетка с этой стороны не заполнена, то подойдет любая сторона
            if(!empty($neededSide)){

                if($tile[$needSideName] !== $neededSide){
                    $isNeeded = false;
                }

            }

        }

        if($isNeeded){
            $neededTiles[] = $tile;
        }
    }

    return chooseOneTile($neededTiles);
}

function invertSideName(string $side) : string
{
    if($side === "top"){
        return "bottom";
    }elseif($side === "bottom"){
        return "top";
    }elseif($side === "left"){
        return "right";
    }elseif($side === "right"){
        return "left";
    }

    return "";
}

function getNeighborTiles(array $map, int $x, int $y) : array
{
    return [
        'top' => isExistTile($map, $x - 1, $y) ? $map[$x - 1][$y] : false,
        'right' => isExistTile($map, $x, $y + 1) ? $map[$x][$y + 1] : false,
        'bottom' => isExistTile($map, $x + 1, $y) ? $map[$x + 1][$y] : false,
        'left' => isExistTile($map, $x, $y - 1) ? $map[$x][$y - 1] : false,
    ];
}

function isExistTile(array $map, int $x, int $y) : bool
{
    return !empty($map[$x][$y]);
}


















