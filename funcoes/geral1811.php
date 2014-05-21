<?php
function RandomPass($numchar){  
   $letras = "A,B,C,D,E,F,G,H,I,J,K,1,2,3,4,5,6,7,8,9,0";  
   $array = explode(",", $letras);  
   shuffle($array);  
   $senha = implode($array, "");  
   return substr($senha, 0, $numchar);  
} 

function gravarValorMoeda($valor){
	$valor = str_replace(",",".",str_replace(".","",$valor));
	
	return $valor; 
}

function criarSlugx($texto) {
  $texto = str_replace('p/', 'para', $texto);
  $texto = strtolower(removeAcentos($texto));
  return $texto;
}

function criarSlug($texto){
	$trocarIsso = array('à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','O','Ù','Ü','Ú','Ÿ',' ','+','/','%');
	$porIsso = array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','O','U','U','U','Y','-','-','-','-');
	$titletext = trim(strtolower(str_replace($trocarIsso, $porIsso, $texto)));
	return $titletext;
}


function gravaLogs($idRegistro,$datacadastro){

	$browser = BROWSER;
	$ip = IP;

	$cad = new ManipulateData();
	$cad->setTable("logs");
	$cad->setFields("usuario_id,dataCadastro,browser,ip");
	$cad->setDados("'$idRegistro','$datacadastro','$browser','$ip'");
	$cad->insert();

}



function converteData($data){
	if (strstr($data, "/")){
		$A = explode ("/", $data);
		$V_data = $A[2] . "-". $A[1] . "-" . $A[0];
	}
	else{
		$A = explode ("-", $data);
		$V_data = $A[2] . "/". $A[1] . "/" . $A[0];	
	}
	return $V_data;
}

function addDiasData ($data,$dias){

	$data = explode ("-", $data);
	$dia = $data[2];
	$mes = $data[1];
	$ano = $data[0];
	$proxima_data = mktime(0, 0, 0, date($mes), date($dia) + $dias, date($ano));
	$proxima_data = converteData(date("d/m/Y", $proxima_data));
	
	
	return $proxima_data;
}

// VERFICA CNPJ
function validaCNPJ($cnpj) {

      if (strlen($cnpj) <> 14)
         return false;
 
      $soma = 0;
      
      $soma += ($cnpj[0] * 5);
      $soma += ($cnpj[1] * 4);
      $soma += ($cnpj[2] * 3);
      $soma += ($cnpj[3] * 2);
      $soma += ($cnpj[4] * 9);
      $soma += ($cnpj[5] * 8);
      $soma += ($cnpj[6] * 7);
      $soma += ($cnpj[7] * 6);
      $soma += ($cnpj[8] * 5);
      $soma += ($cnpj[9] * 4);
      $soma += ($cnpj[10] * 3);
      $soma += ($cnpj[11] * 2);

      $d1 = $soma % 11;
      $d1 = $d1 < 2 ? 0 : 11 - $d1;

      $soma = 0;
      $soma += ($cnpj[0] * 6);
      $soma += ($cnpj[1] * 5);
      $soma += ($cnpj[2] * 4);
      $soma += ($cnpj[3] * 3);
      $soma += ($cnpj[4] * 2);
      $soma += ($cnpj[5] * 9);
      $soma += ($cnpj[6] * 8);
      $soma += ($cnpj[7] * 7);
      $soma += ($cnpj[8] * 6);
      $soma += ($cnpj[9] * 5);
      $soma += ($cnpj[10] * 4);
      $soma += ($cnpj[11] * 3);
      $soma += ($cnpj[12] * 2);
      
      
      $d2 = $soma % 11;
      $d2 = $d2 < 2 ? 0 : 11 - $d2;
      
      if ($cnpj[12] == $d1 && $cnpj[13] == $d2) {
         //return true;
         $resp = "cnpj vÃ¡lido";
         return $resp;
      }
      else {
         //return false;
          $resp = "cnpj invÃ¡lido";
         	return $resp;
      }
}

function monthCalculate($date, $numeroMeses){
	//separa o dia, mÃªs e ano e joga para uma array<em>
	 $arr = explode('-',$date);
	 $dia = $arr[2];
	 $mes = $arr[1];
	 $ano = $arr[0];
	 
	 /*Verifico se o dia informado Ã© igual a 31, se sim volto para 30.
	Verifico se o mes Ã© fevereiro, se sim volto para 28 e somente
	depois somo os meses a data */
	 if($dia == 31)
	 {
	 $dia = 30;
	 }
	 if(($mes + $numeroMeses == 14 or $mes + $numeroMeses == 2) && $dia > 28)
	 {
	 $dia = 28;
	 }
	 
	 $date = $ano."-".$mes."-".$dia;
	 $begin = strtotime($date);
	 $interval = date('m',$begin) + $numeroMeses;
	 return date('Y-m-d', mktime(0,0,0,$interval, date('d', $begin), date('Y', $begin)));
}

function replace($de, $para, $texto){

	  return $texto = str_replace($de, $para, $texto);
	  
}

function checkIdProduto($valor){

	//recupero id do produto 
	include_once 'classe/ManipulateData.php';
	$pes = new ManipulateData();
	$pes->setTable("produtos");
	$pes->setFieldId($valor);
	$pes->setFieldId2("nome");	
	$pes->setAtributo("id");
		if($pes->getUmValorTabela()=="")
			$idProd = 0;
		else 
			$idProd = $pes->getUmValorTabela();
	
	return $idProd; 
}


function deletaImagem($imgThumb){
	include_once("define.php");
	
		 $imgGde = str_replace("thumb", "imagem", $imgThumb);
		 
  		 $apagarThumb = "../upload/thumb/".$imgThumb;
  		 	@unlink($apagarThumb);
  		 $apagarGde = "../upload/imagem/".$imgGde;  		 
  		 	@unlink($apagarGde);
  		 
}

function deletaImagemTemp($imgThumb){
	include_once("define.php");
	
	$imgGde = str_replace("thumb", "imagem", $imgThumb);
		 
  	$apagarThumb = "../uploadTemp/thumb/".$imgThumb;
  	@unlink($apagarThumb);
  	$apagarGde = "../uploadTemp/imagem/".$imgGde;  		 
  	@unlink($apagarGde);
  		 
}

function deletaArquivo($arquivo){
	include_once("define.php");
		 
  	$apagarArquivo = "../upload/arquivos/".$arquivo;
  	@unlink($apagarArquivo);	 
}

function SizeImage($imagem){
	$tam_img = getimagesize($imagem);
	$width = $tam_img[0];
	$height = $tam_img[1];
	
	return $imageSize = $width.'|'.$height;
}