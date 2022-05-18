<?php

namespace Backend\Services\Algorithms;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class AlgorithmsService implements AlgorithmsServiceInterface
{
    /**
     * @var string
     */
    private string $algorithmsPath;

    /**
     * @var string
     */
    private string $fileExt;

    /**
     * @param string $algorithmsPath
     * @param string $fileExt
     */
    public function __construct(string $algorithmsPath, string $fileExt)
    {
        $this->algorithmsPath = $algorithmsPath;
        $this->fileExt = $fileExt;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getAlgorithms(): array
    {
        $Algorithms = [];

        $algorithmsFiles = self::readAlgorithmsInDir($this->algorithmsPath, $this->fileExt);

        foreach ($algorithmsFiles as $algorithmPath){
            $Algorithms[] = self::getAlgorithmInfo($algorithmPath);
        }

        usort($Algorithms, "sortArrayById");

        return $Algorithms;
    }

    /**
     * @param string $path
     * @param string $fileExt
     * @return array
     */
    private static function readAlgorithmsInDir(string $path, string $fileExt): array
    {
        $algorithmsFiles = [];

        $dir = new RecursiveDirectoryIterator($path);
        $dirIterators = new RecursiveIteratorIterator($dir);

        foreach($dirIterators as $dirIterator){

            if ($dirIterator->isFile() && $fileExt === $dirIterator->getExtension()) {
                $algorithmsFiles[] = $dirIterator->getPath() . DIRECTORY_SEPARATOR . $dirIterator->getFilename();
            }

        }

        return $algorithmsFiles;
    }

    /**
     * @param string $algorithmPath
     * @return array
     */
    private static function getAlgorithmInfo(string $algorithmPath): array
    {
        $algorithmInfo = [];

        $algorithmFileContent = file_get_contents($algorithmPath);

        preg_match("#.*(\-\-\*(.*)\*\-\-).*#", $algorithmFileContent,$matches);

        if(!empty($matches[2])){
            $descJson = $matches[2];
            $algorithmInfo = json_decode($descJson, true);
        }

        return $algorithmInfo;
    }
}
