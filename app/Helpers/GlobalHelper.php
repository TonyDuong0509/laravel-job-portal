<?php

namespace App\Helpers;

// Check input error
if (!function_exists('hasError')) {
    function hasError($errors, string $name): string
    {
        return $errors->has($name) ? 'is-invalid' : '';
    }
}
