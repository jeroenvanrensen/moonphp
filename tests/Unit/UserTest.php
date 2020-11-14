<?php

namespace JeroenvanRensen\MoonPHP\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JeroenvanRensen\MoonPHP\Models\User;
use JeroenvanRensen\MoonPHP\Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_user_model_has_a_factory()
    {
        $this->withoutExceptionHandling();
        
        $this->assertCount(0, User::all());

        User::factory()->create();
        
        $this->assertCount(1, User::all());
    }
}
