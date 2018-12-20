<?php
// Load Mercado Pago SDK
require '../vendor/autoload.php';

const ACCESS_TOKEN = "";
$mp = new MP(ACCESS_TOKEN);

$id = isset($_POST["id"]) ? $_POST["id"] : null;
$topic = isset($_POST["type"]) ? $_POST["type"] : null;

if ($topic == "payment" && !is_null($id)) {
    // GET as informacoes do payment ID recebido no request
    $payment_info = $mp->get_payment_info($id);

    if (intVal($payment_info["status"]) > 400) {
        print '<pre>';
        print_r('Status: ');
        print_r($payment_info["status"]);
        print '</pre>';

        die('Tratamento para retornos 4XX nas consulta a /v1/payments/:ID');
    }

    // verifica o status do payment
    $payment_status = $payment_info["response"]["status"];
    $payment_status_detail = $payment_info["response"]["status_detail"];

    /**
     * Insira o seu código para atualizar o status do pagamento aqui
     * ...
     */
    print '<pre>';
    print_r('Status: ');
    print_r($payment_status);
    print '</pre>';
    print '<pre>';
    print_r('Status Detail: ');
    print_r($payment_status_detail);
    print '</pre>';

    // verifica se possui order (merchant_order)
    $order_id = $payment_info["response"]["order"]["id"];
    $merchant_order_info = $mp->get('/merchant_orders/' . $order_id);

    // valida se encontrou a order
    if (intVal($merchant_order_info["status"]) > 400) {
        print '<pre>';
        print_r('Order não encontrada. Status: ');
        print_r($merchant_order_info["status"]);
        print '</pre>';

        die('Tratamento para retornos 4XX nas consulta a /v1/payments/:ID');
    }

    // Se encontrou a order, então percorre todos os pagamentos que comppoe este pedido
    if (count($merchant_order_info["response"]["payments"]) > 0) {
        foreach ($merchant_order_info["response"]["payments"] as $payment) {
            /**
             * Loop para verificar todos os pagamentos que compõe a order
             * Insira o seu código para atualizar o status do pagamento aqui
             * ...
             */
            print '<pre>';
            print_r('Order - Payment ID: ');
            print_r($payment["id"]);
            print '</pre>';
            print '<pre>';
            print_r('Order - Payment Status: ');
            print_r($payment["status"]);
            print '</pre>';
            print '<pre>';
            print_r('Order - Payment Status Detail: ');
            print_r($payment["status_detail"]);
            print '</pre>';

        }
    }
}
