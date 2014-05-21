<?php
error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include_once("../funcoes/geral.php");
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>Talk Rádio - Gerenciamento de Conteúdo</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/colors.css">
<link rel="stylesheet" type="text/css" href="css/structure.css">
<link rel="stylesheet" type="text/css" href="css/sc-player-artwork.css">
<link rel="stylesheet" type="text/css" href="css/jquery.click-calendario-1.0.css">
<script type="text/javascript" src="js/ajaxupload.3.5.js"></script><!-- upload -->

<script src="ckeditor/ckeditor.js"></script>

<!--[if ie]>
	<script type="text/javascript" src="js/html5-ie.js"></script>
<![endif]-->
<script type="text/javascript" src="js/jquery-1.7.min.js"></script>
</head>
<body itemscope itemtype="http://schema.org/WebPage">
<?php include "header.php"; ?>

	<?php
	/** Monto o formulario da pagina **/
	include_once("../classe/verUrlAdmin.php");

	if(isset($_GET["telas"]))
		$telas = $_GET["telas"];
	else
		$telas = "";
		
	$url = new verURL();
	$url->trocarURL($telas);
	?>


<script type="text/javascript" src="js/sc-player.js"></script>
<script type="text/javascript" src="js/soundcloud.player.api.js"></script>
<script type="text/javascript" src="js/jquery.infieldlabel.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/jquery.click-calendario-1.0-min.js"></script><!-- calendario -->		
<script type="text/javascript" src="js/exemplo-calendario.js"></script><!-- calendario -->
<script type="text/javascript" src="js/jquery.limit-1.2.source.js"></script><!-- limit textarea -->
</body>
</html>
