<?php
require __DIR__ . '/vendor/autoload.php';

const ACCESS_TOKEN = "";

MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);

$customer = new MercadoPago\Customer();
$customer->email = "";
$customer->first_name = "";
$customer->last_name = "";

$customer->phone = array(
    "area_code" => "11",
    "number" => "932211111",
);

$customer->identification = array(
    "type" => "CPF",
    "number" => "66343216715",
);

$customer->address = array(
    "zip_code" => "04545-000",
    "street_name" => "Rua das Fiandeiras",
);

$customer->description = "Customer da Loja";

$response = $customer->save();

print '<pre>';
print_r($response);
print '</pre>';