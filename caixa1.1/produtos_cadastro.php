<?php
include 'conexao.php';
include 'funcoes.php';

$produto_nome = $_GET["produto_nome"];
$produto_codigo = $_GET["produto_codigo"];
$produto_preco = $_GET["produto_preco"];
$produto_preco = str_replace(",", "", $produto_preco);
$produto_estoque = $_GET["produto_estoque"];


$sql = "INSERT INTO c_produtos (nome, codigo, preco, estoque) VALUES ('$produto_nome', '$produto_codigo', '$produto_preco', '$produto_estoque')";
$conn->query($sql) === TRUE;


$sql_select = "SELECT id FROM c_produtos ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $produto_id = $row["id"];
    }
}

echo $produto_preco;

$conn->close();
?>