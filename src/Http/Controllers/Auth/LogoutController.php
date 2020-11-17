<?php

namespace JeroenvanRensen\MoonPHP\Http\Controllers\Auth;

class LogoutController
{
    /**
     * Log the current user out, using the moon guard.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        auth()->guard('moon')->logout();

        return redirect(route('moon.auth.login'))
            ->with('message', 'You are successfully logged out!');
    }
}
