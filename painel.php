<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel de Separação</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./dist/js/demo.js"></script>
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->

    <!-- DataTables  & Plugins -->
    <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="./plugins/jszip/jszip.min.js"></script>
    <script src="./plugins/pdfmake/pdfmake.min.js"></script>
    <script src="./plugins/pdfmake/vfs_fonts.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->

    <!-- AdminLTE for demo purposes -->

    <!-- Page specific script -->
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "buttons": [""]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>
</head>

<body>
    <?php
    session_start();
    $_SESSION['menu'] = 1;
    include('barra.php');
    ?>

    <?php
    //date_default_timezone_set('America/Sao_Paulo');
    /*
    include('conexao.php');
    $sql = 'select rep.id, rep.dthora_solic, rep.qtd_itens, 
    case WHEN rep.situacao = "A" then "Aguardando Separação" 
            when situacao = "B" then "Em separação"
            when situacao = "C" then "Aguardando coleta"
            end as situacao, us.usuario from t_repos1 rep
    INNER JOIN t_user us ON (rep.user_solic = us.id)';
    $resultado = mysqli_query($link, $sql);
*/

    ?>

    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
        <a href="#" class="w3-bar-item w3-button">Link 1</a>
        <a href="#" class="w3-bar-item w3-button">Link 2</a>
        <a href="#" class="w3-bar-item w3-button">Link 3</a>
    </div>

    <div id="main">



        <div style="margin: 10px;">
            <div class="container">
                <div style="max-width:100%; " class="table-overflow">
                    <table id="example1" class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Data</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>Valor</th>
                                <th>Tratar</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include('sql_consulta_orcamento.php');
                            foreach ($result as $item) {
                            ?>
                            <tr>
                                <td><?php echo $numero = $item['numero']; ?></td>
                                <td><?php echo $data = $item['data']; ?></td>
                                <td><?php echo $cliente = $item['cliente']; ?></td>
                                <td><?php echo $vendedor = $item['vendedor']; ?></td>
                                <td><?php echo $valor = $item['valor']; ?></td>

                                <td>
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Tratar</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="iniciar_separacao.php?num=<?php echo $numero; ?>">Iniciar
                                                separação</a>

                                            <div role="separator" class="dropdown-divider"></div>
                                            <a class="dropdown-item"
                                                href="boxed_lista.php?num=<?php echo $id; ?>&nome=<?php echo $nome; ?>">Finalizar
                                                separação</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Data</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>Valor</th>
                                <th>Tratar</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            </td>

            </tr>
            </tbody>
            </table>
        </div>

    </div>
    </div>



</body>

</html>