<?php
$loja = $_SESSION['loja'];
$pdo = new PDO("pgsql:host=192.168.254.205;dbname=ceprd", "icomp", "icompdbpw");
$sql = "SELECT
pro.c_descr || ' ' || pro.c_compl as descricao,
ende.c_local as endereco
from a_produt pro 
left JOIN a_endpro ende ON (pro.c_codigo = ende.c_codprod AND ende.c_fil = '$loja')
where pro.c_codinteg = '$cod_mdlog'
order by 1 asc";
$result2 = $pdo->prepare($sql);