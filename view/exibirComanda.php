<?php

    require_once 'dao/ComandaDaoPgsql.php';
    require_once 'dao/ClienteDaoPgsql.php';
    require_once 'dao/UsuarioDaoPgsql.php';
    require_once 'dao/EnderecoDaoPgsql.php';

    $enderecodao = New EnderecoDaoPgsql($pdo);
    $usuariodao = New UsuarioDaoPgsql($pdo);
    $clientedao = New ClienteDaoPgSql($pdo);
    $comandadao = New ComandaDaoPgSql($pdo);
    $idComanda = filter_input(INPUT_GET, 'id');

    $linhaComanda = $comandadao->buscarPeloId($idComanda);
    $linhaCliente = $clientedao->buscarPeloId($linhaComanda->getIdCliente());
    $linhaEndereco = $enderecodao->buscarPeloId($linhaComanda->getIdEndereco());

    $listaFuncionarios = $usuariodao->buscarConsulta();

    if($linhaComanda->getIdUsuario1()){
        $linhaUsuario1 = $usuariodao->buscarPeloId($linhaComanda->getIdUsuario1());
    }
    if($linhaComanda->getIdUsuario2()){
        $linhaUsuario2 = $usuariodao->buscarPeloId($linhaComanda->getIdUsuario2());
    }

    if($linhaComanda->getMateriais()){
        $barras = array("{","}");
        $materiais = str_replace($barras,"",$linhaComanda->getMateriais());
        $materiais = explode(",", $materiais);
    }

?>



