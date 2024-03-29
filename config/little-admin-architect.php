<?php

declare(strict_types=1);

// config for Webplusmultimedia/LittleAdminArchitect
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Webplusmultimedia\LittleAdminArchitect\Admin\Dashboard\Widgets\LaInfosWidget;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Dashboard;
use Webplusmultimedia\LittleAdminArchitect\Http\Middleware\Authenticate;

return [

    'prefix' => 'admin',
    'path' => env('LITTLE_ADMIN_PATH', 'admin'),
    'route' => [
        'prefix' => 'little-admin.page',
    ],
    'resources' => [
        'namespace' => 'App\\LittleAdmin\\Resources',
        'path' => app_path('LittleAdmin/Resources'),
        'register' => [],
    ],
    'widgets' => [
        'namespace' => 'App\\LittleAdmin\\Widgets',
        'path' => app_path('LittleAdmin/Widgets'),
    ],
    'pages' => [
        'namespace' => 'App\\LittleAdmin\\Pages',
        'path' => app_path('LittleAdmin/Pages'),
        'register' => [
            // Pages\Dashboard::class,
        ],
    ],
    'auth' => [
        'guard' => env('LITTLE_ADMIN_AUTH_GUARD', 'admin'),
        'pages' => [
            'login' => \Webplusmultimedia\LittleAdminArchitect\Http\Livewire\Login::class,
        ],
    ],
    /**
     * Whether form input/textarea/checkbox/radio/switch components should display their validation success.
     * Success status will be display when errors are sent to the view with no matching with the component name.
     */
    'display_validation_success' => true,
    'forms' => [
        'default_filesystem_disk' => 'public',
    ],

    /**
     * Whether form input/textarea/checkbox/radio/switch components should display their validation failure.
     * Fail status will be display when errors are sent to the view with a match with the component name.
     */
    'display_validation_failure' => true,
    /**
     * Do not remove or change
     */
    'blade-prefix' => 'little-form',
    'blade-table-prefix' => 'little-table',
    'table' => [
        'rowsPerPage' => 20,
    ],
    'attachments' => [
        'root-path' => 'attachments',
    ],
    'dashboard' => [
        'title' => 'Dashboard',
        'class' => Dashboard::class,
        'route' => '/',
        'route_name' => 'admin-dashboard',
        'widgets' => [
            LaInfosWidget::class,
        ],
    ],

    'grid' => [
        'col1' => 'lg:grid-cols-1',
        'col2' => 'lg:grid-cols-2',
        'col3' => 'lg:grid-cols-3',
        'col4' => 'lg:grid-cols-4',
        'col5' => 'lg:grid-cols-5',
    ],
    'middleware' => [
        'auth' => [
            Authenticate::class,
        ],
        'base' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],
    ],
    'translate' => [
        'active' => false,
        'lang' => [config('app.locale')],
        'default' => config('app.locale'),
    ],
];
