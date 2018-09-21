<?php
// Adicionando SDK PHP Mercado Pago
// https://github.com/mercadopago/sdk-php
require '../vendor/autoload.php';

// initializa MP Object from sdk
const ACCESS_TOKEN = "";
$mp = new MP(ACCESS_TOKEN);

// get payment
$response = $mp->get_payment_info("");

print "<pre>";
print '<br><br>=================<br>';
print 'Response:<br><br>';
print_r($response);
print "</pre>";

?>



