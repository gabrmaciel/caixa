<?php
header ('Content-type: text/html; charset=iso-8859-1');

include 'conexao.php';
include 'funcoes.php';

$produto_id = $_GET["produto_id"];

$sql = "DELETE FROM c_produtos WHERE id=".$produto_id."";
$conn->query($sql) === TRUE;

$conn->close();
?>