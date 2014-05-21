<?php 
session_start();
require_once('geral.php');
require_once('../classe/upload.class.php');

$caminho = '../uploadTemp/'; 


if($_REQUEST['valor1']=="imagem"){

	if($_FILES['arquivo']){

		$foto = $_FILES['arquivo'];
		// Pega as dimensao da imagem
		$dimensoes = getimagesize($foto["tmp_name"]);
    	
	    //if($dimensoes[0] >= 172 && $dimensoes[1] >= 172 ){
	    	
	    	$diretorio1 = $caminho.'thumb/';
	    	$diretorio2 = $caminho.'imagem/';
	    	$filesArquivo = str_replace('<div id="isChormeWebToolbarDiv" style="display: none;"></div>', '', $_FILES['arquivo']);
	    	
	    	$up = new upload($filesArquivo, $diretorio1, 'thumb');
			//$up->img_marca = 'teste.png';		// caminho da imagem que sera marca d'agua (.png)
			$up->largura   = $_REQUEST['tamanhoMin'];			// maxima largura para a nova foto
			$up->altura    = $_REQUEST['tamanhoMin'];			// maxima altura para a nova foto
			$nomeImagemPeq = $up->enviaArquivo();		// execucao do metodo
			
			$up2 = new upload($filesArquivo, $diretorio2, 'imagem');
			//$up->img_marca = "teste.png";		// caminho da imagem que sera marca d'agua (.png)
			$up2->largura   = $_REQUEST['tamanhoMax'];			// maxima largura para a nova foto
			$up2->altura    = $_REQUEST['tamanhoMax'];			// maxima altura para a nova foto
			$up2->enviaArquivo();	// execucaoo do metodo
	    	
	    	echo $nomeImagemPeq;

	    //}else{
	    	//echo "tamanho incorreto";
	    //}

	}
}
?>