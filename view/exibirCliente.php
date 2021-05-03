<?php
    require_once 'dao/ClienteDaoPgsql.php';
    require_once 'dao/EnderecoDaoPgsql.php';

    $enderecodao = New EnderecoDaoPgsql($pdo);
    $clientedao = New ClienteDaoPgSql($pdo);
    $id_cliente = $_GET['id'];

    $linhaCliente = $clientedao->buscarPeloId($id_cliente);
    if($linhaCliente->getIdTipo() == 2){
        $id_endereco = $linhaCliente->getIdEndereco();
        $linhaEndereco = $enderecodao->buscarPeloId($id_endereco);
    }
?>


<div class="container">
    <div class="jumbotron cadastroClienteArea">
        <h3 class="text-center">Cadastro de Cliente</h3>

        <div class="boxCadastrarCliente">
        <?php if(isset($_GET['sucesso'])) { ?>
        <div class="alert alert-success" role="alert">
            Cliente cadastrado com sucesso.
        </div>
    <?php } ?>
    <?php if(isset($_GET['sucessoEdit'])) { ?>
        <div class="alert alert-success" role="alert">
            Dados alterados com sucesso.
        </div>
    <?php } ?>
    <?php if(isset($_GET['erroBD'])) { ?>
        <div class="alert alert-success" role="alert">
            Erro ao cadastrar o cliente, contate o administrador.
        </div>
    <?php } ?>
                <div class="row">
                    <div class="col-sm-12">
                        <label>Nome:
                        <?php if(isset($_GET['erroNome'])){ ?><span class="alert-danger">O nome do cliente deve ser informado!</span><?php } ?>
                        </label>
                        <input type="text" name="nome" class="form-control" autocomplete="off" readonly value="<?php echo $linhaCliente->getNome(); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <label>Tipo de Cliente:</label>
                    <input name="tipo" class="form-control" readonly value="<?php if($linhaCliente->getIdTipo() == 1){ echo 'Pessoa Física';} if($linhaCliente->getIdTipo() == 2){ echo 'Condomínio';} if($linhaCliente->getIdTipo() == 3){echo 'Empresa';} ?>">
                    </div>
                </div>
                <div class="row">
                    <?php if($linhaCliente->getIdTipo() == 1){ ?>
                        <div id="cpf" class="col-sm-12">
                            <label>CPF:</label>
                            <input id="cpfInput" type="text" name="cpf" class="form-control" readonly value="<?php echo $linhaCliente->getCPF(); ?>">  
                        </div>
                    <?php }else{?>
                    <div id="cnpj" class="col-sm-12">
                        <label>CNPJ:</label>
                        <input id="cnpjInput" type="text" name="cnpj" class="form-control" readonly autocomplete="off" value="<?php echo $linhaCliente->getCNPJ() ?>">
                    </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Telefone:</label>
                        <input id="telefone" type="text" name="telefone" class="form-control" readonly value="<?php echo $linhaCliente->getTelefone(); ?>">
                    </div>
                    <div class="col-sm-6">
                        <label>E-mail:</label>
                        <input type="email" name="email" class="form-control" readonly value="<?php echo $linhaCliente->getEmail(); ?>">
                    </div>
                </div>
                <?php if($linhaCliente->getIdTipo() == 2){ ?>
                    <div id="endereco">
                        <h3>Endereço</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Cidade:</label>
                                <input type="text" name="cidade" class="form-control" readonly value="<?php echo $linhaEndereco->getCidade(); ?>">
                            </div>
                            <div class="col-sm-6">
                                <label>Bairro</label>
                                <input type="text" name="bairro" class="form-control" readonly value="<?php echo $linhaEndereco->getBairro(); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Logradouro</label>
                                <input type="text" class="form-control" name="logradouro" readonly value="<?php echo $linhaEndereco->getLogradouro(); ?>" >
                            </div>
                            <div class="col-sm-6">
                                <label>Número</label>
                                <input type="text" class="form-control" name="numero" autocomplete="off" readonly value="<?php echo $linhaEndereco->getNumero(); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Referência:</label>
                                <input type="text" name="referencia" class="form-control" autocomplete="off" readonly value="<?php echo $linhaEndereco->getReferencia(); ?>">
                            </div> 
                        </div>
                    </div>

                <?php } ?>
                <div class="row">
                    <div class="historicoArea col-sm-12">
                        <label>Histórico de serviços:</label>
                        <textarea readonly class="historicoComandas form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 botaoVoltar">
                        <a href="index.php?pagina=consultarClientes" class="btn btn-danger">Voltar</a>
                    </div>
                    <div class="botaoCadastrar col-sm-4">
                     <?php echo  '<a href="index.php?pagina=editarCliente&id=' . $_GET['id'] . '"><button type="submit" class="btn btn-success">Editar</button></a>' ?>
                    </div>
                </div>
        </div>  
    </div>
</div>