<?php   
    include 'database.php';
    require_once 'dao/UsuarioDaoPgsql.php';

    $usuariodao = New UsuarioDaoPgsql($pdo);


    $nome = filter_input(INPUT_POST, 'nome');
    $celular = filter_input(INPUT_POST, 'celular');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha');
    $confirma_senha = filter_input(INPUT_POST,'senha_confirma');
    $erro = '';
    $acesso = '2';
    $ativo = true;

    if($nome && $email){
        if($senha === $confirma_senha){
            $options = [
                'cost' => 12,
            ];
            $hash = password_hash($senha, PASSWORD_DEFAULT, $options);
        }else{
            $erro = 'senha';
        }
    }else{
        $erro = 'camposInvalidos';
    }


    if(strlen($erro) > 0){
        header('Location: index.php?pagina=cadastrarUsuario&'. $erro);
    }else{
        $u = New Usuario();
        $u->setNome($nome);
        $u->setTelefone($celular);
        $u->setEmail($email);
        $u->setAcesso($acesso);
        $u->setAtivo($ativo);
        $u->setTelefone($celular);
        $u->setSenha($hash);

        if($usuariodao->addUsuario($u)){
            header('Location: index.php?pagina=cadastrarUsuario&sucesso');
        }else{
            header('Location: index.php?pagina=cadastrarUsuario&erroDB');
        }
    }   