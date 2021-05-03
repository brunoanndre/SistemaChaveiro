<?php

    require_once 'dao/ComandaDaoPgsql.php';
    require_once 'dao/ClienteDaoPgsql.php';
    require_once 'dao/UsuarioDaoPgsql.php';

    $usuariodao = New UsuarioDaoPgsql($pdo);
    $clientedao = New ClienteDaoPgSql($pdo);
    $comandadao = New ComandaDaoPgSql($pdo); 

    $idComanda = filter_input(INPUT_POST, 'idComanda');
    $cliente = filter_input(INPUT_POST, 'cliente');
    $dataInicial = filter_input(INPUT_POST, 'data_abertura');
    $dataFinal = filter_input(INPUT_POST, 'data_final');
    $tipoServico = filter_input(INPUT_POST, 'tipoServico');
    if($tipoServico == "Outro"){
        $tipoServico = filter_input(INPUT_POST, 'tipoServicoOutro');
    }
    $prioridade = filter_input(INPUT_POST, 'prioridade');
    $descricao = filter_input(INPUT_POST, 'descricao');
    $funcionario1 = filter_input(INPUT_POST, 'funcionario1');
    $funcionario2 = filter_input(INPUT_POST, 'funcionario2');
    $agendamento = filter_input(INPUT_POST, 'agendamentoOpcoes');
    $previsaoChegada = filter_input(INPUT_POST, 'previsaoChegada');
    $idEndereco = filter_input(INPUT_POST, 'idEndereco');
    $cidade = filter_input(INPUT_POST, 'cidade');
    $bairro = filter_input(INPUT_POST, 'bairro');
    $logradouro = filter_input(INPUT_POST, 'logradouro');
    $numero = filter_input(INPUT_POST, 'numero');
    $referencia = filter_input(INPUT_POST, 'referencia');
    $material1 = filter_input(INPUT_POST, 'material1');
    $material2 = filter_input(INPUT_POST, 'material2');
    $material3 = filter_input(INPUT_POST, 'material3');
    $material4 = filter_input(INPUT_POST, 'material4');
    $formaPagamento = filter_input(INPUT_POST, 'formaPagamento');
    $valor = filter_input(INPUT_POST, 'valor');
    $erros = "";
    $situacao = filter_input(INPUT_POST, 'situacao');

    $materiais = array();



    if($cliente == ''){
        $erros .= 'clienteNaoInformado';
    }else{
        $id_cliente = $clientedao->buscarPeloNome($cliente);

        if($id_cliente == false){
            $erros .= 'clienteNaoEncontrado';
        }
    }

    if($funcionario1 !== ""){
        $idFuncionario1 = $usuariodao->buscarPeloNome($funcionario1);
        if($idFuncionario1 == "" || $idFuncionario1 == null){
            $erros .= 'funcionario1';
        }
    }
    if($funcionario2 !== ""){
        $idFuncionario2 = $usuariodao->buscarPeloNome($funcionario2);
        if($idfuncionario2 !== "" || $idfuncionario2 !== null){
            $erros .= 'funcionario2';
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

    if($dataFinal){
        if($dataFinal < $dataInicial){
            $erros .= "dataFinal";
        }
    }

    if($agendamento == true){
        if($previsaoChegada == ""){
            $erros .= "previsaoChegada";
        }
    }

    $possuiMateriais = $comandadao->buscarMateriais($idComanda);

    if(!$possuiMateriais){
        if($material1){
            array_push($materiais,$material1);
        }
        if($material2){
            array_push($materiais,$material2);
        }
        if($material3){
            array_push($materiais,$material3);
        }
        if($material4){
            array_push($materiais,$material4);
        }
        $materiaisString = '{' . implode(",", $materiais) . '}';
    }else{
        $materiais = explode(",",$possuiMateriais);
        if($material1){
            array_push($materiais,$material1);
        }
        if($material2){
            array_push($materiais,$material2);
        }
        if($material3){
            array_push($materiais,$material3);
        }
        if($material4){
            array_push($materiais,$material4);
        }
        $barras = array("{","}");
        $materiais = str_replace($barras, "",$materiais);
        $materiaisString = '{' . implode(",", $materiais) . '}';
    }

    if($situacao == 'Encerrado'){
        $historico = $clientedao->buscarHistorico($id_cliente);
        if($historico){
            $historico = explode(",",$historico);
            array_push($historico, $idComanda);
            $barras = array("{","}");
            $historico = str_replace($barras,"",$historico);
            $historicoString = '{' . implode(",",$historico) . '}';

        }else{
            $historicoString = '{'.$idComanda. '}';
        }
        $clientedao->atualizarHistorico($historicoString,$id_cliente);
    }


    if(strlen($erros) > 0 ){
        header('Location:index.php?pagina=exibirComanda&id='.$idComanda.'&erros='.$erros);
    }else{
        $c = New Comanda();
        $c->setIdCliente($id_cliente);
        $c->setDataInicial($dataInicial);
        $c->setDataFinal($dataFinal);
        $c->setTipo($tipoServico);
        $c->setPrioridade($prioridade);
        $c->setDescricao($descricao);
        $c->setIdUsuario1($funcionario1);
        $c->setIdUsuario2($funcionario2);
        $c->setAgendamento($agendamento);
        $c->setPrevisaoChegada($previsaoChegada);
        $c->setIdEndereco($idEndereco);
        $c->setMateriais($materiaisString);
        $c->setSituacao($situacao);

        if($comandadao->editar($c)){
            header('Location:index.php?pagina=exibirComanda&id='. $idComanda . '&sucessoEdit');
        }else{
            header('Location:index.php?pagina=exibirComanda&id='. $idComanda . '&erroDB');
        }

    }