<?php
    require_once 'dao/ComandaDaoPgsql.php';
    require_once 'dao/ClienteDaoPgsql.php';
    require_once 'dao/EnderecoDaoPgsql.php';

    $enderecodao = New EnderecoDaoPgsql($pdo);
    $clientedao = New ClienteDaoPgSql($pdo);
    $comandadao = New ComandaDaoPgSql($pdo);
    $parametro = "todas";
    $listaComandas  = $comandadao->buscarConsulta($parametro);


?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<div class="container">
    <h2 class="consulta_comandas">Consulta de Comandas</h2>
    <div class="jumbotron">
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
                    <th>Cliente</th>
                    <th>Tipo de serviço</th>
                    <th>Descrição</th>
                    <th>Endereço</th>
                    <th>Data de abertura</th>

                </tr>
            </thead>
            <tbody>
            <?php 
                if($listaComandas == false){
                    echo '<tr><td colspan="6" class="text-center">Nenhum chamado encontrado.</td></tr>';
                }else{
                    foreach($listaComandas as $comanda){
                        $cliente = $clientedao->buscarPeloId($comanda->getIdCliente());
                        $endereco = $enderecodao->buscarPeloId($comanda->getIdEndereco());
                        echo '<tr>';
                        echo '<td><a href="index.php?pagina=exibirComanda&id=' . $comanda->getId()  . '"><span class="glyphicon glyphicon-eye-open"></span></td></a>';
                        echo '<td>' . $comanda->getId() . '</td>';
                        echo '<td>' . $cliente->getNome() . '</td>';
                        echo '<td>' . $comanda->getTipo() . '</td>';
                        echo '<td>' . $comanda->getDescricao() . '</td>';
                        echo '<td>'. $endereco->getCidade() .', '. $endereco->getLogradouro() . ', '. $endereco->getNumero(). '</td>';
                        echo '<td>' . $comanda->getDataInicial() . '</td></tr>';
                    }
                }
            ?>
 
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