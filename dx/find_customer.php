<?php
require __DIR__ . '/vendor/autoload.php';

const ACCESS_TOKEN = "";

MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);

$filters = array(
    "email" => "" // <- INSIRA AQUI O E-MAIL
);

$customer = MercadoPago\Customer::search($filters);

print '<pre>';
print_r($customer);
print '</pre>';