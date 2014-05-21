<?php
if($_POST["acao"] == "sair"){
	

	session_start();
	session_destroy();
	session_unset();
	
	echo "ok"; 

}

?>