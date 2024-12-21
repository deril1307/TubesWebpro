<?php

use Illuminate\Support\Str;

if (! function_exists('slugify')) {
    /**
     * Generate a slug from a string.
     *
     * @param  string  $string
     * @return string
     */
    function slugify($string)
    {
        return Str::slug($string);
    }
    
}
