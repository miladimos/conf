<?php

namespace Miladimos\Conf\Providers;

use Illuminate\Support\ServiceProvider;
use Miladimos\Conf\Console\Commands\InstallConfCommand;
use Miladimos\Conf\Facades\ConfFacade;

class ConfServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/../../config/conf.php", 'conf');

        $this->registerFacades();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->registerCommands();
            $this->publishConfig();
        }
    }

    private function registerFacades()
    {
        $this->app->bind('conf', function ($app) {
            return new ConfFacade();
        });
    }

    private function registerCommands()
    {
        $this->commands([
            InstallConfCommand::class,
        ]);
    }

    private function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../../config/conf.php' => config_path('conf.php')
        ], 'conf-config');
    }

}
