<?php
include 'conexao.php';
include 'funcoes.php';

$preco_venda = removeVirgulas($_GET["venda"]);
$preco_pagamento = removeVirgulas($_GET["pagamento"]);

$soma = floatval($preco_pagamento) - floatval($preco_venda);
echo converte_real($soma);
?>