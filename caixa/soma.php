<?php
include 'conexao.php';
include 'funcoes.php';

$preco = 0;
$preco_total = 0;
$codigo_barras_ponto = array(",", ".");
$codigo_barras_correto = array("", "");


for($i = 1; $i <= $_POST["tabela-qtde-linhas"]; $i++){
    $preco = str_replace($codigo_barras_ponto, $codigo_barras_correto, $_POST["tabela-input$i"]);

    if(!$preco){
        $preco = "0";
    }
    
    if(strpos($preco, "x") !== false){
        $preco = preg_replace("/[^0-9,.]/", "", $preco);
        $preco = $preco/100;
    }else{
        $sql = "SELECT preco FROM c_produtos WHERE codigo = $preco";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $preco = $row["preco"];
            }
        } else {
            $preco = 0;
        }

    }

    $soma = floatval($preco);
    $preco_total += $soma;
}

$conn->close();
echo converte_real($preco_total);
?>