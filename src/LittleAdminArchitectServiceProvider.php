<?php

namespace Webplusmultimedia\LittleAdminArchitect;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webplusmultimedia\LittleAdminArchitect\Commands\LittleAdminArchitectCommand;
use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\FormBinder;

class LittleAdminArchitectServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('little-admin-architect')
            ->hasConfigFile()
            ->hasViews('little-views')

            //->hasMigration('create_little-admin-architect_table')
            ->hasCommand(LittleAdminArchitectCommand::class);
    }

    public function bootingPackage()
    {
        Blade::componentNamespace('Webplusmultimedia\\LittleAdminArchitect\\Form\\ViewComponents\\Components', config('little-admin-architect.blade-prefix'));
        $this->declareBladeDirectives();
    }
    public function registeringPackage()
    {
        $this->app->singleton(FormBinder::class, fn (Application $app) => new FormBinder());
    }

    protected function declareBladeDirectives(): void
    {
        Blade::directive('bind', function ($dataBatch) {
            return '<?php app(Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\FormBinder::class)->bindNewDataBatch(' . $dataBatch . ') ?>';
        });
        Blade::directive('endbind', function () {
            return '<?php app(Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\FormBinder::class)->unbindLastDataBatch() ?>';
        });
        Blade::directive('errorbag', function ($errorBagKey) {
            return '<?php app(Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\FormBinder::class)->bindErrorBag(' . $errorBagKey . ') ?>';
        });
        Blade::directive('enderrorbag', function () {
            return '<?php app(Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\FormBinder::class)->unbindErrorBag() ?>';
        });
        Blade::directive('wire', function ($livewireModifier) {
            return '<?php app(Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\FormBinder::class)->bindNewLivewireModifier('
                . $livewireModifier . ') ?>';
        });
        Blade::directive('endwire', function () {
            return '<?php app(Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\FormBinder::class)->unbindLastLivewireModifier() ?>';
        });
    }
}
