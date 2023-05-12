<?php

declare(strict_types=1);

// config for Webplusmultimedia/LittleAdminArchitect
return [

    'prefix' => 'admin',
    'resources' => [
        'namespace' => 'App\\LittleAdmin\\Resources',
        'path' => app_path('LittleAdmin/Resources'),
        'register' => [],
    ],
    'pages' => [
        'namespace' => 'App\\LittleAdmin\\Pages',
        'path' => app_path('LittleAdmin/Pages'),
        'register' => [
            // Pages\Dashboard::class,
        ],
    ],
    'auth' => [
        'guard' => env('LITTLE_ADMIN_AUTH_GUARD', 'web'),
        'pages' => [
            'login' => \LittleAdmin\Http\Livewire\Auth\Login::class,
        ],
    ],
    /**
     * Whether form input/textarea/checkbox/radio/switch components should display their validation success.
     * Success status will be display when errors are sent to the view with no matching with the component name.
     */
    'display_validation_success' => true,

    /**
     * Whether form input/textarea/checkbox/radio/switch components should display their validation failure.
     * Fail status will be display when errors are sent to the view with a match with the component name.
     */
    'display_validation_failure' => true,
    'blade-prefix' => 'little-form',

    'grid' => [
        'col1' => 'lg:grid-cols-1',
        'col2' => 'lg:grid-cols-2',
        'col3' => 'lg:grid-cols-3',
        'col4' => 'lg:grid-cols-4',
        'col5' => 'lg:grid-cols-5',
    ],
];
