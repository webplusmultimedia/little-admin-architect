<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\RegisterResources;

final class LittleAminManager
{
    private bool $isNavigationMounted = false;

    private array $navigationGroups = [];

    private array $navigationItems = [];

    private array $pages = [];

    private array $resources = [];

    private array $beforeCoreScripts = [];

    private array $scripts = [];

    private array $scriptData = [];

    private array $styles = [];

    private array $meta = [];

    private string|Htmlable|null $theme = NULL;

    private array $userMenuItems = [];

    private array $widgets = [];

    private ?Closure $navigationBuilder = NULL;

    private array $renderHooks = [];

    private bool $isServing = false;

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

    public function registerResources(): void
    {
        $this->applyResources();
    }

    public function resolveResourceBy(null|string $name = NULL, null|string $route = NULL): void {}

    private function applyResources(): void
    {
        $this->resources = cache()->remember('little-admin-resource', 60, function () {
            return RegisterResources::getResourcesFromApplication(config('little-admin-architect.resources.path'));
        });
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
        $resources = app('little-admin-manager')->getResources();
        return collect($resources)->pluck('resources.*.pages.*')
            ->collapse()->all();
    }
}
