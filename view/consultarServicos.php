<?php


?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<div class="container">
    <h2 class="consulta_comandas">Consulta de Comandas</h2>
    <div class="jumdbotron">
            <a href="?pagina=cadastrarComanda"><button class="btn  btn-success">Cadastrar Nova Comanda</button><br><br></a>
            <form action="?pagina=consultarServicos" method="post">
            <span>Mostrar comandas agendadas: </span>
                    <input name="encerrada" onchange="this.form.submit()" value="true" type="checkbox" <?php if($_POST['encerrada']==true)echo 'checked'; ?>><br>
            </form>     
            <br>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Previsão de Chegada</th>
                    <th>Endereço</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="glyphicon glyphicon-eye-open"></span></td>
                    <td>1</td>
                    <td>22/03/2021</td>
                    <td>...</td>
                    <td>Rua teste</td>
                    <td>Trocar fechadura</td>
                </tr>
                <tr>
                    <td><span class="glyphicon glyphicon-eye-open"></span></td>
                    <td>2</td>
                    <td>22/03/2021</td>
                    <td>...</td>
                    <td>Avenida batata</td>
                    <td>Blablabla</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>$(document).ready( function () {
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
             },
        }
    });
} );</script>