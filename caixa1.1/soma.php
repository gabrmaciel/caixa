<?php
include 'conexao.php';
include 'funcoes.php';

$codigo;
$preco = 0;
$soma_total = 0;
$codigo_barras_ponto = array(",", ".");
$codigo_barras_correto = array("", "");
$nome_total = "";
$nome_preco_produtos = "";


for($i = 1; $i <= $_POST["tabela-qtde-linhas"]; $i++){

    if($_POST["tabela-input$i"] !== ""){ //se vier algum valor diferente de vazio, realizar operaчуo
        $codigo = preg_replace("/[.,]/", "", $_POST["tabela-input$i"]);

        if(!$codigo){
            $preco = "0";
        }
        
        if(strpos($codigo, "x") !== false){
            $preco = preg_replace("/[^0-9,.]/", "", $codigo);
            $nome = "Valor nуo cadastrado";
        }else{
            $sql = "SELECT nome, preco FROM c_produtos WHERE codigo = ".$codigo."";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $preco = $row["preco"];
                    $nome = $row["nome"];
                }
            } else {
                $preco = 0;
                $nome = "NE";
            }
    
        }
    
        $soma = floatval($preco);
        $soma_total += $soma;
    

        $nome_preco = "[".$nome ."|R$ ".converte_real(floatval($preco))."]";
        $nome_preco_produtos = $nome_preco_produtos . $nome_preco;
    }
}

$conn->close();
echo converte_real($soma_total)."-".$nome_preco_produtos; //array com a soma total
?>