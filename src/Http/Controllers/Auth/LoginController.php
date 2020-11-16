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
        $data = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->guard('moon')->attempt($data, true)) {
            return redirect('/admin');
        }

        return back()->withInput(request()->only('email', 'remember'));
    }
}
