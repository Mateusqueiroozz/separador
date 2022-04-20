<!doctype html>
<html lang="pt-br">

<?php
include('conexao.php');
session_start();
$consulta = mysqli_query($link,"SELECT * FROM impressora WHERE tipo LIKE '%~ETIQUETA~%' OR tipo LIKE '%~ELGIN~%' and ativo=1 order by descricao");
	
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="animated_favicon1.gif" type="imagem/gif">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/css1.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/css2.css">

    <title>Login - Reposicao Mobile</title>
</head>

<body>

    <div id="central-login" margin-top="5%">
        <div class="content" align="center">
            <img width="110px" height="200px" src="img/ce.jpg" />
            <form method="POST" class="col-sm-4" action="login.php">
                <div class="input-container">                   
                    <select class="custom-select mr-sm-2" id="impressora" name="impressora">
                        <?php
                            while ($linha = mysqli_fetch_array($consulta)){
                        ?>
                            <option  value="<?php echo $linha['id'];?>"><?php echo $linha['descricao'];?></option>
                            
                            <?php
                            }
                            ?>                   
                  </select>
                </div>
                <div class="input-container">

                    <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" autofocus=""><br>
                </div>

                <div class="input-container">

                    <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha"><br>
                </div>

                <input type="submit" value="Entrar" id="entrar" name="entrar" class="btn btn-outline-danger btn-lg btn-block">
            </form>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/j1.js"></script>
    <script src="js/j2.js"></script>
    <script src="js/j3.js"></script>
</body>

</html>