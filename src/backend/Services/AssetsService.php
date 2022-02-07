<?php

namespace Backend\Services;

use App\Asset\AssetFolderCollection;
use App\Asset\AssetFolderCollectionInterface;
use App\Asset\AssetsCollection;

class AssetsService implements AssetsServiceInterface
{
    private string $assetsPath;
    private AssetFolderCollectionInterface $assetsFolderCollection;

    private string $assetsExt = 'png';
    private string $savedPath = 'saved\Samples\\';

    private array $packDescriptions = [
        'Angles' => [
            'desc' => 'A simple map will be generated from 2 types of tiles: T-shaped and the same on all sides. Due to this combination, the pattern goes through the entire map without collapsing into local areas.',
            'sample_map_path' => 'angles.png'
        ],
        'Angles_2' => [
            'desc' => 'Angles_2 description',
            'sample_map_path' => 'angles_2.png'
        ],
        'Rivers' => [
            'desc' => 'Rivers description',
            'sample_map_path' => 'rivers.png'
        ],
        'Rivers_2' => [
            'desc' => 'Rivers_2 description',
            'sample_map_path' => 'rivers_2.png'
        ],
        'RiverPath' => [
            'desc' => 'RiverPath description',
            'sample_map_path' => 'river_path.png'
        ],
    ];

    public function __construct(string $assetsPath)
    {
        $this->assetsPath = $assetsPath;
        $this->assetsFolderCollection = new AssetFolderCollection($this->assetsPath);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getAssetPacks(): array
    {
        return $this->mergeAssetsAndFolders();
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function mergeAssetsAndFolders(): array
    {
        $assetPacks = [];
        $assetsFolders = $this->assetsFolderCollection->getAssetsFolders();

        foreach ($assetsFolders as $assetFolder){

            $Assets = (new AssetsCollection($assetFolder->getPath(), $this->assetsExt))->getAssetsLikeArray();

            $assetPacks[] = [
                'name' => $assetFolder->getName(),
                'path' => $assetFolder->getPath(),
                'desc' => $this->packDescriptions[$assetFolder->getName()]['desc'],
                'sample_map_path' => $this->savedPath . $this->packDescriptions[$assetFolder->getName()]['sample_map_path'],
                'assets' => $Assets
            ];
        }

        return $assetPacks;
    }
}
