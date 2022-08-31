<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('pageTabActive')) {
    function pageTabActive($route_name)
    {
        return str_starts_with(Route::currentRouteName(), $route_name) ? true : false;
    }
}

if (!function_exists('pageActive')) {
    function pageActive($route_name)
    {
        return Route::currentRouteName() == $route_name ? true : false;
    }
}

if (!function_exists('shorten_number')) {
    function shorten_number(int $number)
    {
        $suffix = ["", "K", "M", "B"];
        $precision = 2;
        for ($i = 0; $i < count($suffix); $i++) {
            $divide = $number / pow(1000, $i);
            if ($divide < 1000) {
                return round($divide, $precision) . $suffix[$i];
                break;
            }
        }
    }
}

if (!function_exists('updateDotEnv')) {
    function updateDotEnv($key, $newValue, $delim = '')
    {
        $path = base_path('.env');
        $oldValue = env($key);

        if ($oldValue === $newValue) return;

        if (file_exists($path)) {
            file_put_contents(
                $path, str_replace(
                    $key . '=' . $delim . $oldValue . $delim,
                    $key . '=' . $delim . $newValue . $delim,
                    file_get_contents($path)
                )
            );
        }
    }
}

if (!function_exists('formatCurrency')) {
    function formatCurrency($value)
    {
        return config('custom.currency_symbol_' . LaravelLocalization::getCurrentLocale()) . " " . number_format($value, 2);
    }
}

if (!function_exists('formatDateTime')) {
    function formatDateTime($value)
    {
        return $value->format('d-m-Y h:i:s A');
    }
}

if (!function_exists('formatDate')) {
    function formatDate($value)
    {
        return $value->format('d-m-Y');
    }
}

if (!function_exists('dateDiff')) {
    function dateDiff($date1, $date2)
    {
        $final = "";
        $diff = abs(strtotime($date2) - strtotime($date1));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $final .= $years > 0 ? strval($years) . " " . __('app.years') . " " : '';
        $final .= $months > 0 ? strval($months) . " " . __('app.months') . " " : '';
        $final .= $days > 0 ? strval($days) . " " . __('app.days') . " " : '';
        $final .= " " . __('app.left');

        return $final;
    }
}