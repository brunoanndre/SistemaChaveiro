<?php
    include 'database.php';
    require_once 'dao/UsuarioDaoPgsql.php';

    $usuariodao = New UsuarioDaoPgsql($pdo);

    $id_usuario = $_GET['id'];

    $usuario = $usuariodao->buscarPeloId($id_usuario);

    session_start();
?>

<div class="jumbotronContainer">
    <div class="jumbotron areaTabela cadastroUsuarioArea">
        <h3 class="text-center">Usuário</h3>
        <div class="cadastroForm">  
            <?php if(isset($_GET['sucesso'])){ ?>
                <div class="alert alert-success" role="alert">Dados alterados com sucesso.</div>
            <?php } ?>
            <?php if(isset($_GET['erroDB'])){ ?>
                <div class="alert alert-danger" role="alert">Falha ao editar usuário, contate o administrador.</div>
            <?php } ?>
            <?php if(isset($_GET['erroDB'])){ ?>
                <div class="alert alert-danger" role="alert">Falha ao excluír usuário, contate o administrador.</div>
            <?php } ?>
            <?php if(isset($_GET['erroEmail'])){ ?>
                <div class="alert alert-danger" role="alert">Email já cadastrado.</div>
            <?php } ?>
            <label>Nome: </label><span style="color: red;">*</span>
            <input  type="text" class="form-control" name="nome" disabled value="<?php echo $usuario->getNome(); ?>">
            <label>Celular: </label><span style="color: red;">*</span>
            <input id="celular" name="celular" type="text" class="form-control" disabled value=" <?php echo $usuario->getTelefone(); ?>">
            <span id="erroTelefone" class="alertErro hide">Telefone inválido.</span>
            <label>Email:</label><span style="color: red;">*</span>
            <input type="email" class="form-control" name="email" disabled value="<?php echo $usuario->getEmail(); ?>">
            <?php if($_SESSION['nivel_acesso'] == 1){ ?>
                <div class="div-botao-form">
                    <form action="excluirUsuario.php" method="post" onsubmit="return confirm('Você realmente deseja excluir o usuário?');">
                        <input type="hidden" name="id" value="<?php echo $id_usuario; ?>"   >
                        <input type="submit" class="botao-form" style="margin-right: 10px;" value="Excluir">
                    </form>
                    <a href="?pagina=editarUsuario&id=<?php echo $id_usuario ?>"><input class="botao-form" type="submit" value="Editar Usuário"></a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>