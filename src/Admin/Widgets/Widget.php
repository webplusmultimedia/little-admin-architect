<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 *
 * @category    Category
 *
 * @author      daniel
 *
 * @link        http://webplusm.net
 * Date: 28/10/2023 10:20
 */

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Widgets;

use Illuminate\View\View;
use Livewire\Component;

abstract class Widget extends Component
{
    protected static ?int $sort = null;

    protected static string $view;

    /** @var int | string | array<string, int | null> */
    protected int | string | array $columnSpan = 1;

    /** @var int | string | array<string, int | null> */
    protected int | string | array $columnStart = [];

    public function render(): View
    {
        return view(static::$view, $this->getViewData());
    }

    protected function getViewData(): array
    {
        return [];
    }

    public static function canView(): bool
    {
        return true;
    }

    public static function getSort(): int
    {
        return static::$sort ?? -1;
    }

    /**
     * @return int | string | array<string, int | null>
     */
    public function getColumnSpan(): int | string | array
    {
        return $this->columnSpan;
    }

    /**
     * @return int | string | array<string, int | null>
     */
    public function getColumnStart(): int | string | array
    {
        return $this->columnStart;
    }

    /**
     * @param  array<string, mixed>  $properties
     */
    public static function make(array $properties = []): WidgetConfiguration
    {
        return app(WidgetConfiguration::class, ['widget' => static::class, 'properties' => $properties]);
    }

    /**
     * @return array<string, mixed>
     */
    public static function getDefaultProperties(): array
    {
        return [];
    }
}
