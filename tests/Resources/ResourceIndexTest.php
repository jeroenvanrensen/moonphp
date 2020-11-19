<?php

namespace JeroenvanRensen\MoonPHP\Tests\Resources;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JeroenvanRensen\MoonPHP\Models\User;
use JeroenvanRensen\MoonPHP\Tests\Helpers\SetUpResources;
use JeroenvanRensen\MoonPHP\Tests\TestCase;

class ResourceIndexTest extends TestCase
{
    use RefreshDatabase, SetUpResources;

    /** @test */
    public function authenticated_users_can_visit_the_resource_index_page()
    {
        $this->withoutExceptionHandling();

        $this->setUpResources(true);

        $user = User::factory()->create();
        auth()->guard('moon')->login($user);

        $this->get(route('moon.resources.index', 'posts'))
            ->assertStatus(200);
    }

    /** @test */
    public function guests_cannot_visit_the_resource_index_page()
    {
        $this->withoutExceptionHandling();

        $this->setUpResources(true);

        $this->get(route('moon.resources.index', 'posts'))
            ->assertRedirect(route('moon.auth.login'));
    }

    /** @test */
    public function an_error_is_thrown_when_the_resource_slug_does_not_exist()
    {
        $this->setUpResources(true);

        $user = User::factory()->create();
        auth()->guard('moon')->login($user);

        $this->get(route('moon.resources.index', 'pages')) // "pages" does not exist
            ->assertStatus(404);
    }
}
