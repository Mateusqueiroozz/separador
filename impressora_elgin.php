		<?php

		
		
		
		
		
		
		
		


//impressora zebra
//$texto .= ' Q320,019'.$quebra;
$texto .= ' Q240,B24'.$quebra;
//$texto .= 'q831'.$quebra;
$texto .= 'q824'.$quebra;
$texto .= 'rN'.$quebra;
//$texto .= 'S4'.$quebra;
$texto .= 'S3'.$quebra;
//$texto .= 'D7'.$quebra;
$texto .= 'D9'.$quebra;
$texto .= 'ZT'.$quebra;
//$texto .= 'JB'.$quebra;
$texto .= 'JF'.$quebra;
//$texto .= 'OD'.$quebra;
$texto .= 'O'.$quebra;
$texto .= 'R56,0'.$quebra;
$texto .= 'N'.$quebra;


$texto .= 'A684,190,2,1,1,1,N,"'.$linha['produto'].'"'.$quebra;
$texto .= 'A684,170,2,1,1,1,N,"'.$linha['complemento'].'"'.$quebra;
$texto .= 'A262,190,2,1,1,1,N,"'.$linha['produto'].'"'.$quebra;
$texto .= 'A262,170,2,1,1,1,N,"'.$linha['complemento'].'"'.$quebra;
$texto .= 'B684,145,2,1,2,3,60,B,"'.$linha['codigo'].'"'.$quebra;
$texto .= 'B262,145,2,1,2,3,60,B,"'.$linha['codigo'].'"'.$quebra;
$texto .= 'A692,28,2,3,1,1,N,"'.date('d/m/y') .'"'.$quebra;
$texto .= 'A262,28,2,3,1,1,N,"'.date('d/m/y') .'"'.$quebra;

//$texto .= 'A280,28,2,3,1,1,N,"'.$linha['id_local'].'"'.$quebra;
//$texto .= 'A380,28,2,3,1,1,N,"'.$linha['id_local'].'"'.$quebra;
//$texto .= 'A550,28,2,3,1,1,N,"'.date('d/m/y') .'"'.$quebra;
//$texto .= 'A620,28,2,3,1,1,N,"'.date('d/m/y') .'"'.$quebra;


$qtd = $linha['qtd'];

if($qtd == 1){
  $qtd2 = 1;
}else{
	$qtd2 = $qtd / 2;
}

$texto .= 'P'.$qtd2.$quebra;
$texto .= $quebra;
/*
 Q320,019
q831
rN
S4
D7
ZT
JB
OD
R56,0
N


A250,28,2,3,1,1,N,"TG1"
A420,28,2,3,1,1,N,"12/01/2016"
P1


*/


?>