<?php
// Load Mercado Pago SDK
require '../vendor/autoload.php';

const ACCESS_TOKEN = "";
$mp = new MP(ACCESS_TOKEN);

$card_token_id = ""; // INSIRA EU CARD_TOKEN

// Set payment Data
$data = array(
    "transaction_amount" => (float) 1000.25, // VALOR TOTAL DA COMPRA
    "description" => "Teste description", // DESCRIÇÃO DA COMPRA
    "token" => $card_token_id, // CARD TOKEN
    "payment_method_id" => "visa", // ID da bandeira
	"installments" => 1, // QUANTIDADE DE PARCELAS
	"external_reference" => "EXT010101", // IDENTIFICADOR EXTERNO
	"notification_url" => "https://webhook.site/47bc3388-d222-4f07-ba4a-ebbb9e7c13e2", // URL DE NOTIFICAÇÃO
	"statement_descriptor" => "FATURA",
    "additional_info" => array(
		"items" => array( // AQUI VAI TODA A DESCRIÇÃO DOS ITENS QUE COMPÕE O PAGAMENTO
			array(
                "id" => "002",
				"title" => "Adidas Jabulani",
				"description" => "2010 World Cup Official Ball",
				"category_id" => "sports", // Available categories at https://api.mercadopago.com/item_categories
				"quantity" => 1,
				"unit_price" => 60
			)
        ),
		"payer" => array( // AQUI VAI A DESCRIÇÃO SOBRE O PAGADOR
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
		"shipments" => array( // AQUI VAI A DESCRIÇÃO SOBRE A ENTREGA (SE NECESSARIO)
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