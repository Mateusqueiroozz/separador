<?php
session_start();
include('conexao.php');
$usuario = $_POST['usuario'];
$entrar = $_POST['entrar'];
$senha = MD5($_POST['senha']);
$impressora = $_POST['impressora'];

//echo $impressora;
$_SESSION['impressora'] = $impressora;



$verifica = mysqli_query($link, "SELECT * FROM t_user WHERE nome = 
    '$usuario' AND senha = '$senha' LIMIT 1") or die("erro ao selecionar");
if (mysqli_num_rows($verifica) <= 0) {
  echo "<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location
        .href='entrar.php';</script>";
  die();
} else {
  //adiciona 50mil seg de conexao ao usuario utilizado
  while ($linhaimp = mysqli_fetch_array($verifica)) {
    $loja = $linhaimp['loja'];
    $user = $linhaimp['id'];
    $_SESSION['loja'] = $loja;
    $_SESSION['usuario'] = $user;
  }
  include('impressora.php');
  header("Location:painel_index.php");
}
