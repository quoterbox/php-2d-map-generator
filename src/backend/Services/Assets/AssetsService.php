<?php

namespace Backend\Services\Assets;

use App\Asset\AssetFolderCollection;
use App\Asset\AssetFolderCollectionInterface;
use App\Asset\AssetsCollection;

class AssetsService implements AssetsServiceInterface
{
    /**
     * @var string
     */
    private string $assetsPath;

    /**
     * @var AssetFolderCollectionInterface|AssetFolderCollection
     */
    private AssetFolderCollectionInterface $assetsFolderCollection;

    /**
     * @var string
     */

    private string $assetsExt = 'png';
    /**
     * @var string
     */
    private string $savedPath = 'saved\Samples\\';

    /**
     * @var array|\string[][]
     */
    private array $packDescriptions = [
        'Angles' => [
            'desc' => 'A simple map will be generated from 2 types of tiles: T-shaped and the same on all sides. Due to this combination, the pattern goes through the entire map without collapsing into local areas.',
            'sample_map_path' => 'angles.png'
        ],
        'AnglesEmpty' => [
            'desc' => 'Angles Empty description',
            'sample_map_path' => 'angles_empty.png'
        ],
        'RealLand' => [
            'desc' => 'Real land description',
            'sample_map_path' => 'real_land.png'
        ],
        'RiverPath' => [
            'desc' => 'RiverPath description',
            'sample_map_path' => 'river_path.png'
        ],
        'Rivers' => [
            'desc' => 'Rivers description',
            'sample_map_path' => 'rivers.png'
        ],
        'SimpleLand' => [
            'desc' => 'Simple land description',
            'sample_map_path' => 'simple_land.png'
        ],
        'SquareRivers' => [
            'desc' => 'SquareRivers description',
            'sample_map_path' => 'square_rivers.png'
        ],

    ];

    /**
     * @param string $assetsPath
     */
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
