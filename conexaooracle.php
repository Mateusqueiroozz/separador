<?php
$orauser = "INTEGRA";
$orasenha = "INTEGRA";

$orabd = "(DESCRIPTION =
   		(ADDRESS_LIST =
			(ADDRESS = (PROTOCOL = TCP)(Host = 192.168.254.220)(Port = 1521))
   		)
 		(CONNECT_DATA =
   			(SERVICE_NAME = CEPRD)
		)
	)";

/* if ($conexao = oci_connect($orauser, $orasenha, $orabd)) {
	//echo "conectado";
} */

$conn = oci_connect($orauser, $orasenha, $orabd);
if (!$conn) {
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
} else {
	//echo "conectado";
}