var result_split = result.split("-");
            $("#preco-valor").html(result_split[0]);
            $("#preco-valor-input").val(result_split[0]);

            var result_split2 = result_split[1].split("][");

            for(i = 0; i < result_split2.length; i++){ //quebra o array e insere dados na listagem
                prox_campo_i = i + 1;
                resultado2 = result_split2[i].split("|");

                if(resultado2[0] !== ""){
                    resultado2[0] = resultado2[0].replace(/[\[\]']+/g,'');
                    resultado2[1] = resultado2[1].replace(/[\[\]']+/g,'');

                    if(resultado2[0] == "NE"){
                        console.log(resultado2[0])
                        abreModal('produtos_nao_existe.php');
                        $("#tabela-input"+prox_campo_i).val("");
                        $("#tabela-input"+prox_campo_i).focus();
                        
                        //ao fechar o modal, é focado no campo incorreto que foi limpado
                        $("#fecharBtn").click(function(){
                            $("#tabela-input"+prox_campo_i).focus();
                        });

                    }else{
                        $("#tabela-listagem-nome" + prox_campo_i).val(resultado2[0]);
                        $("#tabela-listagem-preco" + prox_campo_i).val(resultado2[1]);
                    }
                }

            }