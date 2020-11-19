<?php

namespace JeroenvanRensen\MoonPHP\Http\Controllers;

use JeroenvanRensen\MoonPHP\Resource;
use Illuminate\Support\Str;

class ResourceController
{
    public function index($resource)
    {
        $resource = Resource::getResource($resource);

        $model = $resource->model();

        $rows = $model::all();

        return view('moon::resources.index', [
            'columns' => $resource->columns(),
            'rows' => $rows,
            'title' => Str::of($resource->name())->plural()
        ]);
    }
}
