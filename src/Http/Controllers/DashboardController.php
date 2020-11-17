<?php

namespace JeroenvanRensen\MoonPHP\Http\Controllers;

class DashboardController
{
    /**
     * Show the dashboard.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show()
    {
        return view('moon::dashboard');
    }
}
