# Fluxo para cancelamento automático de boletos

## Requisitos:
1. Parametrizar quantidade de dias para vencimento de boleto.
2. Parametrizar quantidade de dias para cancelar o boleto, esta quantidade deve ser superior à data de vencimento.
3. Alterar o fluxo de criação de pagamentos para enviar o atributo "date_of_expiration" no corpo do JSON do POST à /v1/payments.
4. JOB para cancelamento de pagamentos, no caso boletos vencidos.

## Detalhamento Técnico

### Parametrizações necessárias

Para a construção desta funcionalidade, é necessário desenvolver uma seção onde o usuário poderá parametrizar a quantidade de dias:

* do vencimento do boleto
* do tempo necessário para que os boletos vencidos sejam cancelados

Essa parametrização pode ser construida a partir da seção administrativa e os seus valores salvos em um banco de dados para poderem ser aplicados posteriormente na criação do pagamento e na execução de um JOB para cancelamento de pagamentos.

### Atributo "date_of_expiration"

O atributo date_of_expiration é responsável por definir a data de vencimento do boleto, este pode ser utilizado de forma customizada para facilitar a criação de pagamentos com uma data customizada de vencimento.
O atributo é do tipo Date(ISO_8601), exemplo -> "date_of_expiration": "2027-06-12T21:52:49.000-04:00"

Observação:
* Por padrão a data de vencimento dos boletos é 3 dias.
* Veja mais em: https://www.mercadopago.com.br/developers/pt/reference

Este atributo deverá ser enviado na criação do pagamento, ou seja, no momento em que é feito o POST à API de payments (/v1/payments), exemplo:
```curl
curl -X POST \
    -H 'accept: application/json' \
    -H 'content-type: application/json' \
    'https://api.mercadopago.com/v1/payments?access_token=ENV_ACCESS_TOKEN' \
    -d '{
      "date_of_expiration": "2018-06-30T21:52:49.000-04:00",
      "transaction_amount": 100,
      "description": "Title of what you are paying for",
      "payment_method_id": "bolbradesco",
      "payer": {
        "email": "test_user_19653727@testuser.com",
        "first_name": "Test",
        "last_name": "User",
        "identification": {
            "type": "CPF",
            "number": "19119119100"
        },
        "address": {
            "zip_code": "06233200",
            "street_name": "Av. das Nações Unidas",
            "street_number": "3003",
            "neighborhood": "Bonfim",
            "city": "Osasco",
            "federal_unit": "SP"
        }
      }
    }'
```

### JOB para cancelamento de pagamentos

Para efetivar o cancelamento de um boleto vencido, será necessário o desenvolvimento de uma rotina automática (JOB) a ser executada em determinado intervalo de tempo pré-definido por seu sistema.

Este job, deverá fazer uma busca em sua base de boletos e selecionar os boletos vencidos, ou seja, aqueles que possuem a quantidade de dias para expiração maior do que a quantidade de dias definidas para o vencimento.

Após obter esta lista de pagamentos, deverá ser feito uma requisição do tipo PUT para a API /v1/payments enviando no corpo da requisição o atributo "status":"cancelled", esta requisição irá atualizar o estado do pagamento para cancelado, na sequência poderá considerar que o pagamento está expirado e cancelado, não permitindo mais realizar a impressão do boleto.

Observação:
* Os pagamentos que forem cancelados, porém tiverem seus boletos pagos próximo à data limite de corte, deverá ser feito a devolução do dinheiro quando compensado, ou qualquer tratativa de forma manual.
