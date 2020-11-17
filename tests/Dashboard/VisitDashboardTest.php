<?php

namespace JeroenvanRensen\MoonPHP\Tests\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JeroenvanRensen\MoonPHP\Models\User;
use JeroenvanRensen\MoonPHP\Tests\TestCase;

class VisitDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_can_visit_the_dashboard()
    {
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create();
        auth()->guard('moon')->login($user);
        
        $this->get(route('moon.dashboard'))
            ->assertStatus(200);
    }

    /** @test */
    public function guests_cannot_visit_the_dashboard()
    {
        $this->withoutExceptionHandling();
        
        $this->get(route('moon.dashboard'))
            ->assertRedirect(route('moon.auth.login'));
    }
}
