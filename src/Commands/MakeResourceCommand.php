<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Commands;

use Illuminate\Support\Str;
use Webplusmultimedia\LittleAdminArchitect\Support\Command\concerns\CanCreateResourcePage;
use Webplusmultimedia\LittleAdminArchitect\Support\Command\concerns\CanManipulateFiles;

class MakeResourceCommand extends \Illuminate\Console\Command
{
    use CanCreateResourcePage;
    use CanManipulateFiles;

    protected $description = 'Create a new Little Admin resource class and default page classes';

    protected $signature = 'make:la-resource {page : The resource name} {--G|group= : The resource group}  {--S|simple : A resource with a simple modal form}';

    private string $stub = '';

    public function handle(): int
    {
        $this->stub = './vendor/webplusmultimedia/little-admin-architect/stubs';
        $pathLa = config('little-admin-architect.resources.path');
        $nameSpace = config('little-admin-architect.resources.namespace');
        $page = $this->argument('page');
        $group = $this->option('group');
        $isSimple = $this->option('simple');
        if (blank($group)) {
            if ( ! $group = $this->ask('Missing argument for resource group. Please enter a resource group', null)) {
                $this->error('Missing argument for group...');

                return static::FAILURE;
            }
        }
        $this->stub = str($this->stub)->replace('\\', '/')
            ->replace('//', '/')->value();

        $page = str($page)->ucfirst()->value();
        $modelClass = str($page)->append('::class');
        $resource = Str::of($page)->append('Resource')->value();

        $resourcePath = Str::of($pathLa)
            ->append('/', $group)
            ->replace('\\', '/')
            ->replace('//', '/')
            ->value();
        $resourceNameSpace = Str::of($nameSpace)->append('\\', $group)->value();
        $resourceClass = Str::of($resourceNameSpace)->append('\\', $resource)->value();
        $resourceFile = Str::of($resourcePath)->append('/', $resource . '.php')->value();
        $pages = $this->getPages();

        $pageRessource = [
            'name' => $resource,
            'path' => $resourcePath,
            'file' => $resourceFile,
            'stub' => $this->stub . '/Resource.stub',
            'nameSpace' => $resourceNameSpace,
            'class' => $resourceClass,
            'modelClass' => $modelClass,
            'pages' => $pages,
        ];

        $paramsPages = $this->getParamsPages(['Edit', 'Create', 'List'], $page, $resourcePath, $resourceNameSpace, $resource);

        /* $this->info(collect($pageRessource)->toJson());
         $this->info(collect($paramsPages)->toJson());*/

        if ( ! $this->confirm('Are you sure you want to do this ?', false)) {
            $this->error('No regret');

            return static::FAILURE;
        }

        if ($this->createResourceAndPages($pageRessource, $paramsPages)) {
            $this->info('All done');

            return static::SUCCESS;
        }
        $this->error('C\'ant create an existing resource');

        return static::FAILURE;
    }

    private function getParamsPages(array $pages, string $resourceName, string $resourcePath, string $resourceNameSpace, string $resource): array
    {

        $listPages = [];
        foreach ($pages as $page) {
            $pageNamespace = str('Webplusmultimedia\\LittleAdminArchitect\\Admin\\Livewire\\Pages\\')->append($page, 'Record');
            $resourcePage = str($page)->ucfirst()->append('Page')->value();
            $nameSpace = str($resourceNameSpace)->append('\\Pages')->value();
            $directory = str($resourcePath)->append('/Pages')->value();
            $listPages[$page] = [
                'name' => $resourcePage,
                'nameSpace' => $nameSpace,
                'extendPageNameSpace' => $pageNamespace,
                'stub' => str($this->stub)->append('/', $page, 'Page.stub'),
                'class' => str($nameSpace)->append('\\', $resourcePage)->value(),
                'file' => str($directory)->append('/', $resourcePage . '.php')->value(),
                'PageResourceClass' => str($resource)->append('::class'),
                'nameSpaceResource' => Str::of($resourceNameSpace)->append('\\', $resource)->value(),
            ];
        }

        return $listPages;
    }

    private function getPages(): string
    {
        return '[' .
            PHP_EOL . "    'index'  => Pages\ListPage::route('/')," .
            PHP_EOL . "    'create' => Pages\CreatePage::route('/create')," .
            PHP_EOL . "    'edit'   => Pages\EditPage::route('/{record}/edit')," .
            PHP_EOL . '];';
    }
}
