<?php

namespace Miladimos\Conf\Providers;

use Illuminate\Support\Facades\Route;
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

        $this->registerRoutes();

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

    private function registerRoutes()
    {
        Route::group($this->routeConfig(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/apiRoutes.php');
        });
    }

    private function routeConfig()
    {
        return [
            'prefix' => 'api' . '/' . config('conf.routes.apiVersion') . '/' . config('conf.routes.prefix'),
            'middleware' => config('conf.middleware')
        ];
    }

}
