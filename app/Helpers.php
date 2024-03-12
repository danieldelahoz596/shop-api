<?php

//Model Calls

use App\Models\UserLogs;
use App\Models\WebsiteGlobalSetting;

if (!function_exists('p')) {
    function p($data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit;
    }
}

if (!function_exists('v')) {
    function v($data) {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        exit;
    }
}

if (!function_exists('user_logs')) {
    function user_logs($data) {
        UserLog::create($data);
    }
}

if (!function_exists('get_settings')) {
    function get_settings($val) {
        $setting = WebsiteGlobalSetting::where('name', '=', $val)->first();
        return empty($setting['val']) ? '' : @$setting['val'];
    }
}