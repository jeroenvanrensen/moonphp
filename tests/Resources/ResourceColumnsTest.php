<?php

namespace JeroenvanRensen\MoonPHP\Tests\Resources;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JeroenvanRensen\MoonPHP\Tests\Helpers\SetUpResources;
use JeroenvanRensen\MoonPHP\Tests\TestCase;

class ResourceColumnsTest extends TestCase
{
    use RefreshDatabase, SetUpResources;

    /** @test */
    public function the_resource_can_have_a_text_column()
    {
        $this->withoutExceptionHandling();

        $this->setUpResources(true);

        $resource = new \App\Resources\Post;

        $resource->columns = [
            \JeroenvanRensen\MoonPHP\Column::name('Title')->make()
        ];

        $this->assertEquals([
            [
                'type' => 'text',
                'column' => 'title',
                'label' => 'Title'
            ]
        ], $resource->columns());
    }

    /** @test */
    public function the_resource_can_have_a_column_with_another_name()
    {
        $this->withoutExceptionHandling();

        $this->setUpResources(true);

        $resource = new \App\Resources\Post;

        $resource->columns = [
            \JeroenvanRensen\MoonPHP\Column::name('Post Title', 'title')->make()
        ];

        $this->assertEquals([
            [
                'type' => 'text',
                'column' => 'title',
                'label' => 'Post Title'
            ]
        ], $resource->columns());
    }

    /** @test */
    public function a_resource_can_have_multiple_columns()
    {
        $this->withoutExceptionHandling();

        $this->setUpResources(true);

        $resource = new \App\Resources\Post;

        $resource->columns = [
            \JeroenvanRensen\MoonPHP\Column::name('Title')->make(),
            \JeroenvanRensen\MoonPHP\Column::name("Date", "created_at")->make()
        ];

        $this->assertEquals([
            [
                'type' => 'text',
                'column' => 'title',
                'label' => 'Title'
            ],
            [
                'type' => 'text',
                'column' => 'created_at',
                'label' => 'Date'
            ]
        ], $resource->columns());
    }
}
