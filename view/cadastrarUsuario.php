<?php?>
<head>
<script type="text/javascript" src="../main.js"></script>
<script type="text/javascript" src="jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../jquery.mask.min.js"> </script>
</head>
<script>
$(document).ready(function(){
    $("#celular").mask("(00) 00000-0000")
})
</script>
<div class="jumbotronContainer">
    <div class="jumbotron areaTabela cadastroUsuarioArea">
        <h3 class="text-center">Cadastro de Usuário</h3>
        <div class="cadastroForm">  
            <?php if(isset($_GET['sucesso'])){ ?>
                <div class="alert alert-success" role="alert">Usuário cadastrado com sucesso.</div>
            <?php } ?>
            <?php if(isset($_GET['erroDB'])){ ?>
                <div class="alert alert-danger" role="alert">Falha ao cadastrar usuário.</div>
            <?php } ?>
            <?php if(isset($_GET['erroEmail'])){ ?>
                <div class="alert alert-danger" role="alert">Email já cadastrado.</div>
            <?php } ?>
            <form action="cadastrarUsuario_controller.php" method="post" enctype="multipart/form-data">
                <label>Nome: </label><span style="color: red;">*</span>
                <input  type="text" class="form-control" name="nome" required>
                <label>Celular: </label><span style="color: red;">*</span>
                <input id="celular" name="celular" type="text" class="form-control">
                <span id="erroTelefone" class="alertErro hide">Telefone inválido.</span>
                <label>Email:</label><span style="color: red;">*</span>
                <input type="email" class="form-control" name="email" required>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Senha:</label><span style="color: red;">*</span>
                        <input id="senha" name="senha_cadastro" type="password" class="form-control" required title="Senha deve possuir no mínimo 6 caracteres, 1 letra minuscula, 1 letra maiuscula e 1 número" onchange="verificaSenha(this.value)">
                        <span id="erroSenha" class="alertErro hide">
                            Senha inválida (Senha deve possuir no mínimo 6 caracteres, 1 letra minuscula, 1 letra maiuscula e 1 número).
                        </span>
                    </div>
                        <div class="col-sm-6">
                            <label>Confirmar senha:</label><span style="color: red;">*</span>
                            <input id="senha_confirma" name="senha_cadastro_confirma" type="password" class="form-control" required onchange="verificaConfirmaSenha(this.value)">
                            <span id="erroConfirmaSenha" class="alertErro hide">Senhas diferentes.</span>
                        </div>
                </div>
                <div class="div-botao-form">
                <input class="botao-form" type="submit" value="Cadastrar">
                </div>
            </form>
        </div>
    </div>
</div>
