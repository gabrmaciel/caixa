<?php 
header ('Content-type: text/html; charset=iso-8859-1');

include 'conexao.php';
include 'funcoes.php';

$id = $_GET["id"];

$sql = "SELECT codigo, nome, preco, estoque FROM c_produtos WHERE id=".$id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nome = $row["nome"];
        $codigo = $row["codigo"];
        $preco = $row["preco"];
        $preco = converte_real(floatval($preco));
        $estoque = $row["estoque"];
    }
}

$conn->close();
?>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Editar produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form onsubmit="editarProduto(<?php echo $id ?>)">
        <div class="modal-body">
            <input type="hidden" value="<?php echo $id ?>" id="produto_id" name="produto_id">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Código</span>
                </div>
                <input type="text" class="form-control number" id="produto_editar_codigo" name="produto_editar_codigo" value="<?php echo $codigo?>" placeholder="Código de barras" onchange="verificaCodigo('produto_codigo')" maxlength="20" disabled>
                <div id="produto_group"></div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Nome</span>
                </div>
                <input type="text" class="form-control" id="produto_editar_nome" name="produto_editar_nome" value="<?php echo $nome?>" placeholder="Nome do produto" maxlength="50" required tabindex="1">
            </div>
            <input type="hidden" id="verifica_validacao" value="S">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Preço</span>
                </div>
                <input type="text" class="form-control money" id="produto_editar_preco" name="produto_editar_preco" value="<?php echo $preco?>" placeholder="Preço" maxlength="8" required  tabindex="2">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Estoque</span>
                </div>
                <input type="number" class="form-control number" maxlength="11" id="produto_editar_estoque" name="produto_editar_estoque" min="1" max="400" value="<?php echo $estoque?>" placeholder="Quantidade em estoque" required tabindex="3">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" onclick="editarProduto(<?php echo $id ?>)">Salvar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
    </form>
</div>
<script src="js/jquery.mask.min.js"></script>
<script>
$(document).ready(function(){
    ///Máscaras
    $(".money").mask('#.##0,00', {reverse: true});
    $(".number").mask('0000000000000000', {reverse: true});

     //submit form
     $("input").keydown(function(event) {
        if (event.which == 13) {
            console.log("hey")
            $("form").submit(function(e){
                return false;
            });
        }
    });
});
</script>