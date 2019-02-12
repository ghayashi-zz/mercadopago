<?php
require __DIR__ . '/vendor/autoload.php';

const ACCESS_TOKEN = "";

MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);

$payment = new MercadoPago\Payment();
$payment->transaction_amount = 989;
$payment->token = ""; // <- INSIRA AQUI O CARD_TOKEN
$payment->installments = 2;
$payment->payment_method_id = "master";
$payment->external_reference = "EXT010101";
$payment->notification_url = ""; // <- INSIRA AQUI A URL DE NOTIFICACAO
$payment->statement_descriptor = "FATURA";
$payment->payer = array( // <- COMPLETE COM OS DADOS DO CUSTOMER GRAVADO
    "type" => "customer",
    "id" => "",
    "first_name" => "",
    "last_name" => "",
    "identification" => array(
        "type" => "CPF",
        "number" => ""
    )
);

$response = $payment->save();

print '<pre>';
print_r($response);
print '</pre>';