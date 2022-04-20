<?php
session_start();

$sessao = session_id();

$connect = mysql_connect('localhost','root','');
$db = mysql_select_db('buscapreco');

?>
<!DOCTYPE html> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>REPOSICAO DE LOJA</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
	<script src="/buscapreco/js/jquery2.js"></script>
	<script src="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>


</head>
<body>
<div data-role="header" data-theme="b">
<h1>SELECIONE A GONDOLA</h1>

</div>

			<?php
			//chama o arquivo de configuração com o banco

			require 'conexao2.php';

			//seleciona os dados da tabela produto
			$query = mysql_query("SELECT id, nome, responsavel FROM gondola");
			// abaixo montamos um formulário em html
			// e preenchemos o select com dados
			?>
			<form name="produto" method="post" action="index2.php">
			  <label>SELECIONE A GONDOLA</label>
			  <select>
				<option>Selecione...</option>
				 
			//abrimos um contador while para que enquanto houver registros ele continua no loopin
				<?php while($prod = mysql_fetch_array($query)) { ?>
				<option value="<?php echo $prod['id'] ?>"><?php echo $prod['nome'] ?>  /  <?php echo $prod['responsavel'] ?></option>
				<?php } ?>
			  </select>
			  
			  <div id="botaocadastro">
					<input style="width:225;height:30;" type="submit" name="gondola" value="CONTINUAR">
			 </div>
			  
			</form>

</body>

</html>