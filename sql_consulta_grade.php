<?php

$pdo = new PDO("pgsql:host=192.168.254.205;dbname=ceprd", "icomp", "icompdbpw");
$sql = "SELECT
pro.c_descr || ' ' || pro.c_compl as descricao,
cod.c_codbar as cod_bar
from a_produt pro 
LEFT JOIN a_codbar cod on (pro.c_codigo = cod.c_codprod)
where pro.c_codinteg = '$cod_mdlog'
order by 1 asc";
$result3 = $pdo->prepare($sql);