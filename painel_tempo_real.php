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
</head>


<?php
session_start();
$_SESSION['menu'] = 1;
include('barra.php');
?>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Separação em Tempo Real</h3>
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Atendente</th>
                                        <th>Doc.</th>
                                        <th>Quant. Itens</th>
                                        <th>Tipo de atendimento</th>
                                        <th>Inicio Separação</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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

// DropzoneJS Demo Code Start
Dropzone.autoDiscover = false;

// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
});

myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() {
        myDropzone.enqueueFile(file);
    };
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
});

myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
});

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="./js/refresh_painel.js"></script>
</body>

</html>