<?php 
include 'conexao.php';
include 'topo.php';

$sql = "SELECT codigo, nome, preco FROM c_produtos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "c�digo: " . $row["codigo"]. " - nome: " . $row["nome"]. " - preco:" . $row["preco"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>
<div class="row mt-5 pl-3 pr-3">
    <div class="col-9">
        <div class="row">
            <div class="codigo col-3 pr-2">
                <div class="tabela-top p-2 text-center font-weight-bold">
                    <span class="">C�digo</span>
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
                        <div class="col-8">
                            <span class="">Produto</span>
                        </div>
                        <div class="col-2 text-center">
                            <span class="">Valor un.</span>
                        </div>
                        <div class="col-2 text-center">
                            <span class="">Valor</span>
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
                                    <div class="col-8"></div>
                                    <div class="col-2 text-center"></div>
                                    <div class="col-2 text-center"></div>
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
            </div>
            <input type="hidden" id="total-venda" value="0,00">
        </div>
        <div class="mt-4">
            <div class="col-12 p-2 pr-3 text-right bg-warning text-light font-weight-bold">
                PAGAMENTO
            </div>
            <div class="tabela-preco col-12 px-3 pt-2 pb-2 text-right font-weight-bold">
                <span class="preco-rs">R$</span>
                <span class="preco-valor">0,00</span>
            </div>
            <label class="col-12 pr-0 mt-2 text-right">
                <input type="checkbox">
                <span>Pagar com cart�o</span>
            </label>
        </div>
        <div class="mt-3">
            <div class="col-12 p-2 pr-3 text-right bg-success text-light font-weight-bold">
                TROCO
            </div>
            <div class="tabela-preco col-12 px-3 pt-2 pb-2 text-right font-weight-bold">
                <span class="preco-rs">R$</span>
                <span class="preco-valor">0,00</span>
            </div>
        </div>
    </div>
</div>
<script>

</script>
<?php include 'footer.php'?>