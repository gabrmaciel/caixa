<?php
include 'conexao.php';
include 'funcoes.php';

$codigo;
$preco = 0;
$soma_total = 0;
$nome_total = "";
$nome_preco_produtos = "";
$quantidade = 0;


for($i = 1; $i <= $_POST["tabela-qtde-linhas"]; $i++){

    if($_POST["tabela-input$i"] !== ""){ //se vier algum valor diferente de vazio, realizar operação
        $codigo = preg_replace("/[.,]/", "", $_POST["tabela-input$i"]);

        if(!$codigo){ //se vier algo escrito, porém sem dígito identificador
            $preco = "0";
        }
        
        if(strpos($codigo, "x") !== false){ //torna dígito identificador x em preço comum
            $preco = preg_replace("/[^0-9,.]/", "", $codigo);
            $nome = "Valor não cadastrado";
        }else{
            $sql = "SELECT nome, preco FROM c_produtos WHERE codigo = '$codigo'";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $preco = $row["preco"];
                    $nome = $row["nome"];
                    $quantidade = $quantidade + 1;
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

$nome_preco_produtos_array = substr($nome_preco_produtos, 1, -1);
$nome_preco_produtos_array_2 = explode("][", $nome_preco_produtos_array);
$nome_preco_produtos_array_3 = json_encode($nome_preco_produtos_array_2);



echo "var javascript_array = ". $nome_preco_produtos_array_3 . ";\n";
//echo converte_real($soma_total)."-".$nome_preco_produtos; //array com a soma total
?>

