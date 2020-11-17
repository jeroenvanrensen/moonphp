<?php

namespace JeroenvanRensen\MoonPHP;

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
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

        // Publish the assets
        $this->publishes([
            __DIR__.'/../public/css' => public_path('moonphp/css')
        ], 'assets');

        // Register commands
        $this->commands([
            CreateUserCommand::class,
        ]);

        // Load the routes
        $this->registerRoutes();

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

    /**
     * Register all the routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::middleware('web')
            ->prefix('/admin')
            ->group(function() {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });
    }
}
