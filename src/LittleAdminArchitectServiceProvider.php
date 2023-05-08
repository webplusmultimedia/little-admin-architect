<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webplusmultimedia\LittleAdminArchitect\Admin\LittleAminManager;
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

            //->hasMigration('create_little-admin-architect_table')
            ->hasCommand(LittleAdminArchitectCommand::class);
    }

    public function bootingPackage(): void
    {
        Blade::componentNamespace('Webplusmultimedia\\LittleAdminArchitect\\Form\\View\\Components', config('little-admin-architect.blade-prefix'));
        Blade::anonymousComponentPath(__DIR__.'/../resources/views','little-anonyme');
        //$this->declareBladeDirectives();
    }

    public function registeringPackage(): void
    {
        $this->app->singleton(FormBinder::class, fn (Application $app) => new FormBinder());
        $this->app->bind('little-admin-architect', fn (): LittleAdminArchitect => new LittleAdminArchitect());
        $this->app->scoped('little-admin', function (): LittleAminManager {
            return new LittleAminManager();
        });
    }

    protected function declareBladeDirectives(): void
    {
        Blade::directive('bind', function ($dataBatch) {
            return '<?php app(Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder::class)->bindNewDataBatch('.$dataBatch.') ?>';
        });
        Blade::directive('endbind', function () {
            return '<?php app(Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder::class)->unbindLastDataBatch() ?>';
        });
        Blade::directive('errorbag', function ($errorBagKey) {
            return '<?php app(Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder::class)->bindErrorBag('.$errorBagKey.') ?>';
        });
        Blade::directive('enderrorbag', function () {
            return '<?php app(Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder::class)->unbindErrorBag() ?>';
        });
        Blade::directive('wire', function ($livewireModifier) {
            return '<?php app(Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder::class)->bindNewLivewireModifier('
                .$livewireModifier.') ?>';
        });
        Blade::directive('endwire', function () {
            return '<?php app(Webplusmultimedia\LittleAdminArchitect\Form\View\FormBinder::class)->unbindLastLivewireModifier() ?>';
        });
    }

    public function packageBooted(): void
    {
        app('little-admin')->registerResources();
    }
}
