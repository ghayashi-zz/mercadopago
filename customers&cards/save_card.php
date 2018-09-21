<?php
// Load Mercado Pago SDK
require '../vendor/autoload.php';

const ACCESS_TOKEN = ""; // ADICIONE AQUI O SEU ACCESS_TOKEN
$mp = new MP(ACCESS_TOKEN);

$card_token_id = "";    // ADICIONE AQUI O CARD_TOKEN GERADO
$customer_id = "";      // ADICIONE AQUI O CUSTOMER_ID

/**
 * Pre Requisitos
 * -> informar um card_token
 * -> informar um customer_id
 */
$card_data = array(
    "token" => $card_token_id
);

$response = $mp->post(
    array(
        "uri" => "/v1/customers/" . $customer_id . "/cards",
        "data" => $card_data,
    )
);

print "<pre>";
print_r($response);
print "</pre>";
?>