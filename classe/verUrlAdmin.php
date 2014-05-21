<?php
/*******************************************
**	CLASSE DE INCLUSÃO DE PÁGINAS
**	MÉTODO - trocarURL($url)
**	ESTA CLASSE FAZ A TROCA DE PÁGINAS NA INDEX
********************************************/
class verURL{
	function trocarURL($url){
		if(empty($url)){
			$url = "telas/home.php";
		}else{
			$url = "telas/$url.php";
		}
		include_once($url);
	}
}
?>