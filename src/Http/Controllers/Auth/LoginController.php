<?php

namespace JeroenvanRensen\MoonPHP\Http\Controllers\Auth;

class LoginController
{
    /**
     * Show the login form.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show()
    {
        return view('moon::auth.login');
    }

    /**
     * Handle the login request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        if (auth()->guard('moon')->attempt(request(['email', 'password']), true)) {
            return redirect('/admin');
        }

        return redirect()->route('moon.auth.login')
            ->with('error', 'These credentials do not match our records.');
    }
}
