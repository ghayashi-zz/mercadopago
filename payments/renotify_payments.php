<?php
// Load WEBHOOK_SENDER
require '../lib/webhook_sender.php';
require '../vendor/autoload.php';

$mp = new MP('');

// Initialize Webhook Sender
$webhook_sender = new WEBHOOK_SENDER(true);

// notification_url - id
$url_template = ''; // <-- notification URL

// ARRAY 1
$payments = array( // <- LISTA DE PAGAMENTOS

);

$body_template = '{
   "id": %s,
   "live_mode": true,
   "type": "payment",
   "date_created": "%s",
   "user_id": 182197995,
   "api_version": "v1",
   "action": "payment.updated",
   "data": {
       "id": "%s"
   }
}';

foreach( $payments as $payment_id ) {
    $payment = $mp->get_payment_info($payment_id);

    if ( $payment['status'] == 200 || $payment['status'] == 201 ) {
        // extract date_created
        $date_created = $payment['response']['date_created'];

        // extract notification_url
        $notification_url = sprintf($url_template, $payment_id);

        // prepare body
        $body = sprintf($body_template, $payment_id, $date_created, $payment_id);
        // send notifcation
        $webhook_sender->send($notification_url,$body);
    } else {
        print '<pre>Payment: ';
        print_r($payment_id);
        print '<br>NOT FOUND';
        print '</pre>';
    }
}

?>