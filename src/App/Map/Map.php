<?php

namespace App\Map;

class Map extends AbstractMap
{
    public function load(array $mapArray) : void {}
    public function saveToFile(string $destPath, string $destFileExt) : string {return "";}
    public function saveToManyFiles(string $destPath, string $destFileExt) : string {return "";}
    public function getArray() : array {return [];}
}
