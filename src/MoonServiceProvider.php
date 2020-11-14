<?php

namespace JeroenvanRensen\MoonPHP;

use Illuminate\Support\ServiceProvider;
use JeroenvanRensen\MoonPHP\Console\CreateUserCommand;

class MoonServiceProvider extends ServiceProvider
{
    public function register()
    {
        // 
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/create_moon_users_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_moon_users_table.php')
        ], 'migrations');

        $this->commands([
            CreateUserCommand::class,
        ]);
    }
}
