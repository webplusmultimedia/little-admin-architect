<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Support\Htmlable;
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

    private string|Htmlable|null $theme = null;

    private array $userMenuItems = [];

    private array $widgets = [];

    private ?Closure $navigationBuilder = null;

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

    public function resolveResourceBy(null|string $name = null, null|string $route = null): void
    {

    }

    private function applyResources(): void
    {
        if ( ! $this->resources) {
            $this->resources = RegisterResources::getResourcesFromApplication(config('little-admin-architect.resources.path'));
        }
    }
}
