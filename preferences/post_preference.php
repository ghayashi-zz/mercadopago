<?php
// Adicionando SDK PHP Mercado Pago
// https://github.com/mercadopago/sdk-php
require '../vendor/autoload.php';

// voce pode obter suas credenciais no link:
// https://www.mercadopago.com.br/account/credentials
const CLIENT_ID = "";
const CLIENT_SECRET = "";
$mp = new MP(CLIENT_ID,CLIENT_SECRET);

$preference_data = array(
	"items" => array(
		array(
			"id" => "001",
			"title" => "Iphone 3GS",
			"currency_id" => "BRL",
			"category_id" => "cellphone",
			"quantity" => 1,
			"unit_price" => 140
		),
		array(
			"id" => "002",
			"title" => "Adidas Jabulani",
			"currency_id" => "BRL",
			"category_id" => "sports",
			"quantity" => 1,
			"unit_price" => 60
		)
	),
	"payer" => array(
		"name" => "user1",
		"surname" => "test1",
		"email" => "teseu.tuset@gmail.com",
		"phone" => array(
			"area_code" => "11",
			"number" => "3221-1111"
		),
		"identification" => array(
			"type" => "CPF",
			"number" => "04128022012"
		),
		"address" => array(
			"street_name" => "Rua do Rocio",
			"street_number" => 10001,
			"zip_code" => "04552000"
		)
	),
	"shipments" => array(
		"receiver_address" => array(
			"street_name" => "Rua do Rocio",
			"street_number" => 10001,
			"zip_code" => "04552000"
		)
	),
	"additional_info" => array(
		"items" => array(
            array(
                "id" => "001",
				"title" => "Iphone 3GS",
				"description" => "Revolutionary Iphone 3GS",
				"category_id" => "phone", // Available categories at https://api.mercadopago.com/item_categories
				"quantity" => 1,
				"unit_price" => 140
			),
			array(
                "id" => "002",
				"title" => "Adidas Jabulani",
				"description" => "2010 World Cup Official Ball",
				"category_id" => "sports", // Available categories at https://api.mercadopago.com/item_categories
				"quantity" => 1,
				"unit_price" => 60
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
	"notification_url" => "https://webhook.site/020a74a3-05da-487f-9d10-ded280edd777",
	"external_reference" => "Reference_1235"
);

$response = $mp->create_preference($preference_data);

print "<pre>";
print '<br><br>=================<br>';
print 'Response:<br><br>';
print_r($response);
print "</pre>";

?>