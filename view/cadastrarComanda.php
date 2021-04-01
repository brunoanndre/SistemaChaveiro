<?php


?>
<div class="container">
    <div class="jumbotron cadastroComandaArea">
        <h3 class="text-center">Cadastro de Comanda</h3>

        <div class="boxCadastrarComanda">
            <form action="cadastrarComanda_controller.php" method="POST">
                <div class="row">
                    <div class="col-sm-11">
                        <label>Cliente:</label>
                        <div style="display:flex">
                            <input id="cliente" name="cliente" autocomplete="off" type="text" class="form-control inline" style="width:93%;" onkeyup="showResult(this.value,this.id)">
                            <button type="button" class="btn-default btn-small inline" data-toggle="modal" data-target="#clientesModal"><span class="glyphicon glyphicon-plus"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Data:</label>
                        <input class="form-control" type="date" name="data_abertura" required autocomplete="off" value="<?php echo date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Tipo do serviço:</label>
                        <select id="servico" name="tipoServico" class="form-control" required onchange="verificaServico(this.id,this.value)">
                            <option value="Automotivo">Automotivo</option>
                            <option value="Residencial">Residencial</option>
                            <option value="Outro">Outro</option>
                        </select>
                        <div id="outroTipoServico" class=" hide">
                            <label>Outro:</label>
                            <input type="text" name="tipoServicoOutro" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <label>Prioridade:</label>
                        <select name="prioridade" class="form-control">
                            <option>Baixa</option>
                            <option>Média</option>
                            <option>Alta</option>
                        </select>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <label>Descrição do serviço:</label>
                        <textarea name="descricao" class="form-control textArea" cols="30"
                        rows="3"></textarea>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Funcionário</label>
                        <div style="display: flex;">
                            <select id="funcionario1" name="funcionario1" class="form-control">
                                <option>Funcionário</option>
                                <option>Fulano</option>
                            </select>
                            <button type="button" onclick="mostraFuncionario2()" class="btn-default btn-small inline" ><span class="glyphicon glyphicon-plus"></span></button>
                        </div>
                    </div>
                    <div class="col-sm-5 hide" id="funcionario2" style="margin-top: 25px;">
                        <select  name="funcionario2" class="form-control">
                            <option>Funcionário</option>
                            <option>Fulano</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-check form-check-inline" style="margin-top: 10px;">
                            <label>Agendamento:</label>
                            <input class="form-check-input" type="radio" name="agendamentoOpcoes" id="teste" onclick="agendamentoPrevisao(this.value)" id="agendamentoTrue" value="true">
                            <label class="form-check-label" for="inlineRadio1">Sim</label>
                            <input class="form-check-input" type="radio" name="agendamentoOpcoes" onclick="agendamentoPrevisao(this.value)" id="agendamentoFalse" value="false">
                            <label class="form-check-label" for="inlineRadio2">Não</label>
                        </div>
                    </div>

                </div>
                <div id="inputPrevisao" class="row col-sm-6 hide">
                        <label>Previsão de chegada:</label>
                        <input type="text" placeholder="dd/mm/aaaa hh:mm" name="previsaoChegada" id="previsaoChegada" onkeydown="chegada()" class="form-control" >
                </div>
                <div id="enderecoDiv">
                     <h3>Endereço</h3>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Cidade</label>
                        <input name="cidade" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-sm-5">
                        <label>Bairro</label>
                        <input name="bairro" type="text" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Logradouro</label>
                        <input type="text" class="form-control" name="logradouro" autocomplete="off">
                    </div>
                    <div class="col-sm-5">
                        <label>Número</label>
                        <input type="text" class="form-control" name="numero" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <label>Referência:</label>
                        <input type="text" name="referencia" class="form-control" autocomplete="off">
                    </div> 
                </div>
                <div class="divBotaoCadastro col-sm-10">
                    <button type="submit" class="btn btn-danger">Cadastrar</button>
                </div>

            </form>
        </div>
    </div>
</div>
