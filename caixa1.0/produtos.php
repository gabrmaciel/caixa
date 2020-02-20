<?php 
include 'conexao.php';
include 'topo.php';

?>
<div class="row mt-5 pl-3 pr-3">
    <div class="col-12 text-right">
        <button type="button" class="btn btn-primary mb-5 p-2" data-toggle="modal" data-target="#modal">Cadastrar produto</button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="width:15%">Código</th>
                    <th scope="col" style="width:40%">Produtos</th>
                    <th scope="col" style="width:20%">Preço</th>
                    <th scope="col" style="width:20%">Estoque</th>
                    <th scope="col" style="width:10%"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT codigo, nome, preco, estoque FROM c_produtos";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $codigo = $row["codigo"];
                        $nome = $row["nome"];
                        $preco = $row["preco"];
                        $estoque = $row["estoque"];
                    ?>
                        <tr>
                            <th scope="row" style="width:15%" class="pt-3 text-center"><?php echo $codigo?></th>
                            <td style="width:35%" class="pt-3"><?php echo $nome?></td>
                            <td style="width:20%" class="pt-3">R$ <?php echo number_format($preco, 2)?></td>
                            <td style="width:20%" class="pt-3"><?php echo $estoque?> unidades</td>
                            <td style="width:10%"><button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#produtosModal" onclick="abreModal('produtosModal', 'produtos_modal_editar.php')">Editar dados</button></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                        <tr>
                            <th scope="row" style="width:15%" class="pt-3 text-center"></th>
                            <td style="width:35%" class="pt-3">Não há registros cadastrados ainda.</td>
                            <td style="width:20%" class="pt-3"></td>
                            <td style="width:20%" class="pt-3"></td>
                            <td style="width:10%"></td>
                        </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" role="dialog" id="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar novo produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="produto_nome" name="produto_nome" placeholder="Nome do produto" required autofocus>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control number" id="produto_codigo" name="produto_codigo" placeholder="Código de barras" onchange="verificaCodigo('produto_codigo')" required>
                    <div id="produto_group"></div>
                </div>
                <input type="hidden" id="verifica_validacao" value="S">
                <div class="input-group mb-3">
                    <input type="text" class="form-control money" id="produto_preco" name="produto_preco" placeholder="Preço" required>
                </div>
                <div class="input-group mb-3" style="width:193px">
                    <input type="text" class="form-control number" maxlength="11" id="produto_estoque" name="produto_estoque" placeholder="Quantidade em estoque">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="insereProduto()">Salvar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById("produto_codigo").addEventListener('keydown', function(event) {
    if( event.keyCode == 13 || event.keyCode == 17 || event.keyCode == 74 ){
        event.preventDefault();
    }
});
</script>
<?php include 'footer.php'?>