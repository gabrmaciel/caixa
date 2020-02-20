<?php
include 'conexao.php';
include 'funcoes.php';

$preco = 0;
$preco_total = 0;
$codigo_barras_ponto = array(",", ".");
$codigo_barras_correto = array("", "");

$preco_venda = $_GET["venda"];
$preco_pagamento = $_GET["pagamento"];

$preco_venda = str_replace($codigo_barras_ponto, $codigo_barras_correto, $preco_venda);
$preco_pagamento = str_replace($codigo_barras_ponto, $codigo_barras_correto, $preco_pagamento);

$soma = floatval($preco_pagamento) - floatval($preco_venda);
echo converte_real($soma/100);
?>