<?php

namespace JeroenvanRensen\MoonPHP\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    /**
     * Render the component on the page.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('moon::dashboard')
            ->layout('moon::layouts.app', ['title' => 'Dashboard']);
    }
}
