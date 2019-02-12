<?php
require __DIR__ . '/vendor/autoload.php';

const ACCESS_TOKEN = "";
const PAYMENT_ID = "";

$uri = sprintf('/v1/payments/%d/refunds', PAYMENT_ID);
MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);

$options = array(
    "json_data" => json_encode( array(
        "amount" => floatVal(10)
    ))
);

$response = MercadoPago\SDK::post($uri, $options);

print '<pre>';
print_r($response);
print '</pre>';

?>