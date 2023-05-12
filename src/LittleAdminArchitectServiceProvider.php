<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect;

use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Form;
use Webplusmultimedia\LittleAdminArchitect\Commands\LittleAdminArchitectCommand;
use Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder;

class LittleAdminArchitectServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('little-admin-architect')
            ->hasConfigFile()
            ->hasViews('little-views')
            ->hasRoute('admin')

            //->hasMigration('create_little-admin-architect_table')
            ->hasCommand(LittleAdminArchitectCommand::class);
    }

    public function bootingPackage(): void
    {
        Blade::componentNamespace('Webplusmultimedia\\LittleAdminArchitect\\Form\\View\\Components', config('little-admin-architect.blade-prefix'));
        Blade::anonymousComponentPath(__DIR__.'/../resources/views', 'little-anonyme');
        app('little-admin-manager')->registerResources();
    }

    public function registeringPackage(): void
    {
        $this->app->singleton(FormBinder::class, fn (Application $app) => new FormBinder());
        $this->app->bind('little-admin-architect', fn (): LittleAdminArchitect => new LittleAdminArchitect());
        $this->app->scoped('little-admin-manager', function (): LittleAminManager {
            return new LittleAminManager();
        });


    }

    public function packageBooted(): void
    {
        $this->registerLivewireComponents(app('little-admin-manager'));
    }

    private function registerLivewireComponents(LittleAminManager $manager): void
    {
        $groups = $manager->getResources();
        $componentName = collect(Arr::pluck($groups, 'resources.*.pages.*.component'))->flatten();

        foreach ($componentName as $page => $component) {
            Livewire::component($component, Form::class);
        }
    }
}
