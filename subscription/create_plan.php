<?php
// Load Mercado Pago SDK
require '../vendor/autoload.php';

const ACCESS_TOKEN = "";
$mp = new MP(ACCESS_TOKEN);


$plan_configuration = array(
    "description" => "Test plan daily",
    "auto_recurring" => array(
        "frequency" => 10,
        "frequency_type" => "days",
        "transaction_amount" => 10,
        "currency_id" => "BRL"
    ),
    "external_reference" => "PLANODAILYTESTE"
);

$response = $mp->post(
    array(
        "uri" => "/v1/plans",
        "data" => $plan_configuration,
    )
);

print "<pre>";
print_r($response);
print "</pre>";
?>