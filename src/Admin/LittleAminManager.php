<?php

namespace Webplusmultimedia\LittleAdminArchitect\Admin;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Support\Htmlable;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\RegisterResources;

final class LittleAminManager
{
    protected bool $isNavigationMounted = false;

    protected array $navigationGroups = [];

    protected array $navigationItems = [];

    protected array $pages = [];

    protected array $resources = [];

    protected array $beforeCoreScripts = [];

    protected array $scripts = [];

    protected array $scriptData = [];

    protected array $styles = [];

    protected array $meta = [];

    protected string|Htmlable|null $theme = null;

    protected array $userMenuItems = [];

    protected array $widgets = [];

    protected ?Closure $navigationBuilder = null;

    protected array $renderHooks = [];

    protected bool $isServing = false;

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

    public function resolveResourceBy(null|string $name = null, null|string $route = null)
    {

    }

    private function applyResources(): void
    {
        if (! $this->resources) {
            $this->resources = RegisterResources::getResourcesFromApplication(config('little-admin-architect.resources.path'));
        }
    }
}
