<?php

require 'ovh/autoload.php';
use \Ovh\Api;

function connect_ovh() {

    // Informations about your application
    $applicationKey 	= lire_config('amap_extra/ovh_appkey');
    $applicationSecret 	= lire_config('amap_extra/ovh_appsecret');
    $consumer_key 		= lire_config('amap_extra/ovh_consumerkey');

    // Information about API endpoint used
    $endpoint 		= 'ovh-eu';

    // Get servers list
    $conn = new Api(    $applicationKey,
                        $applicationSecret,
                        $endpoint,
                        $consumer_key);

    return $conn;

}
