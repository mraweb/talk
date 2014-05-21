<?php
if(!$_SESSION['login']){

	if($url[0]=="meu-painel"){
		$redireciona = URL;
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$redireciona'>";
	}

}

if($_SESSION['idEmpresa']){ 
//|| $url[0]=="meu-painel" && $url[1]=="nova-empresa-finaliza"
	if($url[0]=="meu-painel" && $url[1]=="nova-empresa"){
		$redireciona = URL."meu-painel";
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$redireciona'>";
	}

}
?>