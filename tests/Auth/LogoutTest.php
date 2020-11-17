<?php

namespace JeroenvanRensen\MoonPHP\Tests\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JeroenvanRensen\MoonPHP\Models\User;
use JeroenvanRensen\MoonPHP\Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_logout()
    {
        $this->withoutExceptionHandling();
        
        $this->login();

        $this->assertTrue(auth()->guard('moon')->check());

        $this->post(route('moon.auth.logout'))
            ->assertRedirect(route('moon.auth.login'))
            ->assertSessionHas('message', 'You are successfully logged out!');

        $this->assertFalse(auth()->guard('moon')->check());
    }

    /** @test */
    public function guests_cannot_logout()
    {
        $this->withoutExceptionHandling();
        
        $this->post(route('moon.auth.logout'))
            ->assertRedirect(route('moon.auth.login'))
            ->assertSessionMissing('message', 'You are successfully logged out!');
    }

    /**
     * Log the user in using the moon guard.
     *
     * @return \JeroenvanRensen\MoonPHP\Models\User
     */
    protected function login()
    {
        $user = User::factory()->create([
            'email' => 'john@example.org',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ]);

        $this->post(route('moon.auth.login'), [
            'email' => 'john@example.org',
            'password' => 'password'
        ]);

        return $user;
    }
}
