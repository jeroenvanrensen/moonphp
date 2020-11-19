<?php

namespace JeroenvanRensen\MoonPHP\Resources;

use Illuminate\Support\Str;

trait ResourceHelpers
{
    /**
     * Get a list of all resources and return them.
     *
     * @return array
     */
    public static function getResourcesList()
    {
        $resources = [];

        foreach (config('moonphp.resources', []) as $resource) {
            if (!is_object($resource)) {
                $resource = new $resource();
            }
            
            $name = Str::of($resource->name());

            $resources[] = [
                'name' => $name,
                'name_plural' => $name->plural(),
                'slug' => $name->plural()->slug(),
                'class' => $resource
            ];
        }

        return $resources;
    }

    /**
     * Get the resource by slug.
     *
     * @param  string  $slug
     *
     * @return mixed
     */
    public static function getResource(string $slug)
    {
        $resources = SELF::getResourcesList();

        $resourceArray = array_filter($resources, function($item) use ($slug) {
            return $item['slug'] == $slug;
        });

        if(count($resourceArray) == 0) {
            abort(404);
        }

        return new $resourceArray[0]['class']();
    }
}
