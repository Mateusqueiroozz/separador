<!DOCTYPE html>
<html lang="en">

<head>
</head>
<body>
<?php 
$usuario_cookie = $_COOKIE['usuario'];
$_SESSION['impressora'] = "";
setcookie("usuario",$usuario, time()-50000);
echo"<script language='javascript' type='text/javascript'>
        alert('Você foi desconectado');window.location
        .href='entrar.php';</script>";
?>
</body>
</html>