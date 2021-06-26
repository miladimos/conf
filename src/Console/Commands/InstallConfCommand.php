<?php

namespace Miladimos\Conf\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallConfCommand extends Command
{
    protected $signature = 'conf:install';

    protected $description = 'Install the package Conf';

    public function handle()
    {
        $this->line("\t... Welcome io conf installer ...");


        // app config file
        if (File::exists(config_path('conf.php'))) {
            $confirm = $this->confirm("conf.php already exist. Do you want to overwrite?");
            if ($confirm) {
                $this->publishConfig();
                $this->info("config overwrite finished");
            } else {
                $this->info("skipped config publish");
            }
        } else {
            $this->publishConfig();
            $this->info("config published");
        }

        // custom configs file
        $configPath = config('conf.path');
        if (File::exists($configPath)) {
            $confirm = $this->confirm("conf.json already exist. Do you want to overwrite?");
            if ($confirm) {
                $this->publishCustomConfig();
                $this->info("custom config overwrite finished");
            } else {
                $this->info("skipped custom config publish");
            }
        } else {
            $this->publishCustomConfig();
            $this->info("custom config published");
        }

        $this->info("Conf package successfully installed.\n");
        $this->info("\t\tGood Luck.");
    }

     private function publishConfig()
     {
         $this->call('vendor:publish', [
             '--provider' => "Miladimos\Conf\Providers\ConfServiceProvider",
             '--tag'      => 'conf-config',
             '--force'    => true
         ]);
     }

     private function publishCustomConfig()
     {
         $configPath = config('conf.path');
         $content = "{\n\n}";

         File::put($configPath, $content);
         return true;
     }


    //     //migration
    //     if (File::exists(database_path("migrations/$migrationFile"))) {
    //         $confirm = $this->confirm("migration file already exist. Do you want to overwrite?");
    //         if ($confirm) {
    //             $this->publishMigration();
    //             $this->info("migration overwrite finished");
    //         } else {
    //             $this->info("skipped migration publish");
    //         }
    //     } else {
    //         $this->publishMigration();
    //         $this->info("migration published");
    //     }
    //     $this->call('migrate');
    // }



    // private function publishMigration()
    // {
    //     $this->call('vendor:publish', [
    //         '--provider' => "Miladimos\package\Providers\packageServiceProvider",
    //         '--tag'      => 'migrations',
    //         '--force'    => true
    //     ]);
    // }

    // private function publishAssets()
    // {
    //     $this->call('vendor:publish', [
    //         '--provider' => "Miladimos\package\Providers\packageServiceProvider",
    //         '--tag'      => 'assets',
    //         '--force'    => true
    //     ]);
    // }
}
