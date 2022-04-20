<!DOCTYPE html>
<html>
<title>Sistema de Separação</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="./plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="./plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="./plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="./plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="./plugins/bs-stepper/css/bs-stepper.min.css">
    <link rel="stylesheet" href="./plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    <script src="./plugins/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="css/spinner.css">
    <script src="js/finalizar_documento.js"></script>
</head>
<script>
$(document).on("click", ".open-AddBookDialog", function() {
    var myBookId = $(this).data('id');
    $(".modal-body #bookId").val(myBookId);
    // As pointed out in comments, 
    // it is unnecessary to have to manually call the modal.
    // $('#addBookDialog').modal('show');
});
</script>

<?php
session_start();
$_SESSION['menu'] = 1;
include('barra.php');
?>
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Finalizar Separação</h3>

                        </div>

                        <div class="card-body">
                            <form id="form_documento" action="painel_finalizar.php" method="post">
                                <input type="text" id="doc" name="doc" value="" hidden>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                            include('sql_consulta_atendimentos_pendentes.php');
                                            $resultado = mysqli_query($link, $sql);
                                            ?>
                                            <label>Atendimentos Pendentes</label>
                                            <select required class="form-control select2 select2-success"
                                                data-dropdown-css-class="select2-success" style="width: 100%;"
                                                name="documento" id="documento" onChange="update()">
                                                <option selected value="">- Selecione -</option>
                                                <?php
                                                while ($linha = mysqli_fetch_array($resultado)) {
                                                ?>
                                                <option value="<?php echo $linha['id']; ?>">
                                                    <?php
                                                        echo $linha['linha'];
                                                        ?>
                                                </option>
                                                <?php
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-4">
                                        <label>Todos os itens foram atendidos?</label>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input custom-control-input-success"
                                                type="radio" id="customRadio1" name="itens" value="sim" checked>
                                            <label for="customRadio1" class="custom-control-label">Sim</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input
                                                class="custom-control-input custom-control-input-danger custom-control-input"
                                                type="radio" id="customRadio2" name="itens" value="nao">
                                            <label for="customRadio2" class="custom-control-label">Não</label>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-secondary">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-secondary">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Secondary Modal</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>One fine body&hellip;</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-outline-light"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-outline-light">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <button type="submit" class="btn btn-secondary btn-lg btn-block">Finalizar
                                        Separação</button>
                                </div>
                            </form>
                            <br>
                            <div class="card-footer">
                                <p id="time"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2022-2022.</strong> All rights reserved.
</footer>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script src="./plugins/jquery/jquery.min.js"></script>
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./plugins/select2/js/select2.full.min.js"></script>
<script src="./plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="./plugins/moment/moment.min.js"></script>
<script src="./plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="./plugins/daterangepicker/daterangepicker.js"></script>
<script src="./plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="./plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="./plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="./plugins/bs-stepper/js/bs-stepper.min.js"></script>
<script src="./plugins/dropzone/min/dropzone.min.js"></script>
<script src="./dist/js/adminlte.min.js"></script>
<script src="./dist/js/demo.js"></script>
<script>
var timeDisplay = document.getElementById("time");


function refreshTime() {
    var dateString = new Date().toLocaleString("pt-BR", {
        timeZone: "America/Sao_Paulo"

    });

    var formattedString = dateString.replace(", ", " - ");
    timeDisplay.innerHTML = formattedString;
}

setInterval(refreshTime, 1000);
</script>

<script>
$(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {
        'placeholder': 'mm/dd/yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY hh:mm A'
        }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                    .endOf('month')
                ]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
        },
        function(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
        format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

})
// BS-Stepper Init
document.addEventListener('DOMContentLoaded', function() {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
});



// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
};
document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true);
};
// DropzoneJS Demo Code End
</script>
<script>
$('input[name="impressao"]').change(function() {
    if ($('input[name="impressao"]:checked').val() === "sim") {
        $('#imprime').show();
    } else {
        $('#imprime').hide();
    }
});
</script>
<script type="text/javascript">
function update() {
    var select = document.getElementById('documento');
    var option = select.options[select.selectedIndex];
    document.getElementById('doc').value = option.value;
}
</script>

</body>

</html>