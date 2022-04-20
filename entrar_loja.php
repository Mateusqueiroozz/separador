<!DOCTYPE html>
<html lang="en">

<?php
include('conexao.php');
session_start();
$loja = $_SESSION['loja'];
$sql = "SELECT * FROM impressora WHERE (tipo LIKE '%~ETIQUETA~%' OR tipo LIKE '%~ELGIN~%' and ativo=1) and loja = $loja  order by descricao";

$consulta = mysqli_query($link, $sql);


?>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/ce.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-20 p-b-20">
                <form method="POST" action="login_loja.php" class="login100-form validate-form ">
                    <span class="login100-form-title p-b-30">
                        Centro Repositor
                    </span>
                    <div>
                        <div class="box">
                            <img src="images/ce_1.png" alt="IMG1">
                        </div>

                        <div class="box">
                            <img src="images/coletor.jpg" alt="IMG2">
                        </div>
                    </div>
                    <style>
                    div.box {
                        width: 49%;
                        display: inline-block;
                    }

                    img {
                        width: 100%;
                    }
                    </style>
                    <br>

                    <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                        <label>Selecione a impressora de etiquetas</label>
                        <select class="custom-select" style="width: 100%;" id="impressora" name="impressora">
                            <?php
                            while ($linha = mysqli_fetch_array($consulta)) {
                            ?>
                            <option value="<?php echo $linha['id']; ?>"><?php echo $linha['descricao']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Entrar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>