<?php
define('BASE_URL', 'http://chiry.test/');
define('API_STATE', true); # true (production) | false (beta)
define('MONEDA', 'USD');

if (API_STATE) {
    # PRODUCTION
    define('CLIENTE_ID', 'Ae0m7RRBEW4ZwxJ0YPixbL7fENTr2PU446hmVpzAjGPSuI8KjVwdnXyPYJBF0SpyYpwLLACcOm7dYGHG');
    define('SECRET_KEY', 'EHw831YdfAHFGxwNHMxTVFRqsGnU1EeY_kOxvnVnToeOqzVlg4B54E-nu48YfH32Pm8y-HaaliNVXsM2');
    define('API_URL', 'https://api.paypal.com/');
} else {
    # BETA
    define('API_URL', 'https://api.sandbox.paypal.com/');
    define('CLIENTE_ID', 'ARul99mY9jtw2HU4u_DCiJZlSRUaBDzf3C5MNvhDc7FgogbAiSg-cHXN7_p7-lw2f48FnIChzI4T27DT');
    define('SECRET_KEY', 'EBNku2onSK8B771-4byacaJqdQpYC2ajqat_QHnhLWAMfYLtzYc-waH__6-oaABfj8P9k8lVnI7SQTrd');
}

function sendData($data = null)
{
    echo json_encode($data);
}

function get_authorization()
{
    $user = CLIENTE_ID;
    $pwd = SECRET_KEY;
    return base64_encode("$user:$pwd");
}
require './vendor/autoload.php';

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

function getApiContext()
{

    // #### SDK configuration
    // Register the sdk_config.ini file in current directory
    // as the configuration source.
    /*
    if(!defined("PP_CONFIG_PATH")) {
        define("PP_CONFIG_PATH", __DIR__);
    }
    */

    // ### Api context
    // Use an ApiContext object to authenticate
    // API calls. The clientId and clientSecret for the
    // OAuthTokenCredential class can be retrieved from
    // developer.paypal.com

    $apiContext = new ApiContext(new OAuthTokenCredential(CLIENTE_ID, SECRET_KEY));

    // Comment this line out and uncomment the PP_CONFIG_PATH
    // 'define' block if you want to use static file
    // based configuration

    $apiContext->setConfig(
        array(
            'mode' => (API_STATE) ? 'live' : 'sandbox',
            'log.LogEnabled' => true,
            'log.FileName' => 'paypal.log',
            'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            //'cache.FileName' => '/PaypalCache' // for determining paypal cache directory
            // 'http.CURLOPT_CONNECTTIMEOUT' => 30
            // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
            //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
        )
    );

    // Partner Attribution Id
    // Use this header if you are a PayPal partner. Specify a unique BN Code to receive revenue attribution.
    // To learn more or to request a BN Code, contact your Partner Manager or visit the PayPal Partner Portal
    // $apiContext->addRequestHeader('PayPal-Partner-Attribution-Id', '123123123');

    return $apiContext;
}
