<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

class Dashboard extends Page
{
    protected static ?string $title = 'Tableau de board';

    protected static string $layout = 'little-views::dashboard.dashboard';

    protected static function title(): string
    {
        return static::$title;
    }

    protected static function getHeaderWidgets(): array
    {
        return [
            ...config('little-admin-architect.dashboard.widgets'),
        ];
    }

    public function getDataView(): array
    {
        return [
            'id' => $this->id,
            'headerWidgets' => static::getHeaderWidgets(),
            'footerWidgets' => static::getFooterWidgets(),
        ];
    }
}
