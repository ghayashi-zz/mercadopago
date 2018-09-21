<?php
// Load Mercado Pago SDK
require '../vendor/autoload.php';

const ACCESS_TOKEN = "TEST-1576070037856146-121312-329f2248aa5d7a178f27b88d6bfd574a__LC_LA__-203709017";
$mp = new MP(ACCESS_TOKEN);

$response = $mp->refund_payment(14942533);

print "<pre>";
print_r($response);
print "</pre>";
?>