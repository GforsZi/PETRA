<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('set_active')) {
    function set_active($paths, $output = 'active')
    {
        if (is_array($paths)) {
            foreach ($paths as $path) {
                if (Request::is($path)) {
                    return $output;
                }
            }
        } else {
            if (Request::is($paths)) {
                return $output;
            }
        }
        return '';
    }
}

if (!function_exists('set_menu_open')) {
    function set_menu_open($paths, $output = 'menu-open')
    {
        if (is_array($paths)) {
            foreach ($paths as $path) {
                if (Request::is($path)) {
                    return $output;
                }
            }
        } else {
            if (Request::is($paths)) {
                return $output;
            }
        }
        return '';
    }
}
