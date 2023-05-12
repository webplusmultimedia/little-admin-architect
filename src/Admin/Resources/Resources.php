<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Resources;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Resources
{
    protected static ?string $breadcrumb = null;

    protected static bool $isGloballySearchable = true;

    protected static ?string $modelLabel = null;

    protected static ?string $model = null;

    protected static ?string $navigationGroup = null;

    protected static ?string $navigationIcon = null;

    protected static ?string $activeNavigationIcon = null;

    protected static ?string $navigationLabel = null;

    protected static ?int $navigationSort = null;

    protected static ?string $recordRouteKeyName = null;

    protected static bool $shouldRegisterNavigation = true;

    protected static ?string $pluralModelLabel = null;

    protected static ?string $recordTitleAttribute = null;

    protected static ?string $slug = null;

    protected static string|array $middlewares = [];

    protected static int $globalSearchResultsLimit = 50;

    protected static bool $shouldAuthorizeWithGate = false;

    protected static bool $shouldIgnorePolicies = false;

    public static function getBreadcrumb(): string
    {
        return static::$breadcrumb ?? Str::headline(static::getPluralModelLabel());
    }

    public static function getModelLabel(): string
    {
        return static::$modelLabel ?? (string) str(class_basename(static::getModel()))
            ->kebab()
            ->replace('-', ' ');
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query();
    }

    public static function getModel(): string
    {
        return static::$model ?? (string) str(class_basename(static::class))
            ->beforeLast('Resource')
            ->prepend('App\\Models\\');
    }

    public static function getPages(): array
    {
        return [];
    }

    public static function getPluralModelLabel(): string
    {
        if (filled($label = static::$pluralModelLabel)) {
            return (string) $label;
        }

        /*  if (locale_has_pluralization()) {
              return Str::plural(static::getModelLabel());
          }*/

        return static::getModelLabel();
    }

    public static function getForm(): \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form
    {
        return \Webplusmultimedia\LittleAdminArchitect\Form\Livewire\Components\Form::make();
    }

    public static function getSlug(): string
    {
        if (filled(static::$slug)) {
            return (string) static::$slug;
        }

        return Str::of(static::getModel())
            ->afterLast('\\Models\\')
            ->plural()
            ->explode('\\')
            ->map(fn (string $string) => Str::of($string)->kebab()->slug())
            ->implode('/');
    }

    public static function getRouteBaseName(): string
    {
        $slug = static::getSlug();

        return "filament.resources.{$slug}";
    }

    public static function getRecordRouteKeyName(): ?string
    {
        return static::$recordRouteKeyName;
    }

    public static function getRoutes(): Closure
    {
        return function (): void {
            $slug = static::getSlug();

            Route::name("{$slug}.")
                ->prefix($slug)
                ->middleware(static::getMiddlewares())
                ->group(function (): void {
                    foreach (static::getPages() as $name => $page) {
                        Route::get($page['route'], $page['class'])->name($name);
                    }
                });
        };
    }

    public static function getMiddlewares(): string|array
    {
        return static::$middlewares;
    }
}