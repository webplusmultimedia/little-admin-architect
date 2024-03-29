<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;
use Webplusmultimedia\LittleAdminArchitect\Support\RegisterResources;

final class LittleAdminManager
{
    //  private bool $isNavigationMounted = false;

    private array $navigationGroups = [];

    //  private array $navigationItems = [];

    // private array $pages = [];

    /**
     * @var array<int,string[]>
     */
    private array $resources = [];

    // private array $beforeCoreScripts = [];

    //private array $scripts = [];

    //  private array $scriptData = [];

    /**
     * @var string[]
     */
    private array $styles = [];

    //  private array $meta = [];

    // private string|Htmlable|null $theme = null;

    //  private array $userMenuItems = [];

    // private array $widgets = [];

    //  private ?Closure $navigationBuilder = null;

    //  private array $renderHooks = [];

    //   private bool $isServing = false;

    public function getUrl(): ?string
    {
        $firstGroup = Arr::first($this->getNavigations());
        if ( ! $firstGroup) {
            return null;
        }

        $firstItems = Arr::first($firstGroup);

        return route($firstItems['route_name']);
    }

    public function getNavigations(): array
    {
        if ( ! count($this->navigationGroups)) {
            return LittleAdminArchitect::getNavigationPages();
        }

        return $this->navigationGroups;
    }

    public function auth(): Guard
    {
        return auth()->guard(config('little-admin-architect.auth.guard'));
    }

    public function registerStyles(array $styles): void
    {
        $this->styles = array_merge($this->styles, $styles);
    }

    public function getStyles(): array
    {
        return $this->styles;
    }

    public function getResources(): array
    {
        return $this->resources;
    }

    public function registerResourcesWidgets(): void
    {
        RegisterResources::resolveWidgetsComponents(config('little-admin-architect.widgets.path'));
    }

    public function registerResources(): void
    {
        $this->applyResources();
    }

    public function resolveResourceBy(string $name = null, string $route = null): void
    {
    }

    private function applyResources(): void
    {
        $this->resources = RegisterResources::getResourcesFromApplication(config('little-admin-architect.resources.path'));

        /*cache()->remember('little-admin-resource', 1, function () {
            return RegisterResources::getResourcesFromApplication(config('little-admin-architect.resources.path'));
        });*/
    }

    public static function getComponentNameFromBaseName(string $componentBaseName): array
    {
        $resources = app('little-admin-manager')->getResources();
        $component = collect($resources)->pluck('resources.*.pages.*.component')
            ->flatten();

        return $component->all();
    }

    public function getPages(): array
    {
        $resources = $this->getResources();

        return collect($resources)
            ->map(function (array $value) {
                return collect($value)->collapse()->toArray();
            })->all();
    }
}
