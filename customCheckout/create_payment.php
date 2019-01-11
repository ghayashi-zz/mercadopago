<?php
// Load Mercado Pago SDK
require 'mercadopago.php';

// Parse data from POST
$installments = intVal($_POST["installments"]);
$docType = $_POST["docType"];
$paymentMethodId = $_POST["paymentMethodId"];
$transaction_amount = floatVal($_POST["transactionAmount"]);
$card_token_id = $_POST["token"];
$email = $_POST["email"];

const ACCESS_TOKEN = ""; // <- INSIRA AQUI SEU ACCESS_TOKEN
$mp = new MP(ACCESS_TOKEN);

// Set payment Data
$data = array(
    "transaction_amount" => $transaction_amount, // VALOR TOTAL DA COMPRA
    "description" => "Teste description", // DESCRIÇÃO DA COMPRA
    "token" => $card_token_id, // CARD TOKEN
    "payment_method_id" => $paymentMethodId, // ID da bandeira
    "installments" => $installments, // QUANTIDADE DE PARCELAS
    "external_reference" => "EXT010101", // IDENTIFICADOR EXTERNO
    "notification_url" => "https://webhook.site/8b5a0971-f1cc-4bec-a215-954fc1943eb6", // URL DE NOTIFICAÇÃO
    "statement_descriptor" => "FATURA",
    "additional_info" => array(
        "items" => array( // AQUI VAI TODA A DESCRIÇÃO DOS ITENS QUE COMPÕE O PAGAMENTO
            array(
                "id" => "002",
                "title" => "Adidas Jabulani",
                "description" => "2010 World Cup Official Ball",
                "category_id" => "sports", // Available categories at https://api.mercadopago.com/item_categories
                "quantity" => 1,
                "unit_price" => 100,
            ),
        ),
        "payer" => array( // AQUI VAI A DESCRIÇÃO SOBRE O PAGADOR
            "first_name" => 'FSTU',
            "last_name" => 'LSTU',
            "registration_date" => "2017-06-02T12:58:41.425-04:00",
            "phone" => array(
                "area_code" => "11",
                "number" => "4444-4444",
            ),
            "address" => array(
                "zip_code" => "06233-200",
                "street_name" => "Av. das Nações Unidas",
                "street_number" => "3003",
            ),
        ),
        "shipments" => array( // AQUI VAI A DESCRIÇÃO SOBRE A ENTREGA (SE NECESSARIO)
            "receiver_address" => array(
                "zip_code" => "04545000",
                "street_name" => "Rua das Fiandeiras",
                "street_number" => 1,
                "floor" => 7,
                "apartment" => "1171",
            ),
        ),
    ),
    "payer" => array(
        "email" => $email,
        "first_name" => 'FSTU',
        "last_name" => 'LSTU',
        "identification" => array(
            "type" => "CPF",
            "number" => "19119119100",
        ),
        "address" => array(
            "zip_code" => "06233-200",
            "street_name" => "Av. das Nações Unidas",
            "street_number" => "3003",
            "neighborhood" => "Bonfim",
            "city" => "Osasco",
            "federal_unit" => "SP",
        ),
    ),
);

$response = $mp->post(
    array(
        "uri" => "/v1/payments",
        "data" => $data,
    )
);

print "<pre>";
print_r($response);
print "</pre>";

?>