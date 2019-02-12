<?php
// Load Mercado Pago SDK
require '../vendor/autoload.php';

const ACCESS_TOKEN = "APP_USR-2535052743500593-010317-679d6ba0eb56f8a0211929fda04af67a-227942753"; // ADICIONE AQUI O ACCESS_TOKEN
$mp = new MP(ACCESS_TOKEN);

$external_references = array(462210, 460826, 460817, 460793, 460708, 460213, 459473, 459362, 459269, 459258, 459254, 459232, 459221, 459188, 459174, 459172, 459162, 458993, 458936, 458721, 458717, 458714, 458708, 458682, 458622, 458613, 457862, 457796, 457766, 457093, 457080, 456674, 456578, 456338, 456332, 456287, 456259, 456249, 456242, 456233, 456228, 456055, 456055, 455524, 455523, 455354, 455251, 455241, 455229, 455214, 455054, 454956);

foreach ($external_references as $external) {
    $payment = $mp->get(
        "/v1/payments/search",
        array(
            "external_reference" => "WC-" . $external,
            "limit" => 1
        )
    );

    if ( $payment['status'] == 200 && $payment['response']['results'] ) {
        var_dump($payment['response']['results'][0]['id']);
    } else {
        var_dump('Payment nao existe');

    }
}