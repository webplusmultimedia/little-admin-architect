<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Facade;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Webplusmultimedia\LittleAdminArchitect\LittleAdminArchitectServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Webplusmultimedia\\LittleAdminArchitect\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            LittleAdminArchitectServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        $app['config']->set('view.paths', [
            __DIR__ . '/../views',
            resource_path('views'),
        ]);
        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');
        $app['config']->set('session.driver', 'file');
        $this->afterApplicationCreated(function (): void {
            $this->makeACleanSlate();
        });
        $this->beforeApplicationDestroyed(function (): void {
            $this->makeACleanSlate();
        });
        Facade::setFacadeApplication(app());

        /*
        $migration = include __DIR__.'/../database/migrations/create_little-admin-architect_table.php.stub';
        $migration->up();
        */
    }

    public function makeACleanSlate(): void
    {
        Artisan::call('view:clear');
    }
}
