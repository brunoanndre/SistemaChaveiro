<?php
    include 'database.php';
    require_once 'dao/UsuarioDaoPgsql.php';

    $usuariodao = New UsuarioDaoPgsql($pdo);
    
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha');


    if($email && $senha){
        $u = New Usuario();
        $u->setEmail($email);
        $u->setSenha($senha);
        $usuario = $usuariodao->buscarLogin($u);
        if($usuario !== false){
            $hash = $usuario->getSenha();
            $id_usuario = $usuario->getID();
            
            if(password_verify($senha, $hash)){
                session_start();
                $_SESSION['id_usuario'] = $id_usuario;
                $_SESSION['nivel_acesso'] = $usuario->getAcesso();
                $_SESSION['login'] = true;

                header('Location:index.php');
            }else{
                header('Location:login.php?erroLogin');
            }
        }
    }