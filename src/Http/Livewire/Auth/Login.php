<?php

namespace JeroenvanRensen\MoonPHP\Http\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    /**
     * The user's email address.
     *
     * @var string
     */
    public $email;

    /**
     * The user's password.
     *
     * @var string
     */
    public $password;

    /**
     * The validation rules for this component.
     *
     * @var array
     */
    protected $rules = [
        'email' => ['required', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8']
    ];

    /**
     * Validate the fields when they are updated.
     *
     * @param  string $property
     *
     * @return void
     */
    public function updated($property)
    {
        $this->validateOnly($property);
    }

    /**
     * Try to log the user in.
     * 
     * @return void|\Illuminate\Http\RedirectResponse
     */
    public function login()
    {
        $this->validate();

        $success = auth()->guard('moon')
            ->attempt([
                'email' => $this->email, 
                'password' => $this->password
            ], true);

        if ($success) {
            return redirect()->route('moon.dashboard');
        }

        session()->flash('error', 'These credentials do not match our records.');
    }

    /**
     * Render the component on the page.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('moon::auth.login')
            ->layout('moon::layouts.auth', ['title' => 'Login']);
    }
}
