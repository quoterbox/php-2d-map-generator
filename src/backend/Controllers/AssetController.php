<?php

namespace Backend\Controllers;

class AssetController
{
    public function index()
    {
        debug('eeeeeeee');
    }

    public function getAssetsFolders(): string
    {
        $AssetFolders = [
            [
                'name' => 'Folder1',
                'path' => 'Test\Folder\Folder1\\'
            ]
        ];

        debug('ttttttttt');

        return json_encode($AssetFolders);
    }
}
