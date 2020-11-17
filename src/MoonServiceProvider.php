<?php

namespace JeroenvanRensen\MoonPHP;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use JeroenvanRensen\MoonPHP\Console\CreateUserCommand;
use JeroenvanRensen\MoonPHP\Http\Middleware\AuthMiddleware;
use JeroenvanRensen\MoonPHP\Http\Middleware\GuestMiddleware;
use JeroenvanRensen\MoonPHP\Models\User;

class MoonServiceProvider extends ServiceProvider
{
    public function register()
    {
        // 
    }

    public function boot()
    {
        // Set the moon guard auth config
        $this->setAuthConfig();

        // Publish the migrations, config files, and the assets
        $this->publishFiles();

        // Load all the views and blade components
        $this->loadViews();

        // Register the commands
        $this->registerCommands();

        // Register all the routes
        $this->registerRoutes();

        // Register middleware
        $this->registerMiddleware();
    }

    /**
     * Set the moon guard auth config.
     *
     * @return void
     */
    protected function setAuthConfig()
    {
        Config::set('auth.guards.moon', [
            'driver' => 'session',
            'provider' => 'moon',
        ]);

        Config::set('auth.providers.moon', [
            'driver' => 'eloquent',
            'model' => User::class,
        ]);
    }

    /**
     * Publish the migrations, config files, and the assets.
     *
     * @return void
     */
    protected function publishFiles()
    {
        // Migrations
        $this->publishes([
            __DIR__ . '/../database/migrations/create_moon_users_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_moon_users_table.php')
        ], 'migrations');

        // Config files
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('moonphp.php')
        ], 'config');

        // Assets
        $this->publishes([
            __DIR__ . '/../public/css' => public_path('moonphp/css')
        ], 'assets');
    }

    /**
     * Load all the views and blade components.
     *
     * @return void
     */
    protected function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'moon');

        Blade::componentNamespace('JeroenvanRensen\\MoonPHP\\Views\\Components', 'moon');
    }

    /**
     * Register the middleware.
     *
     * @return void
     */
    protected function registerMiddleware()
    {
        $router = $this->app->make(Router::class);

        $router->aliasMiddleware('moon.guest', GuestMiddleware::class);
        $router->aliasMiddleware('moon.auth', AuthMiddleware::class);
    }

    /**
     * Register the routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::middleware('web')
            ->prefix(config('moonphp.path'))
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });
    }

    /**
     * Register the commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->commands([
            CreateUserCommand::class,
        ]);
    }
}
