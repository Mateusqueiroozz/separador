<?php

//impressora zebra
//impressao de gondola

$texto .= ' Q320,019'.$quebra;
$texto .= 'q831'.$quebra;
$texto .= 'rN'.$quebra;
$texto .= 'S4'.$quebra;
$texto .= 'D7'.$quebra;
$texto .= 'ZT'.$quebra;
$texto .= 'JB'.$quebra;
$texto .= 'OD'.$quebra;
$texto .= 'R56,0'.$quebra;
$texto .= 'N'.$quebra;


//Nome da gondola


$texto .= 'A580,280,2,2,1,1,N,"LOCALIZACAO"'.$quebra;
$texto .= 'A260,280,2,2,1,1,N,"LOCALIZACAO"'.$quebra;

//codigo da gondola
$texto .= 'A600,250,2,2,3,4,N,"'.$linha['codigo'].'"'.$quebra;
$texto .= 'A280,250,2,2,3,4,N,"'.$linha['codigo'].'"'.$quebra;
//codigo de barras
$texto .= 'B600,170,2,1,2,12,150,N,"'.$linha['codigo'].'"'.$quebra;
$texto .= 'B280,170,2,1,2,12,150,N,"'.$linha['codigo'].'"'.$quebra;

$texto .= 'P1'.$quebra;
$texto .= '
'.$quebra;


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
A580,280,2,2,1,1,N,"LOCALIZACAO"
A260,280,2,2,1,1,N,"LOCALIZACAO"
A600,250,2,2,3,4,N,"TG05A"
A280,250,2,2,3,4,N,"TG16A"
B600,170,2,1,2,12,150,N,"TG16A"
B280,170,2,1,2,12,150,N,"TG16A"
P1


*/


?>