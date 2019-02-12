# Instruções de uso

Configurar as credenciais (CLIENT_ID e CLIENT_SECRET) no arquivo generate.php

```php
const CLIENT_ID = "";
const CLIENT_SECRET = "";
```

Você deve pegar essas credenciais através do link: <https://www.mercadopago.com.br/account/credentials> clicando na aba **CHECKOUT_BASICO**


Depois de configurado, só acessar colocando o projeto em um servidor PHP (Apache / nginx)

![Principal](/images/principal.png)

## Dados para preenchimento

### Dados do pagador

* Nome
* E-mail
* Telefone
* Tipo de documento (CPF / CNPJ)
* Número do documento
* Endereço
* Número
* CEP

### Dados da compra

* Descrição
* Código de referencia (external_reference)

### Configuração do pagamento

* Valor
* Quantidade de parcelas máximas habilitada
* Métodos de pagamentos aceitos (bandeiras e boleto)

Clique no link gerar para processar as preferências e obter o link de pagamento.

![Generate](/images/generate.png)

Também será gerado o link para o ambiente de sandbox, que deve ser utilizado apenas para testes com os cartões de testes: <https://www.mercadopago.com.br/developers/pt/guides/payments/web-checkout/testing/>

![Generate](/images/sandbox.png)