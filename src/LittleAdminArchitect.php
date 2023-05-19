<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect;

class LittleAdminArchitect
{
    public function getMe(): string
    {
        return 'me';
    }

    public static function getResourceManager(): LittleAminManager
    {
        return app('little-admin-manager');
    }

    public static function getNavigationPages(): array
    {
        $navigation = [];
        $manager = static::getResourceManager();
        foreach ($manager->getPages() as $group => $resourcePages) {
            $pages = [];
            foreach ($resourcePages as $resource) {

                if ('list' !== $resource['type']) {
                    continue;
                }
                $route_name = config('little-admin-architect.route.prefix') . '.' . $resource['routeName'];
                $pages[] = [
                    'route_name' => $route_name,
                    'route_prefix' => config('little-admin-architect.route.prefix') . '.'
                        . str($resource['resourceSlug'])
                            ->replace('/', '.')

                            ->beforeLast('.')
                            ->append('.*'),
                    'title' => $resource['resourceTitle'],
                    'route_resource' => $resource['resourceRouteName'],
                ];
            }
            $navigation[$group] = $pages;
        }

        return $navigation;
    }

    public static function getRouteForResourcePage(string $groupRessource, string $page): \Illuminate\Support\Collection
    {
        $manager = static::getResourceManager();

        return collect($manager->getResources())->filter(function ($group) use ($groupRessource) {
            return (bool) ($group['group'] === $groupRessource);
        });
    }
}
