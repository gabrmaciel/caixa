var verifica_pagar_cartao = "N";

$(document).ready(function(){
    ///Máscaras
    $(".money").mask('#.##0,00', {reverse: true});
    $(".number").mask('0000000000000000', {reverse: true});

    /// UX/UI - ao clicar em campo input text, seleciona o texto todo
    $("input[type=text]").on("click focus", function () {
        $(this).select();
     });

     ///aciona trocoValor()
     $("#preco-pagamento").on('blur keyup', function(event){
         trocoValor(event, 'preco-pagamento');
     });
});

// $(".valor_formatado").change(function() {
//     $(".money").mask('#.##0,00', {reverse: true});
// });


///////////
function enterValor(e, id){
    var campo_anterior = id - 1;
    var campo_posterior = id + 1;
    var qtde_tabela_linhas = $("#tabela-qtde-linhas").val();
    var verifica_ir_prox_campo = "S";
    
    if(e.keyCode == 74){
        var codigo_barra_sem_ponto = $("#tabela-input"+campo_anterior).val();
        codigo_barra_sem_ponto = replaceCodigoBarras(codigo_barra_sem_ponto, '.', '');
        codigo_barra_sem_ponto = replaceCodigoBarras(codigo_barra_sem_ponto, ',', '');
        $("#tabela-input"+campo_anterior).val(codigo_barra_sem_ponto);
    }

    if (e.keyCode == 13 || e.keyCode == 40 || e.keyCode == 38) { //verifica quais teclas podem ativar o evento
        //e.preventDefault();
        if(e.keyCode == 38){ //pega evento de teclar para cima
            //foca no próximo campo anterior
            $("#tabela-input"+campo_anterior).focus();
        }else{
            if(id == qtde_tabela_linhas){
                qtde_tabela_linhas++;
                $("#tabela-qtde-linhas").val(qtde_tabela_linhas);
                $("#tabela-linha").append('<input type=\"text\" class=\"tabela-input p-2 tabela-linha money\" id=\"tabela-input'+ qtde_tabela_linhas +'\" name=\"tabela-input'+ qtde_tabela_linhas +'\" onkeyup=\"enterValor(event, '+ qtde_tabela_linhas +')\">');
                $("#tabela-produtos").append('<div class=\"tabela-linha col-12\" id=\"tabela-produtos-linha'+ qtde_tabela_linhas +'\"><div class=\"row pt-2 pb-2\"><div class=\"col-8\"></div><div class=\"col-2 text-center\"></div><div class=\"col-2 text-center\"></div></div></div>');
            }
            //foca no próximo campo
            $("#tabela-input"+campo_posterior).focus();
        }

        submitValor(e);
        
    }
}

///////////
function submitValor(event){
    var codigos = $("form").serialize();
    
    $.ajax({
        type: 'POST',
        data: codigos,
        url: "soma.php", 
        success: function(result){
            $("#preco-valor").html(result);
            $("#preco-valor-input").val(result);
            trocoValor(event); //realiza a operação de troco ao submitar um valor na tabela
        }
    });
}

///////////
function escapeRegExp(str) {
    return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}

