<?php
use Illuminate\Support\Facades\Http;

//Model Calls
use App\Models\User;
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
        UserLogs::create($data);
    }
}

if (!function_exists('get_settings')) {
    function get_settings($val) {
        $setting = WebsiteGlobalSetting::where('name', '=', $val)->first();
        return empty($setting['val']) ? '' : @$setting['val'];
    }
}

if (!function_exists('randon_prefix')) {
    function randon_prefix($val) {
        $random = "";
        srand((float) microtime() * 1000000);
        $data = "A0B1C2DE3FG4HIJ5KLM6NOP7QR8ST9UVW0XYZ";
        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;
    }
}

if (!function_exists('movider_service')) {
    function movider_service() {
        //movider
    }
}

if (!function_exists('otp_generator')) {
    function otp_generator() {
        $otp_compare = mt_rand(111111, 999999);
        $user_data = User::where('otp_code', $otp_compare)->first();
        $otp = '';
        if (isset($user_data)) {
            $otp_random = mt_rand(111111, 999999);
            $otp = $otp_random;
        } else {
            $otp =  $otp_compare;
        }

        return $otp;
    }
}