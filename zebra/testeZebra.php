<?php // Fechar servidor
if(isset($_POST['fechar']))
{
exec('fechar.bat');
echo "<br>Servidor fechado com sucesso! <br>";
} else {
?> (Ao clicar no botao, aguarde 5 segundos!)
<form action="" method="post">
<input type="submit" name="fechar" value="Fechar Servidor">
</form>
<?php } ?>