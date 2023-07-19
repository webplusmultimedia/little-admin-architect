<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Resources;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Facades\LittleAdminManager;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Table;

class Resource
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

    protected static int $rowsPerPage = 20;

    public static function getRowsPerPage(): int
    {
        return static::$rowsPerPage;
    }

    protected static bool $shouldAuthorizeWithGate = false;

    protected static bool $shouldIgnorePolicies = false;

    public static function getNavigationLabel(): ?string
    {
        return static::$navigationLabel ?? static::getPluralModelLabel();
    }

    public static function getNavigationIcon(): ?string
    {
        return static::$navigationIcon;
    }

    public static function getNavigationSort(): ?int
    {
        return static::$navigationSort;
    }

    public static function getRecordTitleAttribute(): ?string
    {
        return static::$recordTitleAttribute;
    }

    public static function getBreadcrumb(): string
    {
        return static::$breadcrumb ?? Str::headline(static::getPluralModelLabel());
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

    public static function getModelLabel(): string
    {
        return static::$modelLabel ?? (string) str(class_basename(static::getModel()))
            ->kebab()
            ->replace('-', ' ');
    }

    public static function getPluralModelLabel(): string
    {
        if (filled($label = static::$pluralModelLabel)) {
            return (string) $label;
        }

        return (string) str(Str::plural(static::getModelLabel()))->lower()->ucfirst();

        // return static::getModelLabel();
    }

    public static function getFormSchema(Form $form): Form
    {
        return $form;
    }

    public static function getTableColumns(Table $table): Table
    {
        return $table;
    }

    public static function getSlug(): string
    {
        if (filled(static::$slug)) {
            return (string) static::$slug;
        }
        $groupName = str(static::class)->after(config('little-admin-architect.resources.namespace'))
            ->replace('\\', '/')
            ->after('/')
            ->before('/')->kebab()->slug();

        if ( ! blank($groupName)) {
            return (string) str($groupName)->lower() . '/' . static::getResourceName();
        }

        return str(static::getResourceName())->append('/') . Str::of(static::getModel())
            ->afterLast('\\Models\\')
            ->plural()
            ->explode('\\')
            ->map(fn (string $string) => Str::of($string)->kebab()->slug())
            ->implode('/');
    }

    public static function getResourceName(): string
    {
        return (string) str(class_basename(static::class))->before('Resource')->lower();
    }

    public static function getRouteBaseName(): string
    {
        $slug = static::getSlug();

        return config('little-admin-architect.route.prefix') . ".{$slug}";
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

    protected static function getUrl(string $name): ?array
    {
        if (isset(static::getPages()[$name]) and $url = static::getPages()[$name]) {
            return $url;
        }

        return null;
    }

    public static function shouldAuthorizeWithGate(): bool
    {
        return static::$shouldAuthorizeWithGate;
    }

    public static function can(string $action, Model $record = null): bool
    {
        $user = LittleAdminManager::auth()->user();
        $model = static::getModel();

        if (static::shouldAuthorizeWithGate()) {
            return Gate::forUser($user)->check($action, $record ?? $model);
        }

        if (static::shouldIgnorePolicies()) {
            return true;
        }

        $policy = Gate::getPolicyFor($model);
        if (null === $policy) {
            return true;
        }

        if ( ! method_exists($policy, $action)) {
            return true;
        }

        return Gate::forUser($user)->check($action, $record ?? $model);
    }

    public static function shouldIgnorePolicies(): bool
    {
        return static::$shouldIgnorePolicies;
    }

    public static function canViewAny(): bool
    {
        return static::can('viewAny');
    }

    public static function canCreate(): bool
    {
        return static::can('create');
    }

    public static function canEdit(Model $record): bool
    {
        return static::can('update', $record);
    }

    public static function canDelete(Model $record): bool
    {
        return static::can('delete', $record);
    }

    public static function canDeleteAny(): bool
    {
        return static::can('deleteAny');
    }

    public static function canForceDelete(Model $record): bool
    {
        return static::can('forceDelete', $record);
    }

    public static function canForceDeleteAny(): bool
    {
        return static::can('forceDeleteAny');
    }

    public static function canReorder(): bool
    {
        return static::can('reorder');
    }

    public static function canReplicate(Model $record): bool
    {
        return static::can('replicate', $record);
    }

    public static function canRestore(Model $record): bool
    {
        return static::can('restore', $record);
    }

    public static function canRestoreAny(): bool
    {
        return static::can('restoreAny');
    }

    /* public static function canGloballySearch(): bool
     {
         return static::$isGloballySearchable && count(static::getGloballySearchableAttributes()) && static::canViewAny();
     }*/

    public static function canView(Model $record): bool
    {
        return static::can('view', $record);
    }
}
