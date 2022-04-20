<?php
session_start();

$sessao = session_id();

include('conexao.php');

$sessao = session_id();
$impressora = $_SESSION['impressora'];


//gqwerasd 




?>


<!DOCTYPE html> 
<html> 
<head> 
	<title>Selecionar Impressora</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
	<script src="js/jquery.js"></script>
	<script src="js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
</head> 
<body> 
			<div class="ui-corner-all custom-corners">
				
			
			
				<div class="ui-corner-all custom-corners">
						<div class="ui-bar ui-bar-a" style="text-align:center; color:red; height:40px; line-height:40px">O que deseja fazer?</div>
				</div>
				<div class="confirma" style="text-align:center">
					<a href="impressao_limpar.php" onclick="adiciona.submit();" data-ajax="false" style="background-color:red;color:white;font-weight: normal;" class="ui-btn ui-btn-inline  ">Apagar tudo e recomeçar</a>
                    
                    
					<a href="index.php" data-ajax="false" style="background-color:green;color:white;font-weight: normal;" class="ui-btn ui-btn-inline ">Voltar para ultimas impressões</a>
					
										
					
					
						<script type="text/javascript">
					$(document).keypress(function(e) {
						if(e.which == 13) {
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