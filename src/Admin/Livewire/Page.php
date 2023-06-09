<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resource;

class Page extends Component
{
    protected static ?string $resource = null;

    protected static ?Model $record = null;

    protected static LengthAwarePaginator $records;

    protected static \Webplusmultimedia\LittleAdminArchitect\Form\Components\Form $form;

    protected static ?string $route = null;

    protected static ?string $routeName = null;

    public static function getResource(): null|string|Resource
    {
        return static::$resource;
    }

    public static function getRouteForPage(string $type): array
    {
        return static::getResource()::getPages()[$type];
    }

    public static function getEditUrl(Model $record): string
    {
        $path = static::getRouteForPage('edit')['route'];

        return str($path)
            ->replace(['{record}'], $record->getKey())
            ->prepend('/', config('little-admin-architect.prefix'), '/', static::getResource()::getSlug())
            ->value();
    }

    public static function getCreateUrl(): string
    {
        $path = static::getRouteForPage('create')['route'];

        return str($path)
            ->prepend('/', config('little-admin-architect.prefix'), '/', static::getResource()::getSlug())
            ->value();
    }

    public static function getListUrl(): string
    {
        $path = static::getRouteForPage('index')['route'];

        return str($path)
            ->prepend('/', config('little-admin-architect.prefix'), '/', static::getResource()::getSlug())
            ->value();
    }

    public static function getPageRoute(): string
    {
        return (string) str(static::class)->replace('\\', '.');
    }

    public static function getComponentForPage(string $name): string
    {
        $pageClass = self::getRouteForPage($name)['class'];

        return str($pageClass)
            ->replace('\\', '.')
            ->explode('.')
            ->map(fn ($segment) => (string) str($segment)->kebab())
            ->implode('.');
    }

    protected static function title(): string
    {
        return (static::getResource())::getModelLabel();
    }

    public static function getForm(): \Webplusmultimedia\LittleAdminArchitect\Form\Components\Form
    {
        return static::$form;
    }

    public static function getActions(): array
    {
        return [

        ];
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

    public static function getMutateFormDataBeforeCreate(array $data): array
    {
        return static::mutateFormDataBeforeCreate($data);
    }

    protected static function mutateFormDataBeforeCreate(array $data): array
    {
        return $data;
    }

    public static function getMutateFormDataBeforeSave(array $data): array
    {
        return static::mutateFormDataBeforeSave($data);
    }

    protected static function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }

    public function render(): View
    {
        return view('little-views::livewire.page', static::setUpPage())
            ->layout('little-views::admin-components.Layouts.index', static::setUpLayout());
    }
}
