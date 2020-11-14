<?php

namespace JeroenvanRensen\MoonPHP\Tests\Feature\Console;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JeroenvanRensen\MoonPHP\Models\User;
use JeroenvanRensen\MoonPHP\Tests\TestCase;

class CreateUserCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_be_created_using_the_command()
    {
        $this->withoutExceptionHandling();

        $this->assertCount(0, User::all());
        
        $this->artisan('moon:user')
            ->expectsQuestion('What is the users\'s name?', 'John Doe')
            ->expectsQuestion('What is the users\'s email?', 'john@example.org')
            ->expectsQuestion('What is the users\'s password?', 'password')
            ->expectsOutput('Created user John Doe <john@example.org>!');

        $this->assertCount(1, User::all());

        $this->assertEquals('John Doe', User::first()->name);
        $this->assertEquals('john@example.org', User::first()->email);
    }

    /** @test */
    public function the_name_is_required()
    {
        $this->withoutExceptionHandling();
        
        $this->artisan('moon:user')
            ->expectsQuestion('What is the users\'s name?', null)
            ->expectsQuestion('What is the users\'s email?', 'john@example.org')
            ->expectsQuestion('What is the users\'s password?', 'password')
            ->expectsOutput('The name field is required.');
    }

    /** @test */
    public function the_email_is_required_and_must_be_valid_and_unique()
    {
        $this->withoutExceptionHandling();
        
        // Empty email
        $this->artisan('moon:user')
            ->expectsQuestion('What is the users\'s name?', 'John Doe')
            ->expectsQuestion('What is the users\'s email?', null)
            ->expectsQuestion('What is the users\'s password?', 'password')
            ->expectsOutput('The email field is required.');
        
        // Invalid email
        $this->artisan('moon:user')
            ->expectsQuestion('What is the users\'s name?', 'John Doe')
            ->expectsQuestion('What is the users\'s email?', 'invalid-email')
            ->expectsQuestion('What is the users\'s password?', 'password')
            ->expectsOutput('The email must be a valid email address.');
        
        // Already existing email
        User::factory()->create([
            'email' => 'john@example.org'
        ]);

        $this->artisan('moon:user')
            ->expectsQuestion('What is the users\'s name?', 'John Doe')
            ->expectsQuestion('What is the users\'s email?', 'john@example.org')
            ->expectsQuestion('What is the users\'s password?', 'password')
            ->expectsOutput('The email has already been taken.');
    }

    /** @test */
    public function the_password_is_required_and_must_at_least_be_eight_characters()
    {
        $this->withoutExceptionHandling();
        
        // Empty password
        $this->artisan('moon:user')
            ->expectsQuestion('What is the users\'s name?', 'John Doe')
            ->expectsQuestion('What is the users\'s email?', 'john@example.org')
            ->expectsQuestion('What is the users\'s password?', null)
            ->expectsOutput('The password field is required.');
        
        // Too short password
        $this->artisan('moon:user')
            ->expectsQuestion('What is the users\'s name?', 'John Doe')
            ->expectsQuestion('What is the users\'s email?', 'john@example.org')
            ->expectsQuestion('What is the users\'s password?', '2-short')
            ->expectsOutput('The password must be at least 8 characters.');
    }
}
