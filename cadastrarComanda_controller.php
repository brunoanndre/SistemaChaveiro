<?php

    require_once 'dao/ComandaDaoPgsql.php';
    require_once 'dao/UsuarioDaoPgsql.php';

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

    $erros = '';

    if($cliente = ''){
        $erros .= 'cliente';
    }
    if($cidade = ''){
        $erros = 'cidade';
    }
    if($bairro = ''){
        $erros = 'bairro';
    }
    if($logradouro = ''){
        $erros = 'logradouro';
    }

    if($funcionario1){
        $id_usuario = $usuariodao->buscarPeloNome($funcionario1);
        if($id_usuario == false){
            $erros = 'usuarioNaoEncontrado';
        }
    }
    
    if($funcionario2){
        $id_usuario = $usuariodao->buscarPeloNome($funcionario2);
        if($id_usuario == false){
            $erros = 'usuarioNaoEncontrado';
        }
    }