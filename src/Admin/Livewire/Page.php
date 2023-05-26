<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
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

    public static function getEditRoute(string $type): array
    {
        return static::getResource()::getPages()[$type];
    }

    public static function getEditUrl(Model $record): string
    {
        $path = static::getEditRoute('edit')['route'];

        return url(str($path)
            ->replace(['{record}'], $record->getKey())
            ->prepend('/', config('little-admin-architect.prefix'), '/', static::getResource()::getSlug())
            ->value());
    }

    public static function getCreateUrl(): string
    {
        $path = static::getEditRoute('create')['route'];

        return url(str($path)
            ->prepend('/', config('little-admin-architect.prefix'), '/', static::getResource()::getSlug())
            ->value());
    }

    public static function getListUrl(): string
    {
        $path = static::getEditRoute('index')['route'];

        return url(str($path)
            ->prepend('/', config('little-admin-architect.prefix'), '/', static::getResource()::getSlug())
            ->value());
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

    public function render(): View
    {
        return view('little-views::livewire.page', static::setUpPage())
            ->layout('little-views::admin-components.Layouts.index', static::setUpLayout());
    }
}
