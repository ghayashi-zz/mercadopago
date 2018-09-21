<?php
// Load Mercado Pago SDK
require '../vendor/autoload.php';

const ACCESS_TOKEN = "";    // ADICIONE AQUI O ACCESS_TOKEN
$mp = new MP(ACCESS_TOKEN);

$payment_id = "";           // ADICIONE AQUI O NUMERO DO PAGAMENTO A SER CANCELADO
$response = $mp->cancel_payment($payment_id);

print "<pre>";
print_r($response);
print "</pre>";
?>