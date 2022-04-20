<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Controle de Horas</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>
    <script src="../../dist/js/demo.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/spinner.css">
    <!--<script src="js/inserir_horas.js"></script>-->
</head>

<?php
session_start();
$id_rec = $_GET['id'];
$nome_rec = $_GET['nome'];
$_SESSION['id'] = $id_rec;
$_SESSION['nome'] = $nome_rec;

?>

<?php
$_SESSION['menu'] = 1;
include('barra.php');
?>
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestão de Funcionário</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="index.php">Funcionário</a></li>
                        <li class="breadcrumb-item"><a>Lançar hora</a></li>
                        <li class="breadcrumb-item"><a><?php echo $id_rec; ?> - <?php echo $nome_rec; ?></a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lançar Hora /
                                <?php echo $id_rec . ' - ' . $nome_rec; ?> </h3>
                            <br>
                            <?php
                            include('conexao.php');
                            $consulta_mes = "SELECT id as id, DATE_FORMAT(competencia,'%m/%Y') as data_mes FROM competencias_geral WHERE status = 0";
                            $res_mes = mysqli_query($link1, $consulta_mes);
                            $consulta_saldo = "SELECT case when loja = 10 then 'COHAMA'
                                    when loja = 20 then 'SÃO FRANCISCO'
                                    when loja = 30 then 'GUAJAJARAS'end as loja_nome,
                                    funcionario.id as id,
                                    cpf as cpf,
                                    nome as nome,                                                                      
									comp.horas_saldo
                                    FROM funcionario
									LEFT JOIN competencias comp on (comp.id_func = funcionario.id)
									LEFT JOIN competencias_geral comp_geral on (comp_geral.id = comp.competencia)
									WHERE comp_geral.status = 0	
                                    AND comp.id_func = '$id_rec'							
									GROUP BY 1,2,3,4,5";
                            $res_saldo = mysqli_query($link2, $consulta_saldo);
                            while ($linha = mysqli_fetch_array($res_saldo)) {
                                $saldo = $linha['horas_saldo'];
                            }
                            ?>



                        </div>
                        <div class="card-body">
                            <form id="form_hora" class="needs-validation" novalidate method="POST"
                                action="processa.php">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="saldo">Saldo:</label>
                                            <input type="text" readonly name="saldo" class="form-control" id="saldo"
                                                aria-describedby="saldo" value="<?php echo $saldo; ?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tipo">Tipo:</label>
                                    <select class="form-control" id="tipo" name="tipo">
                                        <option value="credito">Crédito</option>
                                        <option value="debito">Débito</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="valor_hora">Quantidade de horas:</label>
                                            <input required type="number" name="valor_hora" class="form-control"
                                                id="valor_hora" aria-describedby="valor_hora" step="1.0" min="0"
                                                max="100">
                                            <div class="invalid-feedback">
                                                Informe a quantidade de horas
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="valor_minuto">Quantidade de minutos:</label>
                                            <input required type="number" name="valor_minuto" class="form-control"
                                                id="valor_minuto" aria-describedby="valor_minuto" step="1.0" min="0"
                                                max="59">
                                            <div class="invalid-feedback">
                                                Informe a quantidade de minutos
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="mes">Mês competente:</label>
                                            <select class="form-control" id="mes" name="mes">
                                                <?php
                                                while ($linha = mysqli_fetch_array($res_mes)) {
                                                ?>
                                                <option value="<?php echo $linha['id']; ?>">
                                                    <?php echo $linha['data_mes']; ?>
                                                </option>

                                                <?php
                                                }
                                                ?>

                                            </select>
                                            <div class="invalid-feedback">
                                                Informe o mês competente
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="obs">Observação:</label>
                                    <textarea name="obs" class="form-control" id="obs" rows="1"
                                        placeholder="Ex: Horas referente ao mês ..."></textarea>
                                </div>

                                <div class="row">
                                    <button id="btn_salvar" type="submit"
                                        class="btn btn-success btn-lg btn-block">Lançar</button>
                                </div>
                            </form>

                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
$sql_saldo = "SELECT * FROM funcionario WHERE id = '$id_rec'";
$res_saldo = mysqli_query($link1, $sql_saldo);

while ($linha = mysqli_fetch_array($res_saldo)) {
    $_SESSION['saldo'] = $linha['horas_saldo'];
}
?>
<script>
window.onload = function() {
    document.getElementById('tipo').addEventListener('change', function() {
        var style = this.value == 'Outros' ? 'block' : 'none';
        document.getElementById('form-group_hidden').style.display = style;
    });
}
</script>
<script>
$("valor").on("change", function() {
    $(this).val(parseFloat($(this).val()).toFixed(2));
});
</script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

<?php
include('rodape.php');
?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

</body>

</html>