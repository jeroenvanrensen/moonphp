<?php

namespace JeroenvanRensen\MoonPHP\Tests\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JeroenvanRensen\MoonPHP\Models\User;
use JeroenvanRensen\MoonPHP\Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_cannot_visit_the_login_page()
    {
        $this->withoutExceptionHandling();
        
        $this->login();
        
        $this->get(route('moon.auth.login'))
            ->assertRedirect(route('moon.dashboard'));
    }

    /** @test */
    public function a_user_can_visit_the_login_page()
    {
        $this->withoutExceptionHandling();
        
        $this->get(route('moon.auth.login'))
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_login()
    {
        $this->withoutExceptionHandling();
        
        User::factory()->create([
            'email' => 'john@example.org',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ]);

        $this->assertFalse(auth()->guard('moon')->check());

        $this->post(route('moon.auth.login'), [
            'email' => 'john@example.org',
            'password' => 'password'
        ])->assertRedirect(route('moon.dashboard'));

        $this->assertTrue(auth()->guard('moon')->check());
    }

    /** @test */
    public function authenticated_users_cannot_login()
    {
        $this->withoutExceptionHandling();

        $this->login();
        
        $this->post(route('moon.auth.login'))
            ->assertRedirect(route('moon.dashboard'));
    }

    /** @test */
    public function a_user_cannot_login_if_the_email_is_incorrect()
    {
        $this->withoutExceptionHandling();
        
        $this->post(route('moon.auth.login'), [
            'email' => 'john@example.org', // does not exist
            'password' => 'password'
        ])->assertSessionHas('error', 'These credentials do not match our records.');
    }

    /** @test */
    public function a_user_cannot_login_if_the_password_is_incorrect()
    {
        $this->withoutExceptionHandling();

        User::factory()->create([
            'email' => 'john@example.org',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ]);
        
        $this->post(route('moon.auth.login'), [
            'email' => 'john@example.org',
            'password' => 'incorrect-password' // is incorrect
        ])->assertSessionHas('error', 'These credentials do not match our records.');
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
