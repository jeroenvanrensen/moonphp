<?php

namespace JeroenvanRensen\MoonPHP\Tests;

use JeroenvanRensen\MoonPHP\MoonServiceProvider;
use Livewire\LivewireServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            MoonServiceProvider::class,
            LivewireServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // import the CreateMoonUsersTable class from the migration
        include_once __DIR__ . '/../database/migrations/create_moon_users_table.php';

        // run the up() method of that migration class
        (new \CreateMoonUsersTable)->up();
    }
}
