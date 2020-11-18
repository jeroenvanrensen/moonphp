<?php

namespace JeroenvanRensen\MoonPHP;

use JeroenvanRensen\MoonPHP\Resources\ResourceHelpers;

class Resource
{
    use ResourceHelpers;

    public function name()
    {
        if (property_exists($this, 'name')) {
            return $this->name;
        }

        return class_basename($this);
    }

    public function model()
    {
        if (is_object($this->model)) {
            return $this->model;
        }

        return new $this->model();
    }
}
