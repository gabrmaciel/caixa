<?php
header ('Content-type: text/html; charset=iso-8859-1');

include 'conexao.php';
include 'funcoes.php';

$produto_id = $_GET["produto_id"];
$produto_nome = $_GET["produto_editar_nome"];
$produto_preco = $_GET["produto_editar_preco"];
$produto_preco = str_replace(",", "", $produto_preco);
$produto_estoque = $_GET["produto_editar_estoque"];

$sql = "UPDATE c_produtos SET nome='".$produto_nome."', preco='".$produto_preco."', estoque='".$produto_estoque."' WHERE id=".$produto_id."";
$conn->query($sql) === TRUE;

$conn->close();
?>