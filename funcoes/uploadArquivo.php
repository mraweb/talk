<?php
 
function upload_arquivo($foto,$arquivoName,$arquivoTemp){
	$caminhoArquivo = '../upload/arquivos'; 

	// Pega as dimensão da imagem
	//$dimensoes = getimagesize($foto["tmp_name"]);
    //echo $dimensoes[0].'=='.$dimensoes[1]; 
    
    //if($dimensoes[0]==$_POST["tamanhoW"] && $dimensoes[1]==$_POST["tamanhoH"]){
    	$data = date("dmYHis");
		$file = $data.'_'.criarSlug($arquivoName);
    	$caminho_arquivo = $caminhoArquivo."/". $file;
    	
	
		//a funcao php move_uploaded_file copia os arquivos enviados para o caminho que voc� desejar 
		if (move_uploaded_file($arquivoTemp, $caminho_arquivo)) { 
		  	$resp = $file;
		} else {
			$resp = "erro upload";//em caso de erro na copia do arquivo reposta vai ter o valor 'erro'
		}
		
    //}else{
    	//$resp = "tamanho incorreto";
    //}

    return $resp;	
}


function upload_arquivo_original($foto,$arquivoName,$arquivoTemp,$nameFileOriginal){

		$caminho_arquivo = '../uploadTemp/imagem/'.$nameFileOriginal;
	
		//a funcao php move_uploaded_file copia os arquivos enviados para o caminho que voc� desejar 
		if (move_uploaded_file($arquivoTemp, $caminho_arquivo)) { 
		  	$resp = $file;
		} else {
			$resp = "erro upload";//em caso de erro na copia do arquivo reposta vai ter o valor 'erro'
		}

    return $resp;	
}

function upload_img_full($foto,$arquivoName,$arquivoTemp,$nameFileOriginal){

		$caminho_arquivo = '../uploadTemp/img_full/'.$nameFileOriginal;
	
		//a funcao php move_uploaded_file copia os arquivos enviados para o caminho que voc� desejar 
		if (move_uploaded_file($arquivoTemp, $caminho_arquivo)) { 
		  	$resp = $file;
		} else {
			$resp = "erro upload";//em caso de erro na copia do arquivo reposta vai ter o valor 'erro'
		}

    return $resp;	
}