<?php 
session_start();
$impressora = $_POST['impressora'];
$_SESSION['impressora'] = $impressora;
header("Location:index.php");
?>