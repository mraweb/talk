<?php 
session_start();
require_once('UploadImage.php');
require_once('geral.php');
require_once('../classe/upload.class.php');
require_once('uploadArquivo.php');

$caminho = '../uploadTemp/'; 

if($_REQUEST['valor1']=="imagem"){
	$i = $_REQUEST['posicao']; 
	if($_FILES['arquivo_'.$i]){

		$foto = $_FILES['arquivo_'.$i];
		//Pega size da imagem
		$filesize = ($_FILES['arquivo_'.$i]["size"] / 1024);
		
		// Pega as dimensao da imagem
		$dimensoes = getimagesize($foto["tmp_name"]);
    	
		//($dimensoes[0] >= 172 && $dimensoes[1] >= 172 )
		
	    //if($filesize <= 700){

	    	$diretorio1 = $caminho.'img_small/'; //pequena
	    	$diretorio2 = $caminho.'img_medium/'; //médio
	    	$diretorio3 = $caminho.'img_large/'; //grande
	    	
	    	$codigo = RandomPass("8");
	    	
	    	$up = new upload($foto, $diretorio1, $codigo);
			//$up->img_marca = 'teste.png';		// caminho da imagem que sera marca d'agua (.png)
			$up->largura   = $_REQUEST['tamanhoSmall'];			// maxima largura para a nova foto
			$up->altura    = $_REQUEST['tamanhoSmall'];			// maxima altura para a nova foto
			$nomeImagemPeq = $up->enviaArquivo();		// execucao do metodo
			
			$up = new upload($foto, $diretorio2, $codigo);
			//$up->img_marca = 'teste.png';		// caminho da imagem que sera marca d'agua (.png)
			$up->largura   = $_REQUEST['tamanhoMedium'];			// maxima largura para a nova foto
			$up->altura    = $_REQUEST['tamanhoMedium'];			// maxima altura para a nova foto
			$up->enviaArquivo();		// execucao do metodo
			
			$up = new upload($foto, $diretorio3, $codigo);
			//$up->img_marca = 'teste.png';		// caminho da imagem que sera marca d'agua (.png)
			$up->largura   = $_REQUEST['tamanhoLarge'];			// maxima largura para a nova foto
			$up->altura    = $_REQUEST['tamanhoLarge'];			// maxima altura para a nova foto
			$up->enviaArquivo();		// execucao do metodo
			
			
			//upload do arquivo original da galeria fotos----------------------------------
				$nomeImagemGde = str_replace("small", "full", $nomeImagemPeq);
				//$fileOriginal = $diretorio2.'/'.$nomeImagemGde;
				if($_FILES['arquivo_'.$i]['name']){
					$arquivo = $_FILES['arquivo_'.$i];
		 			$arquivoName = $_FILES['arquivo_'.$i]['name'];
		 			$arquivoTemp = $_FILES['arquivo_'.$i]['tmp_name'];
					$arquivo1 = upload_img_full($arquivo, $arquivoName, $arquivoTemp, $nomeImagemGde);
					//if($arquivo1 != "erro upload") 
						//$nomeImagemPeq = $arquivo1;

				}
				
			//------------------------------------------------------------------------------
	    	
	    	echo $nomeImagemPeq;

	    //}else{
	    	//echo "tamanho incorreto";
	    //}

	}
}

?>