<?php 

namespace App\Service;

use hisorange\BrowserDetect\Parser as Browser;
use Stevebauman\Location\Facades\Location;

class LogService {

    public static function userLog($logtitle, $logdescription){
        $location_data = Location::get(request()->ip());

        $log_data = [
            'log_name' => $logtitle,
            'log_description' => $logdescription,
            'log_browser' => 'browser_name: '.Browser::userAgent().', browser_type: '.Browser::deviceType(),
            'log_device_name' => 'is_bot: '.Browser::isBot().', device_name: '.Browser::platformName(),
            'log_ipaddress' => request()->ip(),
            'log_page_visit' => url()->full(),
            'log_country' => @$location_data->countryName,
            'log_state' => @$location_data->regionName,
            'log_city' => @$location_data->cityName,
            'log_postalcode' => @$location_data->zipCode,
            'log_latitude' => @$location_data->latitude,
            'log_longitude' => @$location_data->longitude,
            'log_type' => 'logging out',
        ];
        user_logs($log_data);
        return 'Successfully saved';
    }
}