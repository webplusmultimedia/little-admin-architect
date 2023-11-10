<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Webplusmultimedia\LittleAdminArchitect\Admin\Widgets\Widget;
use Webplusmultimedia\LittleAdminArchitect\Admin\Widgets\WidgetConfiguration;

class Dashboard extends Page
{
    protected static ?string $title = 'Tableau de board';

    protected static string $layout = 'little-views::dashboard.dashboard';

    protected static function title(): string
    {
        return static::$title;
    }

    /**  @return array<class-string<Widget|WidgetConfiguration>> */
    protected function getHeaderWidgets(): array
    {
        return [
            ...config('little-admin-architect.dashboard.widgets'),
        ];
    }

    public function getDataView(): array
    {
        return [
            'id' => $this->id,
            'headerWidgets' => $this->getVisibleHeaderWidgets(),
            'footerWidgets' => $this->getVisibleFooterWidgets(),
        ];
    }
}
