<?php

    include 'database.php';
    require_once 'dao/UsuarioDaoPgsql.php';

    $usuariodao = New UsuarioDaoPgsql($pdo);


    $nome = filter_input(INPUT_POST,'nome');
    $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
    $celular = filter_input(INPUT_POST,'celular');
    $id_usuario = filter_input(INPUT_POST,'id_usuario');
    $erros = '';

    if($email && $nome){
        $id_existente = $usuariodao->buscarEmail($email);
        if($id_existente != false){
            if($id_existente != $id_usuario){
                $erros .= 'emailExistente';
            }else{
                $erros .= '';
            }
        }
    }else{
        $erros .= 'dadosInvalidos';
    }

    if(strlen($erros) >0){
        header('Location:index.php?pagina=editarUsuario&id=' . $id_usuario . '&erros=' . $erros);
    }else{
        $u = New Usuario();
        $u->setID($id_usuario);
        $u->setNome($nome);
        $u->setTelefone($celular);
        $u->setEmail($email);

        if($usuariodao->editar($u)){
            header('Location:index.php?pagina=exibirUsuario&id=' . $id_usuario . '&sucesso');
        }else{
            header('Location:index.php?pagina=editarUsuario&id=' . $id_usuario . '&erroDB');
        }
    }