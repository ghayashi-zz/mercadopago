/**
 * Callback function to set payment_method
 *
 * @param {*} status
 * @param {*} response
 */
function setPaymentMethodInfo(status, response) {
    if (status != 200 && status != 201) {
        alert("CARD Number Invalid");
    } else {
        document.querySelector("input[name=paymentMethodId]").value = response[0].id;

        var bin = getBin();
        var amount = getAmount();

        // Obtendo a quantidade de parcelas e valores para um meio de pagamento
        Mercadopago.getInstallments({
            "bin": bin,
            "amount": amount
        }, setInstallmentInfo);
    }
}

/**
 * Callback function to set the installments info
 *
 * @param {*} status
 * @param {*} response
 */
function setInstallmentInfo(status, response) {
    var selectorInstallments = document.querySelector('#installments');
    var payerCosts = response[0].payer_costs;

    selectorInstallments.innerHTML = null;
    for (var i = 0; i < payerCosts.length; i++) {
        var newOption = document.createElement('OPTION');
        newOption.value = payerCosts[i].installments;
        newOption.textContent = payerCosts[i].recommended_message;
        selectorInstallments.appendChild(newOption);
    }

    selectorInstallments.removeAttribute('disabled');
}

/**
 * Obtendo o meio de pagamento do cartão para poder efetuar o pagamento.
 * bin: corresponde aos 6 primeiros digitos do cartão
 */
function guessingPaymentMethod() {
    var bin = getBin();

    if (bin != null && bin.length == 6) {
        Mercadopago.getPaymentMethod({
            "bin": bin
        }, setPaymentMethodInfo);
    } else {
        var selectorInstallments = document.querySelector('#installments');
        selectorInstallments.innerHTML = null;
        var newOption = document.createElement('OPTION');
        newOption.textContent = 'Insira o bin do cartão';
        selectorInstallments.appendChild(newOption);
        selectorInstallments.setAttribute("disabled", "");
    }
}

/**
 * Wrapper to get the pay button event
 * @param {*} event
 */
function doPay(event) {
    event.preventDefault();
    if (!doSubmit) {
        var $form = document.querySelector('#pay');
        // The function "sdkResponseHandler" is defined below
        Mercadopago.createToken($form, sdkResponseHandler);
    }
}

/**
 * Callback function if card_token is generated
 *
 * @param {*} status
 * @param {*} response
 */
function sdkResponseHandler(status, response) {
    if (status != 200 && status != 201) {
        alert('Card TOKEN Invalid');
    } else {
        var form = document.querySelector('#pay');
        var card = document.createElement('input');
        card.setAttribute('name', 'token');
        card.setAttribute('type', 'hidden');
        card.setAttribute('value', response.id);
        form.appendChild(card);
        doSubmit = true;

        // submitForm(form);
        form.submit();
    }
}

/**
 * Submit FORM using AJAX
 *
 * @param {*} form
 */
function submitForm(form) {
    var url = 'create_payment.php';
    var formData = $(form).serializeArray();


    $.post(url, formData).done(function (data) {
        alert(data);
    });
}

/**
 * Get the number o bin from credit card input
 */
function getBin() {
    var cardNumber = document.querySelector('#cardNumber');
    return cardNumber.value.replace(/[ .-]/g, '').slice(0, 6);
}

/**
 * Get the value from transaction amount
 */
function getAmount() {
    var transactionAmount = document.querySelector('#transactionAmount');
    return transactionAmount.value;
}

// Instanciando o objeto do mercado pago
Mercadopago.setPublishableKey(""); // <- INSIRA AQUI SUA PUBLIC_KEY

doSubmit = false;
document.querySelector('#pay').addEventListener('submit', doPay);

document.querySelector('#cardNumber').addEventListener('keyup', guessingPaymentMethod);
document.querySelector('#cardNumber').addEventListener('change', guessingPaymentMethod);