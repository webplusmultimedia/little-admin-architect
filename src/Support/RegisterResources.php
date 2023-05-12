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

            return array_map(function ($resourceGroupe) {
                $resourcesFiles = $this->filesystem->files($resourceGroupe);

                return ['group' => (string) str($resourceGroupe)->afterLast('/'),
                    'resources' => array_map(function (SplFileInfo $resourceFile) use ($resourceGroupe): array {
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

                        return [
                            'name' => (string) str($resourceClassBasePath)->afterLast('/'),
                            'title' => str($resourceClassBaseName::getPluralModelLabel())->ucfirst(),
                            'slug' => $slug,
                            'pages' => array_map(function (SplFileInfo $page) use ($slug) {
                                $pageClassBasePath = (string) str($page->getRealPath())->between('app/', '.php')->prepend('App/');
                                $namePage = (string) str($pageClassBasePath)->afterLast('/')->kebab()->explode('-')->first();

                                $slugPage = match ($namePage) {
                                    'edit' => $slug . '/{record}/edit',
                                    'create' => $slug . '/create',
                                    'list' => $slug,
                                };
                                $typePage = match ($namePage) {
                                    'edit' => 'edit',
                                    'create' => 'create',
                                    'list' => 'list',
                                };

                                return [
                                    'component' => str($pageClassBasePath)
                                        ->replace('/', '.')
                                        ->explode('.')
                                        ->map(fn ($segment) => str($segment)->kebab())
                                        ->implode('.'),
                                    'pageName' => (string) str($pageClassBasePath)->afterLast('/'),
                                    'classBaseName' => (string) str($pageClassBasePath)->replace('/', '\\'),
                                    'slug' => $slugPage,
                                    'routeClass' => Page::class,
                                    'type' => $typePage,
                                    'routeName' => str($slugPage)->replace(['/'], '.')->remove(['{', '}'])->kebab()->value(),
                                ];
                            }, $pages),
                            'namespace' => config('little-admin-architect.resources.namespace'),
                            'classBaseName' => $resourceClassBaseName,
                        ];
                    }, $resourcesFiles),

                ];

            }, $resourcesGroupe);

        }

        return [];
    }
}
