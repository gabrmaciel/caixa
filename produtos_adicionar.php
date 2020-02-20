<?php 
header ('Content-type: text/html; charset=iso-8859-1');
?>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Cadastrar novo produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="input-group mb-3">
            <input type="text" class="form-control number" id="produto_codigo" name="produto_codigo" placeholder="Código de barras" onchange="verificaCodigo('produto_codigo')" required autofocus tabindex="1">
            <div id="produto_group"></div>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="produto_nome" name="produto_nome" placeholder="Nome do produto" required tabindex="2">
        </div>
        <input type="hidden" id="verifica_validacao" value="N">
        <div class="input-group mb-3">
            <input type="text" class="form-control money" id="produto_preco" name="produto_preco" placeholder="Preço" required tabindex="3">
            <input type="number" class="form-control number" maxlength="11" id="produto_estoque" name="produto_estoque" min="1" max="400" placeholder="Quantidade em estoque"  tabindex="4">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" onclick="insereProduto(); verificaCodigo('produto_codigo')">Salvar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
    </div>
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
            insereProduto();
            verificaCodigo('produto_codigo');
        }
    });
});

document.getElementById("produto_codigo").addEventListener('keydown', function(event) {
    if( event.keyCode == 13 || event.keyCode == 17 || event.keyCode == 74 ){
        event.preventDefault();
    }
});
</script>