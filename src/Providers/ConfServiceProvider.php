<?php

namespace Miladimos\Conf\Providers;

use Illuminate\Support\ServiceProvider;
use Miladimos\Conf\Console\Commands\InstallConfCommand;
use Miladimos\Conf\Facades\ConfFacade;

class ConfServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfFrom(__DIR__ . "/../../config/conf.php", 'conf');

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
            $this->registerPublishes();
            $this->publishConf();
        }
    }

    private function registerFacades()
    {
        $this->app->bind('conf', function ($app) {
            return new ConfFacade();
        });
    }

    private function registerPublishes()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('package.php')
        ], 'package-config');
    }

    private function registerCommands()
    {
        $this->commands([
            InstallConfCommand::class,
        ]);
    }

    public function publishConf()
    {
        $this->publishes([
            __DIR__ . '/../../config/package.php' => config_path('package.php')
        ], 'package-config');
    }
}
