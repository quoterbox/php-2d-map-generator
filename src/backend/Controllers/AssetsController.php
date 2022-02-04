<?php

namespace Backend\Controllers;

class AssetController
{
    public function index()
    {
        debug('AssetController index');
    }

    public function getAssets(): string
    {



        $AssetFolders = [
            [
                'name' => 'Folder1',
                'path' => 'Test\Folder\Folder1\\'
            ]
        ];

        return json_encode($AssetFolders);
    }
}
