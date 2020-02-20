<?php
include 'conexao.php';
include 'funcoes.php';

$preco = 0;
$preco_total = 0;
$codigo_barras_ponto = array(",", ".");
$codigo_barras_correto = array("", "");

$valor_total = $_GET["valor_total"];
$valor_total = str_replace($codigo_barras_ponto, $codigo_barras_correto, $valor_total);
$compra_data = date("h:i d/m/y");
$pagamento_cartao = $_GET["pagamento_cartao"];
echo $pagamento_cartao;

$sql = "INSERT INTO c_compras(c_total, c_data, c_pagamento_cartao) VALUES('$valor_total', '$compra_data', '$pagamento_cartao')";
$conn->query($sql) === TRUE;

$conn->close();
?>