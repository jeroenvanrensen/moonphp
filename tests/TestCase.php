<?php

namespace JeroenvanRensen\MoonPHP\Tests;

use JeroenvanRensen\MoonPHP\MoonServiceProvider;

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
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // 
    }
}
