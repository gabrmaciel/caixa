<?php 
header ('Content-type: text/html; charset=iso-8859-1');

include 'conexao.php';
include 'funcoes.php';

$id = $_GET["id"];

$sql = "SELECT nome FROM c_produtos WHERE id=".$id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nome = $row["nome"];
    }
}

$conn->close();
?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Remover produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        Deseja remover "<?php echo $nome ?>"?
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-danger" onclick="removerProduto(<?php echo $id ?>)">Excluir</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
    </div>
</div>