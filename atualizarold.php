
<?php

include('conexao.php');


//arquio de atualização
$nomearq = "config.ini";

	//unlink($nomearq);
	//mysql_query("TRUNCATE TABLE produto");



//mysqli_query($link,"UPDATE produto SET atualizado='0'");

	//mysqli_query($link, "UNLOCK TABLES;");

		
	mysqli_query($link,"LOAD DATA INFILE 'd:/wamp/www/buscapreco/preco.txt' INTO TABLE produto
		FIELDS TERMINATED BY '~~~~~' 
		ENCLOSED BY '\"' 
		LINES TERMINATED BY '\n';");
echo mysqli_errno($link) . ": " . mysqli_error($link) . "\n";

//mysqli_query($link, "DELETE FROM produto WHERE atualizado = 0");
   //unlink($nomearq);
						
			$fp = fopen("config.ini", "a");
				
				// Escreve "exemplo de escrita" no bloco1.txt
				$escreve = fwrite($fp, "Atualizado");
				
				// Fecha o arquivo
				fclose($fp);

//unlink('preco.txt');

echo "Atualizado";
//cria arquivo de atualização

 
		?>
