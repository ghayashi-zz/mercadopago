<?php
// Load Mercado Pago SDK
require '../vendor/autoload.php';

const ACCESS_TOKEN = "";	// ADICIONE AQUI O ACCESS_TOKEN
$mp = new MP(ACCESS_TOKEN);

const URL_DE_NOTIFICACAO = "https://hook.io/ghayashi/notifications";
// Set payment Data
$data = array(
    "transaction_amount" => (float)10.50,
    "description" => "Teste payment MP Boleto",
    "payment_method_id" => "bolbradesco",
	"external_reference" => "PAYCD001",
	"notification_url" => URL_DE_NOTIFICACAO,
    "additional_info" => array(
		"items" => array(
			array(
                "id" => "002",
				"title" => "Adidas Jabulani",
				"description" => "2010 World Cup Official Ball",
				"category_id" => "sports", // Available categories at https://api.mercadopago.com/item_categories
				"quantity" => 1,
				"unit_price" => 10
			)
        ),
		"payer" => array(
            "first_name" => 'FSTU',
		    "last_name" => 'LSTU',
			"registration_date" => "2017-06-02T12:58:41.425-04:00",
			"phone" => array(
                "area_code" => "11",
				"number" => "4444-4444"
            ),
			"address" => array(
                "zip_code" => "06233-200",
                "street_name" => "Av. das Nações Unidas",
                "street_number" => "3003"
		    )
        ),
		"shipments" => array(
            "receiver_address" => array(
                "zip_code" => "04552000",
				"street_name" => "Rocio",
				"street_number" => 123,
				"floor" => 7,
				"apartment" => "71"
            )
        )
	),
	"payer" => array (
		"email" => 'teseu.tuset@gmail.com',
		"first_name" => 'FSTU',
		"last_name" => 'LSTU',
		"identification" => array(
			"type" => "CPF",
			"number" => "19119119100"
		),
		"address" => array(
			"zip_code" => "06233-200",
			"street_name" => "Av. das Nações Unidas",
			"street_number" => "3003",
			"neighborhood" => "Bonfim",
			"city" => "Osasco",
			"federal_unit" => "SP"
		)
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