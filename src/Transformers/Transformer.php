<?php

namespace Devio\Pages\Transformers;

abstract class Transformer
{
    /**
     * Transform the given attributes.
     *
     * @param $attributes
     * @return static
     */
    public function transform($attributes)
    {
        return collect($attributes)->map(function ($value, $key) {
            // If there is a setter method for the given key, we will get the value
            // from that method, otherwise we will assume that the value provided
            // by the user doesn't need additional formatting and can be stored.
            return method_exists($this, $method = 'set' . studly_case($key)) ?
                call_user_func_array([$this, $method], [$value]) : $value;
        })->filter();
    }
}