<div class="container">
    <div class="jumbotron cadastroComandaArea">
        <h3 class="text-center">Comanda</h3>
        <div class="boxCadastrarComanda">
        <?php if(isset($_GET['sucesso'])) { ?>
            <div class="alert alert-success" role="alert" style="text-align: center;">
                Comanda cadastrada com sucesso.
            </div>
        <?php } ?>
        <?php if(isset($_GET['sucessoEdit'])) { ?>
            <div class="alert alert-success" role="alert" style="text-align: center;">
                Comanda alterada com sucesso.
            </div>
        <?php } ?>
        <?php if(isset($_GET['erroDB'])) { ?>
            <div class="alert alert-danger" role="alert" style="text-align: center;">
                Falha no banco de dados, contate o administrador.
            </div>
        <?php } ?>
            <form action="editarComanda.php" method="POST">
                <div class="row">
                    <div class="col-sm-10">
                        <label >Cliente: <span style="color: red;">*</span></label><br>
                            <span id="alertComandaSucesso" class="alert-sucess" style="color: greenyellow;"></span>
                            <div class="row">
                                <input id="cliente" name="cliente" autocomplete="off" type="text" class="form-control inline" style="width:90%; margin-left:15px;" onkeyup="mostrarClientes(this.id, this.value)" value="<?php echo $linhaCliente->getNome(); ?>">
                                <button type="button" class="btn-default btn-small inline" data-toggle="modal" data-target="#modalCliente"><span class="glyphicon glyphicon-plus"></span></button>
                            </div>
                            <div  class="autocomplete row" id="buscar_cliente"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Data de abertura: <span style="color: red;">*</span></label>
                        <input class="form-control" type="date" name="data_abertura" required autocomplete="off" value="<?php echo $linhaComanda->getDataInicial(); ?>">
                    </div>
                    <div class="col-sm-5">
                        <label>Data de Término:</label>
                        <input class="form-control" type="date" name="data_final" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Tipo do serviço:</label>
                        <select id="servico" name="tipoServico" class="form-control" required onchange="verificaServico(this.id,this.value)">
                            <option <?php if($linhaComanda->getTipo() == "Automotivo"){echo 'selected';} ?>  value="Automotivo">Automotivo</option>
                            <option <?php if($linhaComanda->getTipo() == "Residencial"){echo 'selected';} ?>  value="Residencial">Residencial</option>
                            <option <?php if($linhaComanda->getTipo() == "Outro"){echo 'selected';} ?>  value="Outro">Outro</option>
                        </select>
                        <div id="outroTipoServico" class=" hide">
                            <label>Outro:</label>
                            <input type="text" name="tipoServicoOutro" class="form-control" value="<?php echo $linhaComanda->getTipo(); ?>">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <label>Prioridade:</label>
                        <select name="prioridade" class="form-control">
                            <option <?php if($linhaComanda->getPrioridade() == "Baixa"){echo 'selected';} ?>>Baixa</option>
                            <option <?php if($linhaComanda->getPrioridade() == "Média"){echo 'selected';} ?>>Média</option>
                            <option <?php if($linhaComanda->getPrioridade() == "Alta"){echo 'selected';} ?>>Alta</option>
                        </select>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <label>Descrição do serviço:</label>
                        <textarea name="descricao" class="form-control textArea" cols="30"
                        rows="3"><?php echo $linhaComanda->getDescricao() ?></textarea>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Funcionário</label><br>
                        <?php if(isset($_GET['usuarioNaoEncontrado'])) { ?>
                            <span class="alert-danger" style="color: red;">Usuário não encontrado</span>
                                
                        <?php } ?>
                        <div style="display: flex;">
                            <select id="funcionario1" name="funcionario1" class="form-control">

                            <?php if($listaFuncionarios == false){
                                echo '<option> Nenhum funcionário cadastrado.</option>';
                            }else{
                                if($linhaComanda->getIdUsuario1()){
                                    echo '<option></option>';
                                    echo '<option selected>'. $linhaUsuario1->getNome()   .'</option>';
                                }else{
                                    echo '<option selected></option>';
                                }

                                foreach($listaFuncionarios as $funcionario){
                                    echo '<option>'.$funcionario->getNome().'</option>';
                                }
                            } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5 <?php if($linhaComanda->getIdUsuario2() == false){echo 'hide';} ?> " id="funcionario2" style="margin-top: 25px;">
                        <select  name="funcionario2" class="form-control">
                        <?php if($listaFuncionarios == false){
                                echo '<option> Nenhum funcionário cadastrado.</option>';
                            }else{
                                if($linhaComanda->getIdUsuario2()){
                                    echo '<option></option>';
                                    echo '<option selected>' . $linhaUsuario2->getNome()  . '</option>';
                                }else{
                                    echo '<option selected></option>'; 
                                }

                                foreach($listaFuncionarios as $funcionario){
                                    echo '<option>'.$funcionario->getNome().'</option>';
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-check form-check-inline" style="margin-top: 10px;">
                            <label>Agendamento:</label>
                            <input class="form-check-input" type="radio" name="agendamentoOpcoes" onclick="agendamentoPrevisao(this.value)" id="agendamentoTrue" value="true" <?php if($linhaComanda->getAgendamento() == true){echo 'checked';} ?>>
                            <label class="form-check-label" for="inlineRadio1">Sim</label>
                            <input class="form-check-input" type="radio" name="agendamentoOpcoes" onclick="agendamentoPrevisao(this.value)" id="agendamentoFalse" value="false" <?php if($linhaComanda->getAgendamento() == false){echo 'checked';} ?>>
                            <label class="form-check-label" for="inlineRadio2">Não</label>
                        </div>
                    </div>

                </div>
                <div id="inputPrevisao" class="row col-sm-6 <?php if($linhaComanda->getAgendamento() == false){echo 'hide';}  ?>">
                        <label>Previsão de chegada:</label>
                        <input type="text" placeholder="dd/mm/aaaa hh:mm" name="previsaoChegada" id="previsaoChegada" onkeydown="chegada()" class="form-control" value="<?php echo $linhaComanda->getPrevisaoChegada() ?>">
                </div>
                <div id="enderecoDiv" <?php if($linhaComanda->getAgendamento() == true) echo 'style="margin-top:70px"'; ?> >
                     <h3>Endereço</h3>
                     <input type="hidden" name="idEndereco" value="<?php echo $linhaComanda->getIdEndereco(); ?>">
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Cidade</label>
                        <input name="cidade" type="text" class="form-control" autocomplete="off" value="<?php echo $linhaEndereco->getCidade() ?>">
                    </div>
                    <div class="col-sm-5">
                        <label>Bairro</label>
                        <input name="bairro" type="text" class="form-control" autocomplete="off" value="<?php echo $linhaEndereco->getBairro() ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Logradouro</label>
                        <input type="text" class="form-control" name="logradouro" autocomplete="off" value="<?php echo $linhaEndereco->getLogradouro() ?>">
                    </div>
                    <div class="col-sm-5">
                        <label>Número</label>
                        <input type="text" class="form-control" name="numero" autocomplete="off" value="<?php echo $linhaEndereco->getNumero() ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <label>Referência:</label>
                        <input type="text" name="referencia" class="form-control" autocomplete="off" value="<?php echo $linhaEndereco->getReferencia() ?>">
                    </div> 
                </div>
                <h3>Pagamento</h3>
                <div class="row">
                <div class="col-sm-6">
                    <label>Materiais Utilizados: </label>
                    <div>
                        <?php if(sizeof($materiais)>0){
                            echo '<ul>';
                            for($i = 0; $i < sizeof($materiais); $i++){
                                echo '<li><label>' . $materiais[$i] . '</label></li>';
                            }
                            echo '</ul>';
                        } ?>
                    </div>
                </div>
                    <div class="col-sm-6">
                        <label>Adicionar materiais:<button type="button" class="btn-default btn-small inline" data-toggle="modal" data-target="#modalMateriais"><span class="glyphicon glyphicon-plus"></span></button></label>
                        <input id="material1" type="hidden" name="material1">
                    <input id="material2" type="hidden" name="material2">
                    <input id="material3" type="hidden" name="material3">
                    <input id="material4" type="hidden" name="material4">
                        <ul id="listaMateriais">

                        </ul>
                    </div>   

                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <label>Valor do serviço (R$):</label>
                        <input class="form-control" name="valor" onkeyup="mascaraReal(this)">
                    </div>
                    <div class="col-sm-5">
                        <label>Forma de pagamento</label>
                        <select name="formaPagamento" class="form-control">
                            <option></option>
                            <option>Dinheiro</option>
                            <option>Débito</option>
                            <option>Crédito</option>
                            <option>Cobrança</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                            <label>Status:</label><br>
                            <select class="form-control" name="situacao">
                                <option <?php if($linhaComanda->getSituacao() == "Em aberto"){ echo 'selected';} ?>>Em aberto</option>
                                <option <?php if($linhaComanda->getSituacao() == "Encerrado"){ echo 'selected';} ?>>Encerrado</option>
                            </select>
                    </div>
                </div>
                <div class="divBotaoCadastro col-sm-10">
                    <input type="hidden" name="idComanda" value="<?php echo $idComanda; ?>">
                    <button type="submit" class="btn btn-danger">Salvar</button>
                </div>
            </form>
        </div>
        <div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="clienteAjax" method="POST">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input class="hidden" id="idCliente" value="">
                                    <label>Nome: <span style="color: red;">*</span>
                                    <?php if(isset($_GET['erroNome'])){ ?><span class="alert-danger">O nome do cliente deve ser informado!</span><?php } ?>
                                    </label>
                                    <input id="nomeCliente" type="text" name="nome" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Tipo de Cliente:<span style="color: red;">*</span></label>
                                    <select id="tipoCliente" name="tipo" class="form-control" onchange="mostrarEndereco(), verificaTipo(this.value)">
                                        <option selected>Pessoa Física</option>
                                        <option>Condomínio</option>
                                        <option>Empresa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div id="cpf" class="col-sm-12">
                                    <label>CPF:</label>
                                    <input id="cpfCliente" type="text" name="cpf" class="form-control" onchange="verificaCpf(this.value)" autocomplete="off">
                                    <span id="erroCpf" class="alertErro hide">CPF inválido.</span>
                                </div>
                                <div id="cnpj" class="col-sm-12 hidden">
                                    <label>CNPJ:</label>
                                    <input id="cnpjCliente" type="text" name="cnpj" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Telefone:</label>
                                    <input id="telefoneCliente" type="text" name="telefone" class="form-control" autocomplete="off">
                                </div>
                                <div class="col-sm-6">
                                    <label>E-mail:</label>
                                    <input type="email" id="emailCliente" name="email" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div id="endereco" class="hidden">
                                <h3>Endereço</h3>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Cidade:</label>
                                        <input type="text" id="cidade" name="cidade" class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Bairro</label>
                                        <input type="text" id="bairro" name="bairro" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Logradouro</label>
                                        <input type="text" id="logradouro" class="form-control" name="logradouro" >
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Número</label>
                                        <input type="text" id="numero" class="form-control" name="numero" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Referência:</label>
                                        <input type="text" id="referencia" name="referencia" class="form-control" autocomplete="off">
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="botaoCadastrar col-sm-12">
                                    <button type="button" class="btn btn-success" onclick="cadastrarClienteModal()">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalMateriais" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inserir materiais</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Material:<span style="color: red;">*</span></label>
                                    <input class="form-control" name="material" id="inputMaterial">
                                </div>
                            </div>
                            <div class="row">
                                <div class="botaoCadastrar col-sm-12">
                                    <button type="button" class="btn btn-success" onclick="inserirMaterial()">Inserir</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#cpfCliente").mask("000.000.000-00")
    $("#cnpjCliente").mask("00.000.000/0000-00")
    $("#telefoneCliente").mask("(00) 00000-0000")
})

function mascaraReal(i){
	var v = i.value.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	i.value = v;
}
</script>