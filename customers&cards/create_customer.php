<?php
// Load Mercado Pago SDK
require '../vendor/autoload.php';

const ACCESS_TOKEN = ""; // ADICIONE AQUI SEU ACCESS_TOKEN
$mp = new MP(ACCESS_TOKEN);


$customer_data = array(
    "email" => "" // ADICIONE AQUI O E-MAIL DO CUSTOMER
);

$response = $mp->post(
    array(
        "uri" => "/v1/customers",
        "data" => $customer_data,
    )
);

print "<pre>";
print_r($response);
print "</pre>";

?>