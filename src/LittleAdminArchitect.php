<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect;

class LittleAdminArchitect
{
    public function getMe(): string
    {
        return 'me';
    }

    public static function getResourceManager(): LittleAdminManager
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
                $pages[$resource['sort']] = [
                    'route_name' => $route_name,
                    'route_prefix' => config('little-admin-architect.route.prefix') . '.'
                        . str($resource['resourceSlug'])
                            ->replace('/', '.')
                            ->beforeLast('.')
                            ->append('.*'),
                    'title' => $resource['resourceTitle'],
                    'icon' => $resource['icon'],
                    'route_resource' => $resource['resourceRouteName'],
                ];
            }

            $navigation[$group] = collect($pages)->sortKeys(SORT_ASC)->toArray();

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
