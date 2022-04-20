<!DOCTYPE html>
<html>

<head>
</head>

<body>

    <?php
	session_start();
	//error_reporting(E_ERROR | E_WARNING | E_PARSE);
	$loja = $_SESSION['loja'];
	$usuario = (int)$_SESSION['usuario'];
	criaReposicao($loja, $usuario);

	function criaReposicao($loja, $usuario1)
	{
		include('conexao.php');
		date_default_timezone_set('America/Sao_Paulo');

		if (isset($_POST['qtd_solic'])) {
			for ($i = 0; $i < count($_POST['qtd_solic']); $i++) {
				if ($_POST['qtd_solic'][$i] == 0) {
					$ok = 0;
					echo "<script language='javascript' type='text/javascript'>
				alert('Informe quantidade maior que 0 (zero) ou desmarque o produto');window.location
				.href='reposicao_selecao.php';</script>";
				} else {
					$ok = 1;
				}
			}
		} else {
			echo "<script language='javascript' type='text/javascript'>
			alert('Selecione Produtos e quantidade');window.location
			.href='reposicao_selecao.php';</script>";
		}
		if (isset($_POST['item']) && $ok == 1) {
			$dt_solic = date('Y/m/d H:i:s');
			$qtd_itens = count($_POST['item']);
			//echo $qtd_itens;
			$sql = "INSERT INTO t_repos1 (dthora_solic, qtd_itens, user_solic, situacao, loja) VALUES ('$dt_solic', '$qtd_itens', '$usuario1', 'A', '$loja')";
			$ok_itens = 0;
			if ($link->query($sql) === TRUE) {
				$id_repos = $link->insert_id;
				for ($i = 0; $i < count($_POST['item']); $i++) {
					$cod_bar = $_POST['item'][$i];
					$qtd_solic = $_POST['qtd_solic'][$i];

					$descricao = buscaDescricao($cod_bar);

					$sql = "INSERT INTO t_repos2 (id_repos, cod_bar, qtd_solic, descricao) VALUES ('$id_repos', '$cod_bar', '$qtd_solic', '$descricao')";
					if ($link->query($sql) === TRUE) {
					} else {
						$ok_itens = 1;
						echo "Error: " . $sql . "<br>" . mysqli_error($link);
					}
					buscaEndereco($id_repos);
				}
				if ($ok_itens == 0) {
					echo "<script language='javascript' type='text/javascript'>
						alert('Reposição solicitada. Acompanhe o despacho no painel de reposições solicitadas. ID REPOSIÇÃO: $id_repos');window.location
						.href='reposicao_selecao.php';</script>";
				}
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($link);
			}
		} else if ($ok == 1) {
			echo "<script language='javascript' type='text/javascript'>
			alert('Selecione Produtos e quantidade');window.location
			.href='reposicao_selecao.php';</script>";
		}
	}
	function buscaDescricao($cod_bar)
	{
		require_once('conexaoPDO.php');
		$pdo = new Conexao();
		$sql = "SELECT pro.c_descr || ' ' || pro.c_compl as descricao,			 
					pro.c_codinteg as mdlog	  				
			FROM a_produt AS pro		  	 
				LEFT JOIN a_codbar cod ON (pro.c_codigo = cod.c_codprod)				
			WHERE (cod.c_codbar = '$cod_bar')";

		$resultado = $pdo->select($sql);

		foreach ($resultado as $item) {
			$descricao = $item['descricao'];
		}

		return $descricao;
	}

	function buscaEndereco($id_repos)
	{
		include('conexao.php');

		$sql_mysql = "SELECT 
		id as id_produto,
		cod_bar as cod_bar,		
		id_repos as id_repos
		from t_repos2 
		where id_repos = '$id_repos'";
		$ultimo = 0;
		$resultado_mysql = mysqli_query($link, $sql_mysql);
		while ($item = mysqli_fetch_array($resultado_mysql)) {
			$id_produto = $item['id_produto'];
			$cod_bar = $item['cod_bar'];
			$id_repos = $item['id_repos'];
			echo $id_produto;
			echo '<br>';
			echo $cod_bar;
			echo '<br>';
			echo $id_repos;
			echo '<br>';
			consultaEndereco($cod_bar, $id_produto, $id_repos);
		}
	}

	function consultaEndereco($cod_bar, $id_produto, $id_repos)
	{
		require_once('conexaoPDO.php');
		$pdo = new Conexao();
		$sql = "SELECT
			pro.c_descr || ' ' || pro.c_compl as descricao,
			pro.c_codinteg as mdlog,
			ende.c_local as endereco
			FROM a_produt AS pro
			LEFT JOIN a_codbar cod ON (pro.c_codigo = cod.c_codprod)
			LEFT JOIN a_endpro ende ON (pro.c_codigo = ende.c_codprod)
			WHERE (cod.c_codbar = '$cod_bar')
			AND ende.c_fil = '10'";

		$resultado = $pdo->select($sql);

		foreach ($resultado as $item2) {
			$endereco2 = $item2['endereco'];
			//echo 'chamando funcao que insere...';
			insereEndereco($endereco2, $id_produto, $id_repos);
		}
	}

	function insereEndereco($endereco2, $id_produto, $id_repos)
	{
		include('conexao.php');
		$sql = "INSERT INTO t_repos3 (endereco, id_produto, id_repos) VALUES ('$endereco2', '$id_produto', '$id_repos')";
		if ($link2->query($sql) === TRUE) {
			//echo 'endereco inserido';
			echo '<br>';
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($link2);
		}
	}

	?>
</body>

</html>