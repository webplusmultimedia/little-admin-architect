<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Webplusmultimedia\LittleAdminArchitect\Facades\LittleAdminManager;
use Webplusmultimedia\LittleAdminArchitect\Http\Controllers\AssetsController;
use Webplusmultimedia\LittleAdminArchitect\Http\Middleware\Authenticate;
use Webplusmultimedia\LittleAdminArchitect\Http\Responses\Auth\LogoutResponse;

Route::prefix(config('little-admin-architect.prefix'))
    ->middleware(['web'])
    ->name(config('little-admin-architect.route.prefix') . '.')
    ->group(function (): void {
        Route::prefix('asset')
            ->name('assets.')
            ->group(function (): void {
                Route::get('css/{file}', AssetsController::class)->name('style');
                Route::get('js/{file}', AssetsController::class)->name('js');
            });
        Route::get('/login', config('little-admin-architect.auth.pages.login'))->name('auth.login');
        Route::post('/logout', function (Request $request): LogoutResponse {
            LittleAdminManager::auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return app(LogoutResponse::class);
        })->name('auth.logout');
        foreach (LittleAdminManager::getPages() as $resource => $pages) {
            foreach ($pages as $page) {
                Route::get($page['slug'], $page['classBaseName'])->name($page['routeName'])->middleware(Authenticate::class);
            }
        }
    });
