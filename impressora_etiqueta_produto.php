<?php

//impressora zebra
$texto .= ' Q320,B24'.$quebra;
$texto .= 'q480'.$quebra;
$texto .= 'rN'.$quebra;
$texto .= 'S3'.$quebra;
$texto .= 'D9'.$quebra;
$texto .= 'ZT'.$quebra;
$texto .= 'JF'.$quebra;
$texto .= 'O'.$quebra;
$texto .= 'R56,0'.$quebra;
$texto .= 'N'.$quebra;



$texto .= 'A560,280,2,3,1,1,N,"'.$linha['codmdlog'].'"'.$quebra;
$texto .= 'B550,240,2,1,3,10,90,B,"'.$linha['codigo'].'"'.$quebra;
$texto .= 'A580,80,2,2,1,1,N,"'.$linha['produto'].'"'.$quebra;
$texto .= 'A580,55,2,2,1,1,N,"'.$linha['complemento'].'"'.$quebra;
$texto .= 'A260,25,2,3,1,1,N,"'.$linha['ncm'].'"'.$quebra;
//$texto .= 'B300,110,2,1,2,12,80,N,"'.$linha['codigo'].'"'.$quebra;



//$qtdimp = ceil($linha['qtd']/2);
$qtdimp = $linha['qtd'];

$texto .= 'P'.$qtdimp.$quebra;

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