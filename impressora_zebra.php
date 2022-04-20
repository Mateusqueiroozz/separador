		<?php

		//impressora zebra
		//$texto .= ' Q320,019'.$quebra;
		
		$texto .= ' Q320,B24' . $quebra;
		//$texto .= 'q831'.$quebra;
		$texto .= 'q741' . $quebra;
		$texto .= 'rN' . $quebra;
		//$texto .= 'S4'.$quebra;
		$texto .= 'S3' . $quebra;
		//$texto .= 'D7'.$quebra;
		$texto .= 'D9' . $quebra;
		$texto .= 'ZT' . $quebra;
		//$texto .= 'JB'.$quebra;
		$texto .= 'JF' . $quebra;
		//$texto .= 'OD'.$quebra;
		$texto .= 'O' . $quebra;
		$texto .= 'R56,0' . $quebra;
		$texto .= 'N' . $quebra;


		$texto .= 'A620,280,2,3,1,1,N,"' . $linhaimp['produto'] . '"' . $quebra;
		$texto .= 'A620,250,2,3,1,1,N,"' . $linhaimp['complemento'] . '"' . $quebra;
		$texto .= 'A550,210,2,3,3,3,N,"R$ ' . $linhaimp['valor'] . '"' . $quebra;
		$texto .= 'B550,100,2,1,3,12,60,N,"' . $linhaimp['codigo'] . '"' . $quebra;
		$texto .= 'A550,140,2,3,2,2,N,"' . $linhaimp['codigo'] . '"' . $quebra;
		//$texto .= 'A280,28,2,3,1,1,N,"'.$linha['id_local'].'"'.$quebra;
		//$texto .= 'A380,28,2,3,1,1,N,"' . $linhaimp['id_local'] . '"' . $quebra;
		//$texto .= 'A550,28,2,3,1,1,N,"'.date('d/m/y') .'"'.$quebra;
		$texto .= 'A620,28,2,3,1,1,N,"' . date('d/m/y') . '"' . $quebra;




		$texto .= 'P' . $linhaimp['qtd'] . $quebra;
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