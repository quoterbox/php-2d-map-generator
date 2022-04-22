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
            'desc' => 'A simple map will be generated from 2 types of tiles (100x100 pixel tiles): T-shaped and equal on all sides. Due to this combination, '
                .'the pattern goes through the entire map without collapsing into local areas. But sometimes the map might have mono color areas.',
            'sample_map_path' => 'angles.png'
        ],
        'AnglesEmpty' => [
            'desc' => 'This asset pack shows what happens if a map has no compatible tile in some areas. Empty tiles will be left blank.',
            'sample_map_path' => 'angles_empty.png'
        ],
        'RealLand' => [
            'desc' => 'The real land asset pack (48x48 pixel tiles) contains the solution to a real problem. The generated map will resemble a map from strategy games with top-down or orthogonal views.',
            'sample_map_path' => 'real_land.png'
        ],
        'RiverPath' => [
            'desc' => 'This asset pack includes a map with a lot of compatible tiles. The pattern on the generated map will collapse into local areas.',
            'sample_map_path' => 'river_path.png'
        ],
        'Rivers' => [
            'desc' => 'The Rivers asset pack represents simplified rivers, and it is very similar to the Angles asset pack.',
            'sample_map_path' => 'rivers.png'
        ],
        'SimpleLand' => [
            'desc' => 'This asset pack has not a lot of compatible tiles from the RealLand asset pack and looks too simple and repeatable.',
            'sample_map_path' => 'simple_land.png'
        ],
        'SquareRivers' => [
            'desc' => 'One more sample of a simple map.',
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
