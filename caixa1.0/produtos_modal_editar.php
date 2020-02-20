<?php
header("Content-type: text/html; charset=iso-8859-1");
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Editar produto - Teste</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="produto_nome" name="produto_nome" placeholder="Nome do produto" required>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="produto_codigo" name="produto_codigo" placeholder="Código de barras" onchange="verificaCodigo('produto_codigo')" required>
            </div>
            <input type="hidden" id="verifica_validacao">
            <div class="input-group mb-3">
                <input type="text" class="form-control money" id="produto_preco" name="produto_preco" placeholder="Preço" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" onclick="insereProduto()">Salvar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $(".money").mask('#.##0,00', {reverse: true});
});
</script>