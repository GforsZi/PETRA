<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('set_active')) {
    function set_active($paths)
    {
        foreach ((array) $paths as $path) {
            if (Request::is($path) || Request::is($path . '/*')) {
                return 'active';
            }
        }
        return '';
    }
}

if (!function_exists('set_icon_active')) {
    function set_icon_active($paths)
    {
        foreach ((array) $paths as $path) {
            if (Request::is($path) || Request::is($path . '/*')) {
                return 'bi-record-circle-fill text-warning';
            }
        }
        return 'bi-circle';
    }
}

if (!function_exists('set_icon_active_exact')) {
    function set_icon_active_exact($path)
    {
        return Request::is($path) ? 'bi-record-circle-fill text-warning' : 'bi-circle';
    }
}

if (!function_exists('set_menu_open')) {
    function set_menu_open($paths)
    {
        foreach ((array) $paths as $path) {
            if (Request::is($path) || Request::is($path . '/*')) {
                return 'menu-open';
            }
        }
        return '';
    }
}
