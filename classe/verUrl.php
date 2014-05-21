<?php
/*******************************************
**	CLASSE
**	METODO - trocarURL($url)
**	ESTA CLASSE FAZ A TROCA DE PAGINAS NA INDEX
********************************************/
class verURL{
	function trocarURL($url,$idImprensa,$idNoticia,$idServico,$idCategoriaServico,$idProgramacao,$idEntrevista){
		$url = explode('/', $url);

		if($url[0]=="programas" && $idServico > 0 && $idCategoriaServico > 0 && $idProgramacao > 0){
			$conteudo = "sub-categoria.php";
		}elseif($url[0]=="programas" && $idServico > 0 && $url[2]!="" && $idCategoriaServico > 0){
			$conteudo = "categoria.php";
		}elseif($url[0]=="programas" && $url[1]!="" && $idServico > 0){
			$conteudo = "talkradio.php";
		}elseif($url[0]=="noticia" && $url[1]!="" && $idNoticia > 0){
			$conteudo = "noticia-detalhe.php";
		}elseif($url[0]=="imprensa" && $url[1]!="" && $idImprensa > 0){
			$conteudo = "imprensa-detalhe.php";
		}elseif($url[0]=="talkradioshow"){
			if($url[1]=="entrevista" && $idEntrevista > 0)
				$conteudo = "talkradioshow/entrevista-detalhe.php";
			elseif($url[1]=="")
				$conteudo = "talkradioshow/index.php";
			else
				$conteudo = "talkradioshow/".$url[1].".php";
		}elseif($url[0]){
			$conteudo = $url[0].".php";
		}

		//verifico se o arquivo exite
		if(!file_exists($conteudo)) {
			$conteudo = "404.php";
		}

		include_once($conteudo);
		
	}
}
?>
