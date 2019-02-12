<?php
// Load Mercado Pago SDK
require '../vendor/autoload.php';

const ACCESS_TOKEN = "";
$mp = new MP(ACCESS_TOKEN);

$subscription_data = array(
    "plan_id" => "",
    "payer" => array(
        "id" => ""
    ),
    "external_reference" => "TESTESUBSCRIPTIONPLAN2",
    "description" => "SUBSCRIPTION DE TESTE CRIADA 2",
);

$response = $mp->post(
    array(
        "uri" => "/v1/subscriptions",
        "data" => $subscription_data,
    )
);

print "<pre>";
print_r($response);
print "</pre>";
?>