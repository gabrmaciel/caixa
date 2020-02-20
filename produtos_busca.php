<?php
include 'conexao.php';
include 'funcoes.php';

$codigo = $_GET["codigo"];

$sql = "SELECT nome FROM c_produtos WHERE codigo = '$codigo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row["nome"];
    }
}
$conn->close();
?>