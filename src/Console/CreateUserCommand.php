<?php

namespace JeroenvanRensen\MoonPHP\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JeroenvanRensen\MoonPHP\Models\User;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'moon:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get the data
        $name = $this->ask('What is the users\'s name?');
        $email = $this->ask('What is the users\'s email?');
        $password = $this->secret('What is the users\'s password?');

        // Validate
        if (!$this->validate($name, $email, $password)) {
            return;
        }

        // Create the user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        // Give some output
        $this->info('Created user ' . $name . ' <' . $email . '>!');
    }

    /**
     * Validate the data.
     *
     * @param  string  $name
     * @param  string  $email
     * @param  string  $password
     *
     * @return void
     */
    protected function validate($name, $email, $password)
    {
        // Create a new Validator instance and validate
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:moon_users'],
            'password' => ['required', 'string', 'min:8']
        ]);

        // Show the messages if the validation failes
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->line($error);
            }

            $this->newLine();
            $this->error('The admin user could not be created due to validation errors.');
            $this->newLine();

            return false;
        }

        return true;
    }
}
