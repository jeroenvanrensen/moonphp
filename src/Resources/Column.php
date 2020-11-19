<?php

namespace JeroenvanRensen\MoonPHP\Resources;

use Illuminate\Support\Str;

class Column
{
    /**
     * The type of the column.
     *
     * @var string
     */
    public $type = 'text';

    /**
     * The name of the column.
     *
     * @var string
     */
    public $column;

    /**
     * The label/name for the column.
     *
     * @var string
     */
    public $label;

    /**
     * Set the name for this column.
     *
     * @param  string  $name
     *
     * @return $this
     */
    public function name(string $name, string $column = null)
    {
        if(!$column) {
            $column = (string) Str::of($name)->snake();
        }

        $this->label = $name;
        $this->column = $column;

        return $this;
    }

    /**
     * Return an array of the columns.
     *
     * @return array
     */
    public function make()
    {
        return [
            'type' => $this->type,
            'column' => $this->column,
            'label' => $this->label
        ];
    }
}
