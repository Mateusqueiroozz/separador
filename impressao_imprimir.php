<?php
session_start();
$sessao = session_id();
error_reporting(E_ALL);

/* Habilita a exibição de erros */
ini_set("display_errors", 1);
include('conexao.php');
$impressora = $_SESSION['impressora'];

/* Informa o nível dos erros que serão exibidos */

//gqwerasd 
$consultaimp = mysqli_query($link, "SELECT
impressao.data_hora,
impressao.tipo,
impressao.codigo,
impressao.produto,
impressao.complemento,
impressao.ncm,
impressao.codmdlog,
impressao.valor,
impressao.id_situacao,
Sum(impressao.qtd) as qtd
FROM
impressao
WHERE
impressao.id_situacao = 1 and sessao='" . $sessao . "'
GROUP BY
impressao.codigo");
$ordem = 0;
$texto = "";
while ($linhaimp = mysqli_fetch_array($consultaimp)) {
    $linhaimp['codigo'];
    $ordem++;
    $quebra = "\n";
    $c = 0;
    $txtaltera = "";



    switch ($linhaimp['tipo']) {

        case "GONDOLA":
            //impressao de gondola salao	
            include('impressora_zebra.php');
            break;
        case "PROMOCAO":
            //impressao de gondola deposito
            include('impressora_zebra_promocao.php');
            break;

        case "ETIQUETA":
            //impressao de gondola deposito
            include('impressora_etiqueta_produto.php');
            break;

        case "ELGIN":
            include('impressora_elgin.php');
            break;

        case 3:
            //impressao de promocao
            //include('impressora_zebra_gondola_deposito.php');
            break;
        default:
            //se impressao normal
            include('impressora_zebra.php');
    }


    //echo $texto;	

}



//$arquivoenvia =  "arquivos\impressao_".$terminal."_".$usuario.".txt";
//$nomearquivo = "imp_" . $impressora . "_" . $sessao . ".txt";
$nomearquivo = "impressao/imp_" . $impressora . "_" . $sessao . ".txt";
//$nomearquivo = "impressao\imp_".$impressora."_".$sessao.".txt";

if (file_exists($nomearquivo)) {
    unlink($nomearquivo);
}


//gera arquivo impressao1.txt
$fp = fopen($nomearquivo, "w+");
// Escreve "exemplo de escrita" no bloco1.txt
$escreve = fwrite($fp, $quebra . $texto);
// Fecha o arquivo
fclose($fp);

//$host = "\\192.168.253.107/ZebraTLPlj10";

//shell_exec("copy '".$nomearquivo."' /B '".$host."'");
//include("imprime_zebra.php");

?>


<!DOCTYPE html>
<html>

<head>
    <title>Impressao</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
    <script src="js/jquery.js"></script>
    <script src="js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
    <div class="ui-corner-all custom-corners">



        <div class="ui-corner-all custom-corners">
            <div class="ui-bar ui-bar-a" style="text-align:center; color:red; height:40px; line-height:40px">As
                etiquetas foram impressas corretamente?</div>
        </div>
        <div class="confirma" style="text-align:center">
            <a href="impressao_novo.php" onclick="adiciona.submit();" data-ajax="false"
                style="background-color:green;color:white;font-weight: normal;"
                class="ui-btn ui-btn-inline ui-icon-check ui-btn-icon-left">Sim</a>


            <a href="impressao_imprimir.php" data-ajax="false"
                style="background-color:red;color:white;font-weight: normal;"
                class="ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-right">Não</a>
            



            <script type="text/javascript">
            $(document).keypress(function(e) {
                if (e.which == 13) {
                    location.href = "index.php";

                    //	$("#enviar").click();
                    //	alert("You pressed enter!");
                }

            });
            document.onkeydown = function(evt) {
                evt = evt || window.event;
                var isEscape = false;
                if ("key" in evt) {
                    isEscape = (evt.key == "Escape" || evt.key == "Esc");
                } else {
                    isEscape = (evt.keyCode == 27);
                }
                if (isEscape) {
                    location.href = "impressao_imprimir.php";
                }
            };
            </script>


        </div>
    </div>


</body>

</html>