<?php 
include 'conexao.php';
include 'topo.php';
include 'funcoes.php';
?>
<div class="row mt-5 pl-3 pr-3">
    <div class="col-12 text-right">
        <button type="button" class="btn btn-primary mb-5 p-2" data-toggle="modal" data-target="#modal" onclick="abreModal('produtos_adicionar.php')">Cadastrar produto</button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="width:15%" class="text-center">Código</th>
                    <th scope="col" style="width:35%">Produtos</th>
                    <th scope="col" style="width:15%">Preço</th>
                    <th scope="col" style="width:20%">Estoque</th>
                    <th scope="col" style="width:5%"></th>
                    <th scope="col" style="width:5%"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT id, codigo, nome, preco, estoque FROM c_produtos";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $codigo = $row["codigo"];
                        $nome = $row["nome"];
                        $preco = $row["preco"];
                        $preco = converte_real(floatval($preco));
                        $estoque = $row["estoque"];
                    ?>
                        <tr id="produto<?php echo $id?>">
                            <th scope="row" class="pt-3 text-center"><?php echo $codigo?></th>
                            <td class="pt-3" id="produto-nome<?php echo $id?>"><?php echo $nome?></td>
                            <td class="pt-3" id="produto-preco<?php echo $id?>">R$ <?php echo $preco?></td>
                            <td class="pt-3" id="produto-estoque<?php echo $id?>"><?php echo $estoque?> unidades</td>
                            <td class="text-center"><img src="img/edit.png" alt="Editar <?php echo $nome?>" data-toggle="modal" data-target="#modal" onclick="abreModal('produtos_editar.php', <?php echo $id?>)"></td>
                            <th scope="col" class="text-right"><img src="img/delete.png" alt="Excluir <?php echo $nome?>"  data-toggle="modal" data-target="#modal" onclick="abreModal('produtos_remover.php', <?php echo $id?>)"></th>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                        <tr class="sem-registros">
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
    <div class="modal-dialog" role="document"></div>
</div>
<?php include 'footer.php'?>