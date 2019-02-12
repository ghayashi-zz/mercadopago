<?php
require __DIR__ . '/vendor/autoload.php';

const ACCESS_TOKEN = "";

MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);

$card = new MercadoPago\Card();
$card->token = "";
$card->customer_id = "";

$response = $card->save();

print '<pre>';
print_r($response);
print '</pre>';