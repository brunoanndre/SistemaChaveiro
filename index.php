
<?php
include 'database.php';


session_start();

if($_SESSION['login'] == true){
    $pagina = $_GET['pagina'];
}else{
    if($_GET['pagina'] ==  'esqueceuSenha'){
        $pagina = 'esqueceuSenha';
    }else{
        $pagina = 'login';
    }
}

if($pagina != 'login' && $pagina != 'esqueceuSenha'){
    include 'header.php';
}
//redireciona o usuario para as paginas
if(isset($_SESSION['nivel_acesso'])){
    if($_SESSION['nivel_acesso'] == 1){
        switch($pagina){
           default: case 'consultarServicos': include 'view/consultarServicos.php'; break;
           case 'consultarUsuarios': include 'view/consultarUsuarios.php'; break;
           case 'cadastrarUsuario': include 'view/cadastrarUsuario.php'; break;
           case 'exibirUsuario': include 'view/exibirUsuario.php'; break;
           case 'editarUsuario': include 'view/editarUsuario.php'; break;
           case 'cadastrarComanda': include 'view/cadastrarComanda.php'; break;
           case 'consultarClientes': include 'view/consultarClientes.php'; break;
           case 'cadastrarCliente': include 'view/cadastrarCliente.php'; break;
           case 'exibirCliente': include 'view/exibirCliente.php'; break;
           case 'editarCliente': include 'view/editarCliente.php'; break;
           case 'exibirComanda': include 'view/exibirComanda.php'; break;
        }
    }else{
        switch($pagina){
            default: case 'consultarServicos': include 'view/consultarServicos.php'; break;
            case 'exibirUsuario': include 'view/exibirUsuario.php'; break;
            case 'cadastrarComanda': include 'view/cadastrarComanda.php'; break;
            case 'consultarClientes': include 'view/consultarClientes.php'; break;
            case 'cadastrarCliente': include 'view/cadastrarCliente.php'; break;
            case 'exibirCliente': include 'view/exibirCliente.php'; break;
            case 'exibirComanda': include 'view/exibirComanda.php'; break;
        }
    }
}
