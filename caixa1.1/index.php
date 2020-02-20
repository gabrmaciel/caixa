<?php 
include 'conexao.php';
include 'topo.php';

$sql = "SELECT codigo, nome, preco FROM c_produtos";
$result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         echo "código: " . $row["codigo"]. " - nome: " . $row["nome"]. " - preco:" . $row["preco"]. "<br>";
//     }
// } else {
//     echo "0 results";
// }
// $conn->close();

?>
<div class="row mt-5 pl-3 pr-3">
    <div class="col-9">
        <div class="row">
            <div class="codigo col-3 pr-2">
                <div class="tabela-top p-2 text-center font-weight-bold">
                    <span class="">Código</span>
                </div>
                <form>
                    <div class="table-corpo" id="tabela-linha">
                        
                        <?php
                        for($i = 1; $i <= 8; $i++){
                            ?>
                            <div class="tabela-linha-div" id="tabela-linha-div<?php echo $i?>">
                                <input type="text" class="tabela-input p-2 tabela-linha" <?php if($i == 1){ echo "autofocus";}?> id="tabela-input<?php echo $i ?>" name="tabela-input<?php echo $i ?>" onkeyup="enterValor(event, <?php echo $i ?>)">
                            </div>
                            <?php
                        }
                        ?>
                        
                    </div>
                    <input type="hidden" value="<?php echo $i - 1?>" id="tabela-qtde-linhas" name="tabela-qtde-linhas">
                </form>
                
            </div>
            <div class="produtos col-9 pl-2">
                <div class="tabela-top pt-2 pb-2 font-weight-bold">
                    <div class="row m-0">
                        <div class="col-10">
                            <span class="">Produto</span>
                        </div>
                        <div class="col-2 text-center">
                            <span class="">Valor un.</span>
                        </div>
                    </div>
                </div>
                <div class="table-corpo">
                    <div class="row m-0" id="tabela-produtos">
                        <?php
                        for($i = 1; $i <= 8; $i++){
                            ?>
                            <div class="tabela-linha col-12" id="tabela-produtos-linha<?php echo $i ?>">
                                <div class="row pt-2 pb-2">
                                    <div class="col-10">
                                        <input type="text" class="input-transparente tabela-listagem-nome" id="tabela-listagem-nome<?php echo $i ?>" disabled>
                                    </div>
                                    <div class="col-2 text-center">
                                        <input type="text" class="input-transparente text-center tabela-listagem-preco" id="tabela-listagem-preco<?php echo $i ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <span id="result"></span>
    </div>
    
    <div class="col-3">
        <div>
            <div class="col-12 p-2 pr-3 text-right bg-primary text-light font-weight-bold">
                TOTAL DA VENDA
            </div>
            <div class="tabela-preco col-12 px-3 pt-2 pb-2 text-right font-weight-bold">
                <span class="preco-rs">R$</span>
                <span class="preco-valor" id="preco-valor">0,00</span>
                <input type="hidden" id="preco-valor-input">
            </div>
            <input type="hidden" id="total-venda" value="0,00">
        </div>
        <div class="mt-4">
            <div class="col-12 p-2 pr-3 text-right bg-warning text-light font-weight-bold">
                PAGAMENTO
            </div>
            <div class="tabela-preco col-12 font-weight-bold">
                <input type="text" class="preco-valor preco-valor-input text-right px-3 pt-2 pb-2 money" id="preco-pagamento" value="0,00">
            </div>
            <label class="col-12 pr-0 mt-2 text-right" onchange="pagarCartao(event)">
                <input type="checkbox" id="pagar-cartao">
                <span>Pagar com cartão</span>
            </label>
        </div>
        <div class="mt-3">
            <div class="col-12 p-2 pr-3 text-right bg-info text-light font-weight-bold">
                TROCO
            </div>
            <div class="tabela-preco col-12 px-3 pt-2 pb-2 text-right font-weight-bold" id="preco-troco-div">
                <span class="preco-rs">R$</span>
                <span class="preco-valor" id="preco-troco">0,00</span>
            </div>
        </div>
        <!-- <div class="mt-5">
            <input type="button" class="btn btn-lg btn-success pt-3 pb-3 col-12 font-weight-bold salvar-compra" id="salvar-compra" value="SALVAR" onclick="salvarCompra()">
        </div> -->
    </div>
</div>
<div class="modal fade" role="dialog" id="modalProduto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Oops... Este produto não existe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tente cadastrar outro produto.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="fecharBtn">Fechar</button>
            </div>
        </div>
    </div>
<script>
document.addEventListener('keydown', function(event) {
    if( event.keyCode == 13 || event.keyCode == 17 || event.keyCode == 74 ){ //escape para código de barras não sair da página
        event.preventDefault();
    }

    if (!(event.which == 83 && event.ctrlKey) && !(event.which == 19)){
        return true; //escape para CTRL + S e salvar compra
    }else{
        salvarCompra(event);
        event.preventDefault();
        return false;
    }

});

$(document).on("keyup keydown", function(e){ //pega CTRL + P do teclado
    if(e.ctrlKey && e.keyCode == 80){
        $("#preco-pagamento").focus();
        return false;
    }
});
</script>
<?php include 'footer.php'?>