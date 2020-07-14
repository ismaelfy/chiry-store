<?PHP
require_once 'config.php';
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL            => "https://api.sandbox.paypal.com/v1/oauth2/token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING       => "",
    CURLOPT_MAXREDIRS      => 10,
    CURLOPT_TIMEOUT        => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST  => "POST",
    CURLOPT_POSTFIELDS     => "grant_type=client_credentials",
    CURLOPT_HTTPHEADER     => array(
        "Authorization: Basic QVJ1bDk5bVk5anR3MkhVNHVfRENpSlpsU1JVYUJEemYzQzVNTnZoRGM3RmdvZ2JBaVNnLWNIWE43X3A3LWx3MmY0OEZuSUNoekk0VDI3RFQ6RUJOa3Uyb25TSzhCNzcxLTRieWFjYUpxZFFwWUMyYWpxYXRfUUhuaExXQU1mWUx0elljLXdhSF9fNi1vYUFCZmo4UDlrOGxWbkk3U1FUcmQ=",
        "Content-Type: application/x-www-form-urlencoded",
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
