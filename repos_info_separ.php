<?php
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <script src="http://getbootstrap.com/2.3.2/assets/js/jquery.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/holder/holder.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/google-code-prettify/prettify.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/application.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

</head>

<style>
#validationCustom02,
#validationCustom01 {
    font-size: 10px;

}

label {
    font-size: 12px;

}

.form-check-label {
    font-size: 15px;
}
</style>

<body>

    <?php
    //date_default_timezone_set('America/Sao_Paulo');
    include('conexao.php');
    $sql = "SELECT descricao, cod_bar, replace(round(qtd_solic,2),',','.') as qtd_solic, id_repos FROM t_repos2 WHERE id_repos = '$id'";
    $resultado = mysqli_query($link, $sql);


    ?>

    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
        <a href="painel.php" class="w3-bar-item w3-button">Painel de separação</a>

    </div>

    <div id="main">

        <div class="w3-teal">
            <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h1>Informar Separação</h1>
            </div>
        </div>

        <div style="margin: 10px;">
            <div class="container">
                <form class="needs-validation" novalidate>
                    <?php
                    $contador = 0;
                    while ($linhaimp = mysqli_fetch_array($resultado)) {
                    ?>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <?php
                                if ($contador <= 0) {
                                ?>

                            <label for="validationCustom01">Código barras</label>
                            <?php
                                }
                                ?>
                            <input readonly type="text" class="form-control" id="validationCustom01"
                                placeholder="First name" value="<?php echo $linhaimp['cod_bar']; ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <?php
                                if ($contador <= 0) {
                                ?>

                            <label for="validationCustom01">Descricao</label>
                            <?php
                                }
                                ?>
                            <input readonly type="text" class="form-control" id="validationCustom02"
                                placeholder="Last name" value="<?php echo $linhaimp['descricao']; ?>">
                        </div>
                        <div class="col-md-1 mb-3">
                            <?php
                                if ($contador <= 0) {
                                ?>

                            <label for="validationCustom01">Qtd. Solicitada</label>
                            <?php
                                }
                                ?>
                            <input readonly type="number" class="form-control" id="validationCustom01"
                                value="<?php echo $linhaimp['qtd_solic']; ?>">
                            <div class="valid-feedback">
                                OK
                            </div>
                        </div>
                        <div class="col-md-1 mb-3">
                            <?php
                                if ($contador <= 0) {
                                ?>

                            <label for="validationCustom01">Qtd. Separada</label>
                            <?php
                                }
                                ?>
                            <input min="0" max="<?php echo $linhaimp['qtd_solic']; ?>" type="number"
                                class="form-control" id="validationCustom01" placeholder="Informar quantidade separada"
                                required>
                            <div class="invalid-feedback">
                                Informe a quantidade separada
                            </div>
                            <div class="valid-feedback">
                                OK
                            </div>
                        </div>
                        <br>

                    </div>
                    <?php
                        $contador++;
                    }
                    ?>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                Confirmo estar ciente das quantidades informadas neste formulário
                            </label>
                            <div class="invalid-feedback">
                                Você deve confirmar a transação
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Confirmar</button>
                </form>
            </div>
        </div>

    </div>
    </div>



</body>

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

</html>