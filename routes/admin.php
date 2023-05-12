<?php

declare(strict_types=1);

/** @var LittleAminManager $manager */

use Illuminate\Support\Facades\Route;
use Webplusmultimedia\LittleAdminArchitect\LittleAminManager;

$manager = app('little-admin-manager');
Route::prefix(config('little-admin-architect.prefix'))
    ->middleware('web')
    ->name('little-admin.page.')
    ->group(function () use ($manager): void {
        foreach ($manager->getPages() as $page) {
            Route::get($page['slug'], $page['classBaseName'])->name($page['routeName']);
        }
    });
