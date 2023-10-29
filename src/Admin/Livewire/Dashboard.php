<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

class Dashboard extends BasePage
{
    protected static ?string $test = null;

    protected static string $layout = 'little-views::dashboard.dashboard';

    public function mount(): void
    {
        self::$test = 'mada';
    }

    public static function getTest(): ?string
    {
        return static::$test;
    }
}
