<?php
include 'conexao.php';
$produto = $_POST['produto_linha'];
echo $produto;

$sql = "SELECT produtos FROM c_produtos WHERE produto LIKE '%$produto%'";
$result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $produto = $produto["produto"];
        }
    } else {
        $preco = 0; //verificar quando n?o tem c?digo de barra !!!
    }

$conn->close();
?>