<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Form;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Mixins\SelectMixing;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Modal\LittleAdminModal;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Table;
use Webplusmultimedia\LittleAdminArchitect\Commands\LittleAdminArchitectCommand;
use Webplusmultimedia\LittleAdminArchitect\Commands\MakeResourceCommand;
use Webplusmultimedia\LittleAdminArchitect\Http\Middleware\Authenticate;
use Webplusmultimedia\LittleAdminArchitect\Support\Components\Livewire\Notification;

class LittleAdminArchitectServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('little-admin-architect')
            ->hasConfigFile()
            ->hasViews('little-views')
            ->hasRoute('admin')
            ->hasTranslations()
            ->hasCommand(MakeResourceCommand::class)
            //->hasMigration('create_little-admin-architect_table')
            ->hasCommand(LittleAdminArchitectCommand::class);
    }

    public function bootingPackage(): void
    {
        Blade::componentNamespace('Webplusmultimedia\\LittleAdminArchitect\\Form\\View\\Components', config('little-admin-architect.blade-prefix'));
        Blade::componentNamespace('Webplusmultimedia\\LittleAdminArchitect\\Table\\Views', config('little-admin-architect.blade-table-prefix'));
        Blade::componentNamespace('Webplusmultimedia\\LittleAdminArchitect\\Support\\Action\\views', 'little-action');
        Blade::componentNamespace('Webplusmultimedia\\LittleAdminArchitect\\Support\\Components\\Modal', 'little-modal');
        Blade::anonymousComponentPath(__DIR__ . '/../resources/views', 'little-anonyme');
        \Webplusmultimedia\LittleAdminArchitect\Facades\LittleAdminManager::registerResources();
    }

    public function registeringPackage(): void
    {

        $this->app->bind('little-admin-architect', fn (): LittleAdminArchitect => new LittleAdminArchitect());
        $this->app->scoped('little-admin-manager', function (): LittleAdminManager {
            return new LittleAdminManager();
        });

    }

    public function packageBooted(): void
    {
        $this->registerLivewireComponents();
        Form::mixin(new SelectMixing());
        Livewire::addPersistentMiddleware([
            Authenticate::class,
        ]);
    }

    private function registerLivewireComponents(): void
    {
        $groups = \Webplusmultimedia\LittleAdminArchitect\Facades\LittleAdminManager::getPages();
        $componentNames = collect(Arr::pluck($groups, '*.component'))->flatten();

        foreach ($componentNames as $page => $component) {
            $class = Form::class;
            if (str($component)->afterLast('.')->startsWith('list-')) {
                $class = Table::class;
            }
            Livewire::component($component, $class);
        }

        Livewire::component('little-admin.pages.auth.login', config('little-admin-architect.auth.pages.login'));
        Livewire::component('little-admin-architect.modal', LittleAdminModal::class);
        Livewire::component('little-admin-notification', Notification::class);
    }
}
