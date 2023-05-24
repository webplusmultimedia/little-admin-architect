<?php

declare(strict_types=1);

/** @var LittleAminManager $manager */

use Illuminate\Support\Facades\Route;
use Webplusmultimedia\LittleAdminArchitect\Http\Controllers\AssetsController;
use Webplusmultimedia\LittleAdminArchitect\Http\Middleware\Authenticate;
use Webplusmultimedia\LittleAdminArchitect\LittleAminManager;

$manager = app('little-admin-manager');
Route::prefix(config('little-admin-architect.prefix'))
    ->middleware(['web'])
    ->name(config('little-admin-architect.route.prefix') . '.')
    ->group(function () use ($manager): void {
        Route::prefix('asset')
            ->name('assets.')
            ->group(function (): void {
                Route::get('css/{file}', AssetsController::class)->name('style');
                Route::get('js/{file}', AssetsController::class)->name('js');
            });
        Route::get('/login', config('little-admin-architect.auth.pages.login'))->name('auth.login');
        foreach ($manager->getPages() as $resource => $pages) {
            foreach ($pages as $page) {
                Route::get($page['slug'], $page['classBaseName'])->name($page['routeName'])->middleware(Authenticate::class);
            }
        }
    });
