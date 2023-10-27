<?php

declare(strict_types = 1);
/**
 * Created by PhpStorm.
 *
 * @category    Category
 *
 * @author      daniel
 *
 * @link        http://webplusm.net
 * Date: 27/10/2023 10:17
 */

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use Livewire\Component;

abstract class BasePage extends Component
{
    protected static string $layout = 'little-views::livewire.page';

    protected static ?string $title = NULL;

    protected string | Htmlable | null $heading = NULL;

    protected string | Htmlable | null $subheading = NULL;

    protected static string $view;

    public function render(): View
    {
        return view(static::$layout, $this->getDataView())
            ->layout('little-views::admin-components.Layouts.index', [
                'livewire' => $this,
                ...$this->getDatasLayout()]);
    }

    public function getHeading(): string | Htmlable
    {
        return $this->heading ?? $this->getTitle();
    }

    public function getSubheading(): string | Htmlable | null
    {
        return $this->subheading;
    }

    public function getTitle(): string
    {
        return static::$title ?? (string) str(class_basename(static::class))
            ->kebab()
            ->replace('-', ' ')
            ->title();
    }

    public function getDatasLayout(): array
    {
        return [
        ];
    }

    public function getDataView(): array
    {
        return [
        ];
    }


}
