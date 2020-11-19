<?php

namespace JeroenvanRensen\MoonPHP;

use Illuminate\Support\Facades\Facade;

class Column extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'column';
    }
}
