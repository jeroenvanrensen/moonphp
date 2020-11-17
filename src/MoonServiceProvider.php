<?php

namespace JeroenvanRensen\MoonPHP;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use JeroenvanRensen\MoonPHP\Console\CreateUserCommand;
use JeroenvanRensen\MoonPHP\Http\Middleware\AuthMiddleware;
use JeroenvanRensen\MoonPHP\Http\Middleware\GuestMiddleware;
use JeroenvanRensen\MoonPHP\Models\User;

class MoonServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        // Publish the migrations files
        $this->publishes([
            __DIR__ . '/../database/migrations/create_moon_users_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_moon_users_table.php')
        ], 'migrations');

        // Register commands
        $this->commands([
            CreateUserCommand::class,
        ]);

        // Load the routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Load the views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'moon');

        // Create a moon guard
        Config::set('auth.guards.moon', [
            'driver' => 'session',
            'provider' => 'moon',
        ]);

        Config::set('auth.providers.moon', [
            'driver' => 'eloquent',
            'model' => User::class,
        ]);

        // Register middleware
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('moon.guest', GuestMiddleware::class);
        $router->aliasMiddleware('moon.auth', AuthMiddleware::class);
    }
}