///////////
function replaceCodigoBarras(str, find, replace) {
    return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

///////////
function buscaProduto(id){
    var produto_linha = $("#tabela-input" + id).val(); 
    console.log(produto_linha);

    setTimeout(function(){
        $.ajax({
            type: 'POST',
            data: produto_linha,
            url: "busca_codigo_barra.php", 
            success: function(result){
                console.log(result);
            }
        });
    },500);
}

///////////
function abreModal(id, url_modal){
    $.ajax({
        url: url_modal, 
        success: function(result){
            $("#"+id).append(result);
        }
    });
}

///////////
function fechaModal(id){
    console.log(id);
    $("#" + id).modal("hide"); 
}

///////////
function insereProduto(){
    var produto_nome = $("#produto_nome");
    var produto_codigo = $("#produto_codigo");
    var produto_preco = $("#produto_preco");
    var produto_estoque = $("#produto_estoque");
    $("#produto_group").html("");

    erro = "N";

    if(produto_nome.val() == ""){
        erro = "S";
        produto_nome.addClass("border-danger");
    }else{
        produto_nome.removeClass("border-danger");
    }
    
    if(produto_codigo.val() == ""){
        erro = "S";
        produto_codigo.addClass("border-danger");
    }else{
        var codigos = $("#verifica_validacao").val();
        if(codigos == "N"){
            produto_codigo.removeClass("border-danger");
        }else{
            codigos = codigos.split("|");
            $("#produto_group").html("<span class=\"frase-erro\">O código já está cadastrado como "+ codigos[1] +"</span>");
            produto_codigo.addClass("border-danger");
            erro = "S";
        }
    }
    
    if(produto_preco.val() == ""){
        erro = "S";
        produto_preco.addClass("border-danger");
    }else{
        produto_preco.removeClass("border-danger");
    }

    if(erro == "N"){
        $.ajax({
            url: "produtos_cadastro.php?produto_nome="+produto_nome.val()+"&produto_codigo="+produto_codigo.val()+"&produto_preco="+produto_preco.val()+"&produto_estoque="+produto_estoque.val(), 
            success: function(result){
                $("tbody").append("<tr><th scope=\"row\" style=\"width:15%\" class=\"pt-3 text-center\">"+ produto_codigo.val() +"</th><td style=\"width:35%\" class=\"pt-3\">"+ produto_nome.val() +"</td><td style=\"width:20%\" class=\"pt-3\">R$ "+ produto_preco.val() +"</td><td style=\"width:20%\" class=\"pt-3\">"+ produto_estoque.val() +" unidades</td><td style=\"width:10%\"><button type=\"button\" class=\"btn btn-sm btn-success\" data-toggle=\"modal\" data-target=\"#produtosModal\" onclick=\"abreModal('produtosModal', 'produtos_modal_editar.php')\">Editar dados</button></td></tr>")
                $(produto_codigo).val("");
                $(produto_estoque).val("");
                $(produto_nome).val("");
                $(produto_preco).val("");
                $('#modal').modal('hide');
            }
        });
    }
    
}

///////////
function verificaCodigo(id){
    var codigo = $("#"+id).val();
    var validacao_retorno;

    $.ajax({
        url: "produtos_busca.php?codigo="+codigo+"", 
        success: function(result){
            
            if(result == ""){
                validacao_retorno = "N";
            }else{
                validacao_retorno = "S|"+ result;
            }

            $("#verifica_validacao").val(validacao_retorno);
        }
    });

    //return validacao_retorno;
    
}

///////////
function trocoValor(event, input_funcao){ //div_funcao = diferenciar qual input traz a função, tabela-input ou preco-pagamento
    if(verifica_pagar_cartao == "N"){ //se a pessoa decidir pagar pelo cartão, o troco não é contabilizado
        var venda = $("#preco-valor-input").val();
        var pagamento = $("#preco-pagamento").val();
        var troco;


        if(event.keyCode == 13 || event.keyCode == 83 || event.type == 'blur' || event == 'descheck'){
            
            if(event.keyCode == 83){
                console.log("ok");
                $("#preco-pagamento").val("0,00");
            }
            
            if(event == "descheck" || event.keyCode == 83){ //se o usuário deschecar como cartão -- vide linha 224 ou pela função salvaCompra()
                
                pagamento = 0,00; //zera a variável para levar pro AJAX
                $("#preco-pagamento").val("0,00"); //zera o valor de pagamento no input
            }

            $.ajax({
                url: "soma_troco.php?venda="+venda+"&pagamento="+ pagamento +"", 
                success: function(result){
                    //console.log("event.keyCode:"+ event.keyCode +" venda:"+ venda+ " pagamento:" + pagamento + " troco: " + result);

                    $("#preco-troco").html(result);

                    if(event == "descheck"){ //se o usuário deschecar como cartão -- vide linha 224
                        $("#preco-pagamento").val("0,00");
                    }

                    if(input_funcao == "preco-pagamento"){ //quando o usuário der enter no input-pagamento
                        $("#preco-troco-div").addClass("preco-troco-div-focus");
                        $("#preco-troco-div").addClass("preco-troco-div-focus-transparente");
                        setTimeout(function(){
                            $("#preco-troco-div").removeClass("preco-troco-div-focus");
                            $("#preco-troco-div").removeClass("preco-troco-div-focus-transparente");
                        }, 400);
                    }
                    
                    troco = result.replace(",", "");
                    troco_sem_virgula = troco.replace(".", "");
                    
                    if(parseFloat(troco_sem_virgula) < 0){
                        $("#preco-troco-div").addClass("aviso-div");
                    }else{
                        $("#preco-troco-div").removeClass("aviso-div");
                    }
                }
            });
        }
    }else if(verifica_pagar_cartao == "S"){
        $("#preco-troco").html("0,00");
    }
}

///////////
function pagarCartao(event){
    //console.log(event)
    
    if($('#pagar-cartao').is(':checked')){
        verifica_pagar_cartao = "S";
        $("#preco-pagamento").val("CARTÃO"); //atribui valor do input como string para não fazer mais operações
        $("#preco-troco-div").removeClass("aviso-div");
    }else{
        verifica_pagar_cartao = "N";
        event = "descheck"; //leva o evento para trocoValor ao deschecar como cartão
    }

    trocoValor(event);
}

///////////
function salvarCompra(event){

    var valor_total = $("#preco-valor-input").val();
    $("body").append("<div class='bloco-esconde'></div>");

    $.ajax({
        url: "salvar.php?valor_total="+valor_total+"&pagamento_cartao="+ verifica_pagar_cartao +"", 
        success: function(result){
            $(".bloco-esconde").remove();
            $(".tabela-input").val('');
            $("#tabela-input1").focus();
            verifica_pagar_cartao == "N";
            submitValor(event); //zera os valores da compra anterior
            pagarCartao(event);
        }
    });
}