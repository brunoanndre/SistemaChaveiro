<?php
    include 'database.php';
    require_once 'dao/UsuarioDaoPgsql.php';

    $usuariodao = New UsuarioDaoPgsql($pdo);
    $id_usuario = $_GET['id'];
    $usuario = $usuariodao->buscarPeloId($id_usuario);
?>

<div class="jumbotronContainer">
    <div class="jumbotron areaTabela cadastroUsuarioArea">
        <h3 class="text-center">Editar Usuário</h3>
            <?php if(isset($_GET['erroDB'])){ ?>
                <div class="alert alert-danger" role="alert">Falha ao editar usuário, contate o administrador.</div>
            <?php } ?>
            <?php if(isset($_GET['emailExistente'])){ ?>
                <div class="alert alert-danger" role="alert">Email já cadastrado.</div>
            <?php } ?>
        <div class="cadastroForm">  
            <form action="editarUsuario_controller.php" method="post">
                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario?>">
                <label>Nome: </label><span style="color: red;">*</span>
                <input  type="text" class="form-control" name="nome"  value="<?php echo $usuario->getNome(); ?>">
                <label>Celular: </label><span style="color: red;">*</span>
                <input id="celular" name="celular" type="text" class="form-control" value=" <?php echo $usuario->getTelefone(); ?>">
                <span id="erroTelefone" class="alertErro hide">Telefone inválido.</span>
                <label>Email:</label><span style="color: red;">*</span>
                <input type="email" class="form-control" name="email" value="<?php echo $usuario->getEmail(); ?>">
                <div class="div-botao-form">
                <input class="botao-form" type="submit" value="Salvar">
                </div>
            </form>
        </div>
    </div>
</div>