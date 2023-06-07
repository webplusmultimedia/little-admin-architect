<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support;

use Illuminate\Filesystem\Filesystem;
use SplFileInfo;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;
use Webplusmultimedia\LittleAdminArchitect\Admin\Resources\Resources;

class RegisterResources
{
    protected Filesystem $filesystem;

    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }

    public static function getResourcesFromApplication(string $path): array
    {
        return (new self())->getResourcesFromDir($path);
    }

    protected function getResourcesFromDir(string $path): array
    {
        if ($this->filesystem->exists($path)) {
            $resourcesGroupe = $this->filesystem->directories($path);
            $group = [];
            foreach ($resourcesGroupe as $resourceGroupe) {
                $resourcesFiles = $this->filesystem->files($resourceGroupe);
                /** @var SplFileInfo $resourceFile */
                foreach ($resourcesFiles as $resourceFile) {
                    $pagesDirectory = str($resourceGroupe)->append(str($resourceFile->getRealPath())
                        ->afterLast('/')
                        ->before('.php')
                        ->start('/'))
                        ->finish('/')
                        ->append('Pages');
                    $resourceClassBasePath = (string) str($resourceFile->getRealPath())->between('app/', '.php')->prepend('App/');
                    /** @var Resources $resourceClassBaseName */
                    $resourceClassBaseName = (string) str($resourceClassBasePath)->replace('/', '\\');
                    $slug = $resourceClassBaseName::getSlug();
                    $pages = $this->filesystem->files($pagesDirectory);
                    $groupName = (string) str(string: $resourceGroupe)->afterLast('/');
                    $group[$groupName][] = array_map(callback: function (SplFileInfo $page) use ($groupName, $resourceClassBaseName, $resourceClassBasePath, $slug) {
                        $pageClassBasePath = (string) str($page->getRealPath())->between('app/', '.php')->prepend('App/');
                        /** @var string $namePage */
                        $namePage = (string) str($pageClassBasePath)->afterLast('/')->kebab()->explode('-')->first();

                        $slugPage = match ($namePage) {
                            'edit' => $slug . '/{record}/edit',
                            'create' => $slug . '/create',
                            default => $slug ,
                        };
                        $routePage = match ($namePage) {
                            'edit' => $slug . '/{record}/edit',
                            'create' => $slug . '/create',
                            default => $slug . '/index',
                        };

                        $typePage = match ($namePage) {
                            'edit' => 'edit',
                            'create' => 'create',
                            default => 'list',
                        };

                        return [
                            'group' => $groupName,
                            'resourceName' => (string) str($resourceClassBasePath)->afterLast('/'),
                            'resourcePlurialTitle' => (string) str($resourceClassBaseName::getPluralModelLabel())->ucfirst(),
                            'resourceTitle' => (string) str($resourceClassBaseName::getNavigationLabel())->ucfirst(),
                            'resourceSlug' => $slug,
                            'resourceRouteName' => config('little-admin-architect.route.prefix') . '.'
                                . str($slug)->replace('/', '.')->append('.*'),
                            'resourceNamespace' => config('little-admin-architect.resources.namespace'),
                            'resourceClassBaseName' => $resourceClassBaseName,
                            'component' => str($pageClassBasePath)
                                ->replace('/', '.')
                                ->explode('.')
                                ->map(fn ($segment) => str($segment)->kebab())
                                ->implode('.'),
                            'pageName' => (string) str($pageClassBasePath)->afterLast('/'),
                            'classBaseName' => (string) str($pageClassBasePath)->replace('/', '\\'),
                            'slug' => $slugPage,
                            'routeClass' => Page::class,
                            'icon' => $resourceClassBaseName::getNavigationIcon(),
                            'sort' => $resourceClassBaseName::getNavigationSort(),
                            'type' => $typePage,
                            'routeName' => str($routePage)
                                ->replace(['/'], '.')
                                ->remove(['{', '}'])
                                ->kebab()
                                ->value(),
                        ];
                    }, array: $pages);

                }

            }

            return $group;

        }

        return [];
    }
}
