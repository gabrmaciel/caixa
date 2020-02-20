<?php
header("Content-type: text/html; charset=iso-8859-1");
?>
<div class="modal-header">
    <h5 class="modal-title">Cadastrar novo produto</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="produto_nome" name="produto_nome" placeholder="Nome do produto" maxlength="50" required>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control number" id="produto_codigo" maxlenght="20" name="produto_codigo" placeholder="Código de barras" onchange="verificaCodigo('produto_codigo')" required>
        <div id="produto_group"></div>
    </div>
    <input type="hidden" id="verifica_validacao" value="S">
    <div class="input-group mb-3">
        <input type="text" class="form-control money" id="produto_preco" name="produto_preco" placeholder="Preço" maxlength="8" required>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary" onclick="insereProduto()">Salvar</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
</div>