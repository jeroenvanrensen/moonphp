<?php

namespace JeroenvanRensen\MoonPHP\Tests\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JeroenvanRensen\MoonPHP\Http\Livewire\Auth\Login;
use JeroenvanRensen\MoonPHP\Models\User;
use JeroenvanRensen\MoonPHP\Tests\TestCase;
use Livewire\Livewire;

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
            ->assertSeeLivewire('auth.login');
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

        Livewire::test(Login::class)
            ->set('email', 'john@example.org')
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect(route('moon.dashboard'));

        $this->assertTrue(auth()->guard('moon')->check());
    }

    /** @test */
    public function a_user_cannot_login_if_the_email_is_incorrect()
    {
        $this->withoutExceptionHandling();

        $this->get(route('moon.auth.login'))
            ->assertDontSee('These credentials do not match our records.');

        Livewire::test(Login::class)
            ->set('email', 'john@example.org')
            ->set('password', 'password')
            ->call('login')
            ->assertSee('These credentials do not match our records.');
    }

    /** @test */
    public function a_user_cannot_login_if_the_password_is_incorrect()
    {
        $this->withoutExceptionHandling();

        User::factory()->create([
            'email' => 'john@example.org',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ]);

        $this->get(route('moon.auth.login'))
            ->assertDontSee('These credentials do not match our records.');

        Livewire::test(Login::class)
            ->set('email', 'john@example.org')
            ->set('password', 'incorrect-password')
            ->call('login')
            ->assertSee('These credentials do not match our records.');
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

        auth()->guard('moon')->login($user);

        return $user;
    }
}
