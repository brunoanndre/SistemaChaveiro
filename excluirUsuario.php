<?php

    include 'database.php';
    require_once 'dao/UsuarioDaoPgsql.php';

    $usuariodao = New UsuarioDaoPgsql($pdo);


    $id_usuario = filter_input(INPUT_POST, 'id');


    if($usuariodao->deletar($id_usuario)){
        header('Location:index.php?pagina=consultarUsuarios&sucesso');
    }else{
        header('Location:index.php?pagina=exibirUsuario&id=' . $id_usuario . 'erroD');
    }