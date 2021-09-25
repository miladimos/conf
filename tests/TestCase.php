<?php

namespace Miladimos\Conf\Tests;

use Miladimos\Conf\Providers\ConfServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected string $base_path;
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
        $this->base_path =  '/api' . '/' . config('conf.routes.apiVersion') . '/' . config('conf.routes.prefix');
        file_put_contents('vendor/orchestra/testbench-core/laravel/config.json','
        {
            "key": {
                "id": 1,
                "key": "key",
                "description": "description",
                "value": "value"
            }
        }
        ');

    }

    protected function getPackageProviders($app)
    {
        return [
            ConfServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
