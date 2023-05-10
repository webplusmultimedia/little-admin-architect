<?php

/** @var LittleAminManager $manager */

use Illuminate\Support\Facades\Route;
use Webplusmultimedia\LittleAdminArchitect\LittleAminManager;

$manager = app('little-admin-manager');
/*foreach ($manager->getPages() as $page) {
    Route::get($page[ 'slug' ], $page[ 'classBaseName' ]);
    dump($page[ 'classBaseName' ]);
}*/
