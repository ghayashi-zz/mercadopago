<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Preferences Builder">
    <meta name="author" content="Mercado Pago Developers">
    <title>Preference Builder</title>

    <!-- Custom styles for this template -->
    <link href="https://mercadopago.mlstatic.com/frontend/prodfury/static/x8qFA4gXUO7a7BeTehmlaupXfCMk4UYA3pmueRzfsql.css" type="text/css" rel="stylesheet" media="screen, projection">

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
        <p class="lead">Crie seu link de pagamento personalizado.</p>
      </div>

      <!-- form -->
      <div class="container-fluid">
        <form action="generate.php" method="POST">
          <!-- Payer -->
          <div class="form-group">
            <h4>Dados do Pagador</h4>
            <div class="form-row">
              <div class="form-group col">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
              <div class="form-group col">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>
              <div class="form-group col-md-2">
                <label for="phone">Telefone</label>
                <input type="text" class="form-control" id="phone" name="phone">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="document_type">Tipo do documento</label>
                <select class="custom-select mr-sm-2" name="document_type">
                  <option value="CPF">CPF</option>
                  <option value="CNPJ">CNPJ</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="document_number">Número</label>
                <input type="number" class="form-control" id="document_number" name="document_number">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col">
                <label for="street_address">Endereço</label>
                <input type="text" class="form-control" id="street_address" name="street_address">
              </div>
              <div class="form-group col-md-2">
                <label for="street_number">Número</label>
                <input type="text" class="form-control" id="street_number" name="street_number">
              </div>
              <div class="form-group col-md-3">
                <label for="zipcode">CEP</label>
                <input type="text" class="form-control" id="zipcode" name="zipcode">
              </div>
            </div>
          </div>

          <!-- Items -->
          <div class="form-group">
              <h4>Dados da Compra</h4>
              <div class="form-row">
                <div class="form-group col">
                <label for="description">Descrição</label>
                <input type="text" class="form-control" id="description" name="description">
              </div>
              <div class="form-group col-md-3">
                <label for="external_reference">Código de Referencia</label>
                <input type="text" class="form-control" id="external_reference" name="external_reference">
              </div>
            </div>
          </div>

          <!-- Payment -->
          <div class="form-group">
            <h4>Configuração do pagamento</h4>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="amount">Valor</label>
                <input type="text" class="form-control" id="amount" name="amount">
              </div>
              <div class="form-group col-md-4">
                <label for="max_installments">Quantidade de parcelas</label>
                <select class="custom-select mr-sm-2" name="max_installments">
                  <option selected>Selecione</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Payment Methods -->
          <div class="form-group">
            <!-- Credit cards -->
            <div class="form-row"><label>Cartões aceitos</label></div>
            <div class="form-row">
              <div class="form-check col-md-1">
                <input class="image_checkbox" name="included_payment_methods[]" id="visa" value="visa" type="checkbox" checked="">
                <label for="visa">
                  <span class="paymentmethod-visa" alt="Visa" title="Visa">visa</span>
                </label>
              </div>

              <div class="form-check col-md-1">
                <input class="image_checkbox" name="included_payment_methods[]" id="master" value="master" type="checkbox" checked="">
                <label for="master">
                  <span class="paymentmethod-master" alt="Mastercard" title="Mastercard">master</span>
                </label>
              </div>

              <div class="form-check col-md-1">
                <input class="image_checkbox" name="included_payment_methods[]" id="hipercard" value="hipercard" type="checkbox" checked="">
                <label for="hipercard">
                  <span class="paymentmethod-hipercard" alt="Hipercard" title="Hipercard">hipercard</span>
                </label>
              </div>

              <div class="form-check col-md-1">
                <input class="image_checkbox" name="included_payment_methods[]" id="amex" value="amex" type="checkbox" checked="">
                <label for="amex">
                  <span class="paymentmethod-amex" alt="American Express" title="American Express">amex</span>
                </label>
              </div>

              <div class="form-check col-md-1">
                <input class="image_checkbox" name="included_payment_methods[]" id="elo" value="elo" type="checkbox" checked="">
                <label for="elo">
                  <span class="paymentmethod-elo" alt="Elo" title="Elo">elo</span>
                </label>
              </div>

              <div class="form-check col-md-1">
                <input class="image_checkbox" name="included_payment_methods[]" id="melicard" value="melicard" type="checkbox" checked="">
                <label for="melicard">
                  <span class="paymentmethod-melicard" alt="Cartão MercadoLivre" title="Cartão MercadoLivre">melicard</span>
                </label>
              </div>

              <div class="form-check col-md-2">
                <input class="image_checkbox" name="included_payment_methods[]" id="diners" value="diners" type="checkbox" checked="">
                <label for="diners">
                  <span class="paymentmethod-diners" alt="Diners" title="Diners">diners</span>
                </label>
              </div>

            </div>

            <!-- Tickets -->
            <div class="form-row"><label>Boleto</label></div>
            <div class="form-row">
              <div class="form-check col-md-1">
                <input class="image_checkbox" name="included_payment_methods[]" id="pec" value="pec" type="checkbox" checked="">
                <label for="pec">
                  <span class="paymentmethod-pec" alt="Pagamento na lotérica sem boleto" title="Pagamento na lotérica sem boleto">pec</span>
                </label>
              </div>

              <div class="form-check col-md-2">
                <input class="image_checkbox" name="included_payment_methods[]" id="bolbradesco" value="bolbradesco" type="checkbox" checked="">
                <label for="bolbradesco">
                  <span class="paymentmethod-bolbradesco" alt="Boleto" title="Boleto">Boleto</span>
                </label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Gerar</button>
          </div>
        </form>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2018 Mercado Pago Developers</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a target="_blank" href="http://developers.mercadopago.com/
">Developers Site</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://unpkg.com/imask"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="jquery-3.3.1.slim.min"><\/script>')</script>

    <script src="bootstrap.min.js"></script>
    <script>
      // phone Mask
      var phone  = document.getElementById('phone');
      var phoneMask = new IMask(phone, {
        mask: "(00) - 000000000"
      });

      // amount Mask
      var amount = document.getElementById('amount');
      var amountMask = new IMask(amount, {
        mask: Number,  // enable number mask
        // other options are optional with defaults below
        scale: 2,  // digits after point, 0 for integers
        signed: false,  // disallow negative
        thousandsSeparator: '',  // any single char
        padFractionalZeros: true,  // if true, then pads zeros at end to the length of scale
        normalizeZeros: true,  // appends or removes zeros at ends
        radix: '.',  // fractional delimiter
        mapToRadix: ['.']  // symbols to process as radix
      });

      // zipcode Mask
      var zipcode  = document.getElementById('zipcode');
      var zipcodeMask = new IMask(zipcode, {
        mask: "00000 - 000"
      });
    </script>
  </body>
</html>