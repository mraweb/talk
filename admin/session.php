<?php
ob_start();

error_reporting("E_ALL");

session_cache_limiter("public");
session_cache_expire(0);

session_start();
$_SESSION['xx'] = true;

if($_SESSION['xx']){

echo "sessao gravada...: ".$_SESSION['xx'];

echo $_SESSION['TESTE'];

} else{

echo "Nao esta Configurado...";

$_SESSION['TESTE'] = "Escreva teste na tela";

}

?>