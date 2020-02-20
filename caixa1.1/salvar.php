<?php
include 'conexao.php';
include 'funcoes.php';

$valor_total = removeVirgulas($_GET["valor_total"]);
$compra_data = date("d/m/y H:i");
$pagamento_cartao = $_GET["pagamento_cartao"];
echo $pagamento_cartao;

$sql = "INSERT INTO c_compras(c_total, c_data, c_pagamento_cartao) VALUES('$valor_total', '$compra_data', '$pagamento_cartao')";
$conn->query($sql) === TRUE;

$conn->close();
?>