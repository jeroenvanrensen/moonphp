<?php

namespace JeroenvanRensen\MoonPHP\Tests\Resources;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use JeroenvanRensen\MoonPHP\Resource;
use JeroenvanRensen\MoonPHP\Tests\Helpers\SetUpResources;
use JeroenvanRensen\MoonPHP\Tests\TestCase;

class ResourceHelpersTest extends TestCase
{
    use RefreshDatabase, SetUpResources;

    /** @test */
    public function the_resource_class_can_find_all_the_resources()
    {
        $this->withoutExceptionHandling();

        $this->setUpResources();

        Config::set('moonphp.resources', [
            \App\Resources\Page::class,
            \App\Resources\Post::class
        ]);

        $this->assertEquals([
            [
                'name' => 'Page',
                'name_plural' => 'Pages',
                'slug' => 'pages',
                'class' => new \App\Resources\Page()
            ],
            [
                'name' => 'Post',
                'name_plural' => 'Posts',
                'slug' => 'posts',
                'class' => new \App\Resources\Post()
            ]
        ], Resource::getResourcesList());
    }
}
