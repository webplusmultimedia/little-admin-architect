<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resource;
use Webplusmultimedia\LittleAdminArchitect\Admin\Widgets\Widget;
use Webplusmultimedia\LittleAdminArchitect\Admin\Widgets\WidgetConfiguration;

abstract class Page extends BasePage
{
    protected static ?string $resource = null;

    protected static ?Model $record = null;

    protected static LengthAwarePaginator $records;

    protected static \Webplusmultimedia\LittleAdminArchitect\Form\Components\Form $form;

    protected static ?string $route = null;

    protected static ?string $routeName = null;

    public static function getResource(): null | string | Resource
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
        static::$title = (static::getResource())::getModelLabel();

        return static::$title;
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

    public function getDatasLayout(): array
    {
        static::title();

        return [
            'title' => $this->getTitle(),
        ];
    }

    public function getDataView(): array
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

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    protected static function getHeaderWidgets(): array
    {
        return [];
    }

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    protected static function getFooterWidgets(): array
    {
        return [];
    }

    protected function getWidgetData(): array
    {
        return [];
    }
}
