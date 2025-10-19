<?php

namespace App;

use Illuminate\Support\Arr;

if (!function_exists('variants')) {
    function variants(array $classes, string $variants): string {
        $resolved = array_values(Arr::only($classes, explode(' ', $variants)));

        return implode(' ', $resolved);
    }
}
