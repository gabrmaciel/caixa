<?php
include 'conexao.php';
include 'funcoes.php';

$id = $_GET["id"];

$sql = "SELECT codigo, nome, preco, estoque FROM c_produtos WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nome = $row["nome"];
        $codigo = $row["codigo"];
        $preco = $row["preco"];
        $preco = converte_real(floatval($preco));
        $estoque = $row["estoque"];

        echo $codigo."|".$nome."|".$preco."|".$estoque;
    }
}
$conn->close();
?>