<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;

class Page extends Component
{
    protected static ?string $resource = null;

    protected static ?Model $record = null;

    protected static LengthAwarePaginator $records;



    protected static \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form $form;

    protected static ?string $route = null;

    protected static ?string $routeName = null;

    public static function getResource(): null|string|Resources
    {
        return static::$resource;
    }

    public static function getPageRoute(): string
    {
        return (string) str(static::class)->replace('\\', '.');
    }


    protected static function title(): string
    {
        return (static::getResource())::getModelLabel();
    }

    public static function getForm(): \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form
    {
        return static::$form;
    }

    public static function route(string $path): array
    {
        return [
            'class' => static::class,
            'route' => $path,
        ];
    }

    public static function getComponent(): string
    {
        return str(static::class)
            ->replace('\\', '.')
            ->explode('.')
            ->map(fn ($segment) => (string) str($segment)->kebab())
            ->implode('.');
    }

    protected static function setUpLayout(): array
    {
        return [
            'title' => static::title(),
        ];
    }

    protected static function setUpPage(): array
    {
        return [
        ];
    }

    public function render()
    {
        return view('little-views::livewire.page', static::setUpPage())
            ->layout('little-views::admin-components.Layouts.index', static::setUpLayout());
    }
}
