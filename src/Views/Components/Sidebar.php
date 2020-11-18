<?php

namespace JeroenvanRensen\MoonPHP\Views\Components;

use Illuminate\View\Component;
use JeroenvanRensen\MoonPHP\Resource;

class Sidebar extends Component
{
    /**
     * All the available resources.
     *
     * @var array
     */
    public $resources;

    /**
     * Create the component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->resources = Resource::getResourcesList();
    }

    /**
     * Get the view that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('moon::layouts._sidebar');
    }
}