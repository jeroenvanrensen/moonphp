<?php

namespace JeroenvanRensen\MoonPHP\Http\Livewire\Resources;

use Illuminate\Support\Str;
use JeroenvanRensen\MoonPHP\Resource;
use Livewire\Component;

class ResourceIndex extends Component
{
    /**
     * The curent resource class.
     *
     * @var mixed
     */
    protected $resource;

    /**
     * Assign the $resource variable.
     *
     * @param  string $resource
     *
     * @return void
     */
    public function mount(string $resource)
    {
        $this->resource = Resource::getResource($resource);
    }

    /**
     * Render the component on the page.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $rows = $this->resource->model()::all();

        $title = Str::of($this->resource->name())->plural();

        return view('moon::resources.index', [
            'title' => $title,
            'columns' => $this->resource->columns(),
            'rows' => $rows
        ])->layout('moon::layouts.app', ['title' => $title]);
    }
}
