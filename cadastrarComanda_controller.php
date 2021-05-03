<?php

    require_once 'dao/ComandaDaoPgsql.php';
    require_once 'dao/UsuarioDaoPgsql.php';
    require_once 'dao/EnderecoDaoPgsql.php';
    require_once 'dao/ClienteDaoPgsql.php';

    $clientedao = New ClienteDaoPgSql($pdo);
    $enderecodao = New EnderecoDaoPgsql($pdo);
    $comandadao = New ComandaDaoPgSql($pdo);
    $usuariodao = New UsuarioDaoPgsql($pdo);

    $cliente = filter_input(INPUT_POST, 'cliente');
    $data = filter_input(INPUT_POST, 'data_abertura');
    $tipoServiço = filter_input(INPUT_POST,'tipoServico');
    if($tipoServiço == 'Outro'){
        $tipoServiço = filter_input(INPUT_POST,'outroTipoServico');
    }
    $prioridade = filter_input(INPUT_POST,'prioridade');
    $descricao = filter_input(INPUT_POST,'descricao');
    $funcionario1 = filter_input(INPUT_POST, 'funcionario1');
    $funcionario2 = filter_input(INPUT_POST, 'funcionario2');
    $agendamento = filter_input(INPUT_POST, 'agendamentoOpcoes');
    $previsaoChegada = filter_input(INPUT_POST , 'previsaoChegada');
    $cidade = filter_input(INPUT_POST, 'cidade');
    $bairro = filter_input(INPUT_POST, 'bairro');
    $logradouro = filter_input(INPUT_POST, 'logradouro');
    $numero = filter_input(INPUT_POST, 'numero');
    $referencia = filter_input(INPUT_POST, 'referencia');
    $situacao = 'Em aberto';

    $erros = '';

    if($cliente == ''){
        $erros .= 'clienteNaoInformado';
    }else{
        $id_cliente = $clientedao->buscarPeloNome($cliente);

        if($id_cliente == false){
            $erros .= 'clienteNaoEncontrado';
        }
    }
    if($cidade == ''){
        $erros .= 'cidade';
    }
    if($bairro == ''){
        $erros .= 'bairro';
    }
    if($logradouro == ''){
        $erros .= 'logradouro';
    }


    if($funcionario1 !== ''){
        $id_usuario = $usuariodao->buscarPeloNome($funcionario1);

        if($id_usuario == false){
            $erros .= 'usuarioNaoEncontrado';
        }
    }


    if($funcionario2){
        $id_usuario2 = $usuariodao->buscarPeloNome($funcionario2);
        if($id_usuario2 == false){
            $erros .= 'usuarioNaoEncontrado';
        }
    }


    if(strlen($erros) > 0){
        header('Location:index.php?pagina=cadastrarComanda&'.$erros.'');
    }else{
        $id_endereco = $enderecodao->buscarEndereco($logradouro,$numero);
        if($id_endereco == false){
            $e = New Endereco();
            $e->setCidade($cidade);
            $e->setBairro($bairro);
            $e->setLogradouro($logradouro);
            $e->setNumero($numero);
            $e->setReferencia($referencia);

            $id_endereco = $enderecodao->adicionar($e);
            if($id_endereco == false){
                header('Location:index.php?pagina=cadastrarComanda&erro=enderecoBD');
            }
        }
        
        
        $c = New Comanda();
        $c->setIdEndereco($id_endereco);
        $c->setIdCliente($id_cliente);
        $c->setIdUsuario1($id_usuario);
        $c->setIdUsuario2($id_usuario2);
        $c->setIdPagamento($id_pagamento);
        $c->setDataInicial($data);
        $c->setDescricao($descricao);
        $c->setTipo($tipoServiço);
        $c->setPrioridade($prioridade);
        $c->setSituacao($situacao);
        $c->setAgendamento($agendamento);
        $c->setPrevisaoChegada($previsaoChegada);

        $id_comanda = $comandadao->cadastrar($c);
        if($id_comanda != false){
            $clientedao->atualizarHistorico($id_comanda,$id_cliente);

            header('Location:index.php?pagina=exibirComanda&id='.$id_comanda.'&sucesso');
        }else{
            header('Location:index.php?pagina=cadastrarComanda&erroDB');
        }

    }