<?php
require 'vendor/autoload.php';

// configure mercado pago credentials
const ACCESS_TOKEN = "";

// validate if post has submitted
if (isset($_POST) && count($_POST) > 0) {
    // initialize mercado pago object
    // $mp = new MP(CLIENT_ID, CLIENT_SECRET);
    $mp = new MP(ACCESS_TOKEN);

    $items = array(mount_items($_POST));
    $payer = mount_payer($_POST);

    // mount preference
    $preference = array(
        "items" => $items,
        "payer" => $payer,
        "additional_info" => array(
            "items" => $items,
            "payer" => $payer
        ),
        "notification_url" => "https://webhook.site/47bc3388-d222-4f07-ba4a-ebbb9e7c13e2",
        "external_reference" => $_POST['external_reference'],
        "payment_methods" => array(
            "excluded_payment_methods" => mount_payment_method($_POST),
            "installments" => (int) $_POST['max_installments'],
        )
    );

    var_dump(json_encode($preference));

    // call mercado pago's api to create preference
    $response = $mp->create_preference($preference);

    // control the result and extract the link
    $success = false;
    $payment_details = array();
    if ( $response['status'] == 201 ) {
        $success = true;
        $payment_details = array(
            "production_link" => $response['response']['init_point'],
            "sandbox_link" => $response['response']['sandbox_init_point'],
            "preference_id" => $response['response']['id'],
            "date_created" => $response['response']['date_created']
        );
    } else {
        $status_code = $response['status'];
        $message = $response['response']['message'];
    }
}

/**
 * Mount array with items configuration
 *
 * @param [type] $post
 * @return void
 */
function mount_items($post) {
    return array(
        "id" => "",
        "title" => $_POST['description'],
        "currency_id" => "BRL",
        "category_id" => "others",
        "quantity" => 1,
        "unit_price" => (float)$_POST['amount']
    );
}

/**
 * Mount array with payer configuration
 *
 * @param [type] $post
 * @return void
 */
function mount_payer($post) {
    // explode name to divide into first and last name
    $name = explode(" ", $post['name']);

    // explode phone to divide into area code and number
    $phone = explode(" - ", $post['phone']);

    return array(
        "name" => isset($name[0]) ? $name[0] : "",
        "surname" => isset($name[1]) ? $name[1] : "",
        "email" => $post['email'],
        "phone" => array(
            "area_code" => isset($phone[0]) ? $phone[0] : "",
            "number" => isset($phone[1]) ? $phone[1] : ""
        ),
        "identification" => array(
          "type" => $post['document_type'],
          "number" => $post['document_number']
        ),
        "address" => array(
			"street_name" => $post['street_address'],
			"street_number" => $post['street_number'],
			"zip_code" => $post['zipcode']
		)
    );
}

/**
 * Mount array with excluded payment_methods
 *
 * @param [type] $post
 * @return void
 */
function mount_payment_method($post) {
    // default payment_methods
    $default_payment_methods = array("visa", "master", "hipercard", "amex", "elo", "melicard", "diners", "pec", "bolbradesco");

    // get the difference to extract payment_methods to exclude
    $diff = array_diff($default_payment_methods, $post['included_payment_methods']);

    $excluded_payment_methods = array();
    foreach( $diff as $id ) {
        $excluded_payment_methods[] = array("id" => $id);
    }

    return $excluded_payment_methods;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Preferences Builder">
    <meta name="author" content="Mercado Pago Developers">
    <title>Preference Builder</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
  </head>

  <body class="bg-light">
    <div class="container">
      <div class="py-5 text-center">
        <div style="margin-bottom:10px">
          <img src="https://www.mercadopago.com/org-img/Manual/ManualMP/imgs/isologoHorizontal.png" alt="Mercado Pago" title="Mercado Pago" width="220" height="60">
        </div>
        <h2>Preferences Builder</h2>
        <p class="lead">Detalhes da preferência criada</p>
      </div>

      <div class="container-fluid">
        <?php if ( $success ) { ?>
            <div class="alert alert-success" role="alert">
                <strong>Link de pagamento criado com sucesso !</strong>
            </div>


            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>ID da preferencia</td>
                        <td><?= $payment_details['preference_id'];?></td>
                    </tr>
                    <tr>
                        <td>Data de Criação</td>
                        <td><?= $payment_details['date_created'];?></td>
                    </tr>
                    <tr>
                        <td>Link de pagamento</td>
                        <td><a href="<?=$payment_details['production_link'];?>"><?=$payment_details['production_link'];?></a></td>
                    </tr>
                </tbody>
            </table>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Utilizar somente em ambiente Sandbox</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <hr>
                <a href="<?=$payment_details['sandbox_link'];?>"><?=$payment_details['sandbox_link'];?></a>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                <p>Erro ao criar link de pagamento !</p>
                <hr>
                <p><?php echo "Status Code: " . $status_code ?></p>
                <p><?php echo "Message: " . $message ?></p>
            </div>
        <?php } ?>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2018 Mercado Pago Developers</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a target="_blank" href="http://developers.mercadopago.com/">Developers Site</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="jquery-3.3.1.slim.min"><\/script>')</script>
    <script src="bootstrap.min.js"></script>
  </body>
</html>