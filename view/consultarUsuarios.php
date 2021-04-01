<?php
    include 'database.php';
    require_once 'dao/UsuarioDaoPgsql.php';

    $usuariodao = New UsuarioDaoPgsql($pdo);
    
    $consultaUsuarios = $usuariodao->buscarConsulta();
?>
<div class="jumbotronContainer">
    <div class="areaTabela jumbotron">

    <a href="?pagina=cadastrarUsuario"><button class="btn  btn-success">Cadastrar Novo Usuário</button></a><br><br>
        <?php if(isset($_GET['sucesso'])) { ?>
            <div class="alert alert-success" role="alert">
                Usuario excluído com sucesso.
            </div>
        <?php } ?>
            <div>
                <h3 class="text-center">Consulta de usuários</h3>
            </div>
            <div>
                <table id="myTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            session_start();
                            if($consultaUsuarios == false){
                             echo '<tr><td colspan="5">Nenhum usuário encontrado</td></tr>';
                            }else{
                                foreach($consultaUsuarios as $usuario){
                                    echo '<tr><td class="text-center"><a href="index.php?pagina=exibirUsuario&id='.$usuario->getId().'"><span class="glyphicon glyphicon-eye-open"></span></a></td>';
                                    echo '<td>' . $usuario->getID().' </td>';
                                    echo '<td>' . $usuario->getNome() . '</td>';
                                    echo '<td>' . $usuario->getEmail() . '</td>';
                                    echo '<td>' . $usuario->getTelefone() . '</td></tr>';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#myTable').DataTable( {
        "language": {
            "lengthMenu": "Exibir _MENU_ Registros por página",
            "zeroRecords": "Nenhuma interdição encontrada",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhuma interdição registrada",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            }
        }
    } );
} );
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
