<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Resources;

use Illuminate\Filesystem\Filesystem;
use SplFileInfo;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Page;

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

                //dump($resourceGroupe, $resourcesFiles);

                return ['group'     => (string) str($resourceGroupe)->afterLast('/'),
                        'resources' =>
                            array_map(function (SplFileInfo $resourceFile) use ($resourceGroupe): array {
                                $pagesDirectory = str($resourceGroupe)->append(str($resourceFile->getRealPath())
                                    ->afterLast('/')
                                    ->before('.php')
                                    ->start('/'))
                                    ->finish('/')
                                    ->append('Pages');
                                $resourceClassBasePath = (string) str($resourceFile->getRealPath())->between('app/', '.php')->prepend("App/");
                                /** @var Resources $resourceClassBaseName */
                                $resourceClassBaseName = (string) str($resourceClassBasePath)->replace('/', '\\');
                                $slug = $resourceClassBaseName::getSlug();
                                $pages = $this->filesystem->files($pagesDirectory);

                                return [
                                    'name'          => (string) str($resourceClassBasePath)->afterLast('/'),
                                    'slug'          => $slug,
                                    'pages'         => array_map(function (SplFileInfo $page) use ($slug) {
                                        $pageClassBasePath = (string) str($page->getRealPath())->between('app/', '.php')->prepend("App/");
                                        $namePage = (string) str($pageClassBasePath)->afterLast('/')->kebab()->explode('-')->first();

                                        $slugPage = match ($namePage){
                                            'edit' => $slug . '/{id}/edit',
                                            'create' => $slug . '/create',
                                            'list' => $slug ,
                                        };

                                        return [
                                            'component'     => str($pageClassBasePath)
                                                ->replace('/', '.')
                                                ->explode('.')
                                                ->map(fn($segment) => str($segment)->kebab())
                                                ->implode('.'),
                                            'pageName' => (string) str($pageClassBasePath)->afterLast('/'),
                                            'classBaseName' => (string) str($pageClassBasePath)->replace('/', '\\'),
                                            'slug' => $slugPage,
                                            'routeClass' => Page::class
                                        ];
                                    }, $pages),
                                    'namespace'     => config('little-admin-architect.resources.namespace'),
                                    'classBaseName' => $resourceClassBaseName
                                ];
                            }, $resourcesFiles)

                ];

            }, $resourcesGroupe);

        }

        return [];
    }

    /**
     * return array_map(function (string $dir) use ($directory, $direResources): array {
     * $key = str($dir)
     * ->after('app')
     * ->prepend('app')
     * ->before('.php')
     * ->explode('/')
     * ->map(fn($val) => str($val)->kebab())->implode('.');
     * dump($direResources);
     *
     * // $files = $this->filesystem->files($direResources);
     *
     * return
     * [
     * 'resource'      => (string) str($direResources)->afterLast('/'),
     * 'route'         => $key,
     * 'namespace'     => (string) str($dir)
     * ->after('Resources')
     * ->replace('/', '\\')
     * ->before('.php')
     * ->prepend(config('little-admin-architect.resources.namespace')),
     * 'className'     => (string) str($dir)
     * ->after('Resources')
     * ->replace('/', '\\')
     * ->prepend(config('little-admin-architect.resources.namespace'))
     * ->before('.php')
     * ->append('::class'),
     * 'classBaseName' => (string) str($dir)->after('Resources/')->before('.php')
     * ];
     * }, $direResources);
     *
     */
}
