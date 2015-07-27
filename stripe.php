<?php
session_start();

$stripe = $_GET['code'];

$url = 'https://connect.stripe.com/oauth/token';
$data = array('client_secret' => 'sk_test_c5jDuIwcQArqHcEl7zWdVkhk', 'code' => $stripe, 'grant_type' => 'authorization_code');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

$json = json_decode($result, TRUE);
print_r($json);

echo $json['access_token'];
$sat = $json['access_token']; 

$urlParse = 'https://api.parse.com/1/classes/Store/Ed1nuqPvcm';

$data = array("stripe_access_token" => $sat);
$ch = curl_init($urlParse);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-Parse-Application-Id: N98A1TIFGV03dKmHbXHJR5gQmVWrC3Qi4uNGpM8b',
    'X-Parse-REST-API-Key: HcnY4NmM1lYHvomjz87KQlbAkSzJhBBb85WOFth9',
    ));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));


$response = curl_exec($ch);
echo $response;

if(!$response) {
    return false;
}

header( 'Location: http://store.endline.io' ) ;




//header( 'Location: localhost/~lcadmin/endLinesApp/' ) ;


?>
