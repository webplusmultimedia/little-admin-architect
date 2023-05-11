<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect;

class LittleAdminArchitect
{
    public function getMe(): string
    {
        return 'me';
    }

    public static function getResourceManager():LittleAminManager
    {
        return app('little-admin-manager');
    }

    public static function getNavigationPages(): array
    {
        $navigation = [];
        $manager = static::getResourceManager();
        foreach ($manager->getResources() as  $key => $group) {
            //dd($group['resources']);
            $pages = [];
            foreach ($group['resources'] as $resource) {
                foreach ($resource[ 'pages' ] as $page) {
                    if ($page['type']!=='list') continue;
                    $pages[] = [
                        'route_name' => $page['name'],
                        'title' => $resource['title']
                    ];
                 }
            }
            $navigation[$group['group']] = $pages;
        }
        return $navigation;
    }
}
