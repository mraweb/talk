<?php 

error_reporting (0);
if($url[0]=="admin"){
	include_once("../classe/MySqlConn.php");
	include_once("../classe/ManipulateData.php");
	include_once("../classe/CriaPaginacao.php");
}else{
	include_once("MySqlConn.php");
	include_once("ManipulateData.php");
	include_once("CriaPaginacao.php");
}

class Noticia extends CriaPaginacao{

	private $strCampoPesquisa, $strNumPagina, $strPaginas, $strUrl, $idPesquisa, $ordenacao, $coluna;
	public $frontEndBanner = false;

	public function setNumPagina($x){
		$this->strNumPagina = $x;
	}

	public function setUrl($x){
		$this->strUrl = $x;
	}
	
	public function setIdPesquisa($id){
		$this->idPesquisa = $id;
	}
	
	public function setOrdenacao($var){
		$this->ordenacao = $var;
	}
		
	public function setColuna($var){
		$this->coluna = $var;
	}

	public function setCampoPesquisa($x){
		$this->strCampoPesquisa = $x;
	}

	public function setId($id){
		$this->id = $id;
	}
	
	public function setIdImagem($id){
		$this->idImagem = $id;
	}
	
	public function setNomeArquivo($x){
		$this->nomeArquivo = $x;
	}
	
	public function setTypeNavegacao($x){
		$this->typeNavegacao = $x;
	}


	//------------------------------------------------------------------------------------------------------
	public function getPaginas(){
		return $this->strNumPagina = $x;
	}

	public function getIdAlteracao(){ 
		return $this->idAlteracao;
	}

	public function getTitulo(){ 
		return $this->titulo;
	}	

	public function getDescricao(){ 
		return $this->descricao;
	}
	
	public function getImagem(){
		return $this->imagem;
	}
	
	public function getDestaque(){ 
		return $this->destaque;
	}
	
	public function getDataEvento(){ 
		return $this->dataEvento;
	}

	public function getBanners(){
		return $this->banners;
	}

	//------------------------------------------------------------------------------------------------------

	//lista as noticias no admin
	public function geraLisNoticia(){ 
	
		$sql = "
			SELECT id,titulo,descricao,foto_capa,destaque,dataEvento
			FROM noticia
			WHERE dataExclusao IS NULL
		";
		if($this->strCampoPesquisa)
			$sql .= " AND titulo LIKE '%$this->strCampoPesquisa%'";
		//if($this->coluna)
			//$sql .= " ORDER BY $this->coluna $this->ordenacao";
		else	
		 	$sql .= " ORDER BY dataEvento Desc, id DESC";

		$this->setParametro($this->strNumPagina); //numero de pagina atual
		$this->setFileName($this->strUrl); // nome da pagina atual
		$this->setInfoMaxPag(20); // quantidade de produtos por tela
		$this->setMaximoLinks(10); //quantidade de links para a paginacao
		$this->setSQL($sql);
		self::iniciaPaginacao();
		$contador = 0; // contador para gerar o numero de paginas
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro
		if($qtRegistros > 0){
			while($dados = self::results()){
				$res = $contador % 2;
				$class = "";
				if($res==0){
					$class = 'class="cor"';
				}
				
				$destaque = "";
				if($dados['destaque']==1)
					$destaque = '<img src="img/tique.png" />';
					
				$dataEvento = converteData($dados["dataEvento"]);

				$contador ++;
				
				echo'
					<tr '.$class.'>
		            	<td>'.$dataEvento.'</td>
		                <td>'.$dados["titulo"].'</td>
		                <td class="tamanho1"><a href="?telas=nova-noticia&idAlteracao='.$dados["id"].'&acao=alterar"><img src="img/bteditar.png" width="55" height="17" /></a></td>
		                <td class="tamanho1"><a href="javascript:void(0);" class="excluirRegistro" id="'.$dados["id"].'"><img src="img/btexcluir.png" width="55" height="17" /></a></td>
		            </tr>
				';
				self::setContador($contador);
			}
		}
	}


	public function geraDadosIdNoticia(){
		$sql = "
			SELECT id,titulo,descricao,foto_capa,destaque,dataEvento
			FROM noticia
			WHERE dataExclusao IS NULL
			";

		if($this->id)
			$sql .= " AND id = ".$this->id;

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->idAlteracao = $dados["id"];
		$this->titulo = $dados["titulo"];
		$this->descricao = $dados["descricao"];
		$this->imagem = $dados["foto_capa"];
		$this->destaque = $dados["destaque"];
		$this->dataEvento = converteData($dados["dataEvento"]);

		/*
		//carregando banners
		if($this->id){
			$options = $this->frontEndBanner?'ORDER BY RAND() LIMIT 2 ':'LIMIT 7';
			$sql = "SELECT id,imagem,link
					FROM noticia_banner
					WHERE id_noticia=$this->id
					$options
				";
			$qr = self::execSql($sql);
			while($row = self::listQr($qr)){
				$this->banners[] = $row;
			}
		}
		*/
	}

	public function geraDadosBannerNoticia(){
	//carregando banners

			$sql = "SELECT id,imagem,link
					FROM noticia_banner
				";
			$qr = self::execSql($sql);
			while($row = self::listQr($qr)){
				$this->banners[] = $row;
			}
			
			return $this->banners;
	}
	
	public function geraDadosBannerNoticiaSite(){
	//carregando banners

			$sql = "SELECT id,imagem,link
					FROM noticia_banner
					ORDER BY RAND() LIMIT 2
				";
			$qr = self::execSql($sql);
			while($row = self::listQr($qr)){
				$this->banners[] = $row;
			}
			
			return $this->banners;
	}
	
	//exclui imagem temp
	public function excluirImagemTemp(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		deletaImagemTemp($this->nomeArquivo);//deleto arquivo
		
	}
	
	//exclui imagem
	public function excluirImagemUpdate(){ 
		
		$sql = " UPDATE noticia SET foto_capa = '' "; 
		if($this->id)
			$sql .=" WHERE id = '$this->id'";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");		
		deletaImagem($this->nomeArquivo);//deleto arquivo
		
	}
	//exclui imagem
	public function excluirImagemBanner($id){ 
		
		$sql = " DELETE FROM `noticia_banner` WHERE id=$id"; 

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");	
		$this->nomeArquivo = pathinfo($this->nomeArquivo, PATHINFO_BASENAME);
		deletaImagem($this->nomeArquivo);//deleto arquivo
		
	}
	
	//exclui imagem
	public function excluirImagem(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT foto_capa as thumb
			FROM noticia
		"; 
		if($this->id)
			$sql .=" WHERE id = '$this->id'";
			

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			while($lista = self::resultsAll($this->qr)){

				deletaImagem($lista["thumb"]);//deleto a imagem do arquivo
			
			}
		}
		
	}
	
	//lista noticias site
	public function getListAllNoticia(){ 
	
		$sql = "
			SELECT id,titulo,descricao,foto_capa,destaque,dataEvento
			FROM noticia
			WHERE dataExclusao IS NULL
		";
		//if($this->strCampoPesquisa)
			//$sql .= " AND titulo LIKE '%$this->strCampoPesquisa%'";
		//if($this->coluna)
			//$sql .= " ORDER BY $this->coluna $this->ordenacao";
		//else	
		 	$sql .= " ORDER BY dataEvento DESC, id DESC";
	

		$this->setParametro($this->strNumPagina); //numero de pagina atual
		$this->setFileName($this->strUrl); // nome da pagina atual
		$this->setInfoMaxPag(3); // quantidade de produtos por tela
		$this->setMaximoLinks(10); //quantidade de links para a paginacao
		$this->setSQL($sql);
		self::iniciaPaginacao();
		$contador = 0; // contador para gerar o numero de paginas
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro
		if($qtRegistros > 0){
			while($dados = self::results()){
				$caminhoImagem = URL.'upload/thumb/'.$dados["foto_capa"];
				$link = URL.'noticia/'.criarSlug($dados["titulo"]);
				$contador ++;

				$exibirImagem = "";
				if($dados["foto_capa"]){
					$exibirImagem = '<img src="'.$caminhoImagem.'" alt="'.$dados["titulo"].'" width="155" height="164" class="img-left" />';
				}
				
				echo'
					<section class="box-noticias">
		            	'.$exibirImagem.'
		                
		                <div>
		                	<h2><a href="'.$link.'" title="'.$dados["titulo"].'">'.$dados["titulo"].'</a></h2>
		                    
		                    <p>'.nl2br(substr($dados['descricao'], 0, 300)).'...</p>
		                    
		                    <p class="ver">Ver notícia inteira &raquo;</p>
		                </div>
		            </section>
				';
				self::setContador($contador);
			}
		}
	}
	
	public function getListNoticiaHome(){ 
	
		$sql = "
			SELECT id,titulo,descricao,foto_capa,destaque,dataEvento
			FROM noticia
			WHERE dataExclusao IS NULL
			ORDER BY dataEvento DESC, id DESC
			";

		$this->setParametro($this->strNumPagina); //numero de pagina atual
		$this->setFileName($this->strUrl); // nome da pagina atual
		$this->setInfoMaxPag(2); // quantidade de produtos por tela
		$this->setMaximoLinks(10); //quantidade de links para a paginacao
		$this->setSQL($sql);
		self::iniciaPaginacao();
		$contador = 0; // contador para gerar o numero de paginas
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro
		if($qtRegistros > 0){
			while($dados = self::results()){

				$link = URL.'noticia/'.criarSlug($dados["titulo"]);
				$contador ++;
				
				echo'
		            <section class="box-noti">
	                    <h3><a href="'.$link.'" title="'.$dados["titulo"].'">'.$dados["titulo"].'</a></h3>
	
	                    <p>'.nl2br(substr($dados['descricao'], 0, 180)).' <strong>[...]</strong></p>
                	</section>
				';
				self::setContador($contador);
			}
		}
	}
	
	public function totalRegistros(){ 

		$sql = "
			SELECT id,titulo,descricao,foto_capa,destaque,dataEvento
			FROM noticia
			WHERE dataExclusao IS NULL
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro

		return $qtRegistros;

	}
	
	public function retornaProxNoticia(){ 

		$sql = "
			SELECT id,titulo,descricao,foto_capa,destaque,dataEvento
			FROM noticia
			WHERE dataExclusao IS NULL
		";
		if($this->typeNavegacao == "pro")
			$sql .= " AND id > $this->id";
		if($this->typeNavegacao == "ant")
			$sql .= " AND id < $this->id ORDER BY id DESC";
			
		$sql .= " LIMIT 1";

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		return $dados["titulo"];

	}
	
	public function excluirImagemGaleria(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT imagem
			FROM noticia_banner
		"; 
		if($this->idImagem)
			$sql .=" WHERE id = '$this->idImagem'";
			
		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			while($lista = self::resultsAll($this->qr)){

				deletaImagem($lista["imagem"]);//deleto a imagem do arquivo
			
			}
		}

	}

	

}

//------acoes------------------------------------------------------------------------------------------------------

	//cadastrar o registro
	if(isset($_POST["cadastrar"])){
		include_once("../funcoes/geral.php");
		//recupera os valores do formulario
		$dataEvento = converteData($_POST["dataEvento"]);
		$titulo = addslashes($_POST["titulo"]);
		$destaque = isset($_POST["destaque"])?$_POST["destaque"]:0;
		$descricao = addslashes($_POST["descricao"]);
		$dataCadastro = date("Y-m-d H:m:s");
		

		$nomeArquivo = $_REQUEST['nomeArquivoTemp'];
		//se a imagem existir
		if($nomeArquivo){

			 //$descricaoImagem = $_REQUEST['descricaoImagem'];
			 $imgThumb = $nomeArquivo;
			 $imgGde = str_replace("thumb", "imagem", $nomeArquivo);
			 
			 $imgThumb = str_replace('<div id="isChormeWebToolbarDiv" style="display: none;"></div>', '', $imgThumb);
		 	 $imgGde = str_replace('<div id="isChormeWebToolbarDiv" style="display: none;"></div>', '', $imgGde);
	
			 $deThumb = "../uploadTemp/thumb/".$imgThumb;
	  		 $paraThumb = "../upload/thumb/".$imgThumb;
	  		 copy($deThumb, $paraThumb);
	  		 @unlink($deThumb);
	  		 
	  		 $deGde = "../uploadTemp/imagem/".$imgGde;
	  		 $paraGde = "../upload/imagem/".$imgGde;
	  		 copy($deGde, $paraGde);
	  		 @unlink($deGde);
		}
		
	
		//instanciando o objeto de cadastro
		$cad = new ManipulateData();
		$cad->setTable("noticia");
		$cad->setFields("titulo,descricao,foto_capa,destaque,dataEvento,dataCadastro");
		$cad->setDados("'$titulo','$descricao','$imgThumb','$destaque','$dataEvento','$dataCadastro'");
		$cad->insert();

		$erro = base64_encode($cad->getStatus());
/*
		if($cad->getStatus() == "Cadastrado com Sucesso!!!"){

			$cad->getLastId();
			$cad->setTable("noticia_banner");
			$cad->setFields("id_noticia,imagem,link");

			$dados = array();
			foreach($_POST['banner'] as $banner){

				 //$descricaoImagem = $_REQUEST['descricaoImagem'];
				 $imgThumb = $banner['img'];
				 $imgGde = str_replace("thumb", "imagem", $banner['img']);
		
				 $deThumb = "../uploadTemp/thumb/".$imgThumb;
		  		 $paraThumb = "../upload/thumb/".$imgThumb;
		  		 copy($deThumb, $paraThumb);
		  		 @unlink($deThumb);
		  		 
		  		 $deGde = "../uploadTemp/imagem/".$imgGde;
		  		 $paraGde = "../upload/imagem/".$imgGde;
		  		 copy($deGde, $paraGde);
		  		 @unlink($deGde);

		  		 if(filter_var($banner['link'],FILTER_VALIDATE_URL)){
		  		 	$link = $banner['link'];
		  		 }

				$dados[] = "{$cad->getLastId()},'$paraGde','$link'";
			}

			$cad->setDados($dados);
			$cad->insert();
		}
*/
		

	$urlRedirecionamento = '../admin/?telas=nova-noticia&msn='.$erro;
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
	}
	//alterar o registro
	if(isset($_POST["alterar"])){
		include_once("../funcoes/geral.php");
		//recupera os valores do formulario
		$idAlteracao = $_POST["idAlteracao"];
		$dataEvento = converteData($_POST["dataEvento"]);
		$titulo = addslashes($_POST["titulo"]);
		$destaque = isset($_POST["destaque"])?$_POST["destaque"]:0;
		$descricao = addslashes($_POST["descricao"]);
		$dataAlteracao = date("Y-m-d H:i:s");
		

		$nomeArquivo = $_POST['nomeArquivoTemp'];
		//se a imagem nao existir
		if($nomeArquivo){

			 //$descricaoImagem = $_REQUEST['descricaoImagem'];
			 $imgThumb = $nomeArquivo;
			 $imgGde = str_replace("thumb", "imagem", $nomeArquivo);
			 
			 $imgThumb = str_replace('<div id="isChormeWebToolbarDiv" style="display: none;"></div>', '', $imgThumb);
		 	 $imgGde = str_replace('<div id="isChormeWebToolbarDiv" style="display: none;"></div>', '', $imgGde);
	
			 $deThumb = "../uploadTemp/thumb/".$imgThumb;
	  		 $paraThumb = "../upload/thumb/".$imgThumb;
	  		 copy($deThumb, $paraThumb);
	  		 @unlink($deThumb);
	  		 
	  		 $deGde = "../uploadTemp/imagem/".$imgGde;
	  		 $paraGde = "../upload/imagem/".$imgGde;
	  		 copy($deGde, $paraGde);
	  		 @unlink($deGde);
		}
		
	
		//instanciando o objeto de alteracao
		$alt = new ManipulateData();
		$alt->setTable("noticia");//envio o nome da tabela
		//enviando os atributos do banco
		$alt->setFields("titulo='$titulo', descricao='$descricao', destaque='$destaque', dataEvento='$dataEvento', dataAlteracao='$dataAlteracao'");
		//envio o campo de referente ao id de alteracao
		$alt->setFieldId("id");
		//envio o valor de referente ao id de alteracao
		$alt->setValueId($idAlteracao);
		//efetuando a alteracao
		$alt->update();
		$erro = base64_encode($alt->getStatus());
		
		if($nomeArquivo){
			//enviando os atributos do banco
			$alt->setFields("foto_capa='$imgThumb'");
			//envio o campo de referente ao id de alteracao
			$alt->setFieldId("id");
			//envio o valor de referente ao id de alteracao
			$alt->setValueId($idAlteracao);
			//efetuando a alteracao
			$alt->update();
			base64_encode($alt->getStatus());
		}
/*
		if(isset($_POST['banner_link'])){
			foreach($_POST['banner_link'] as $id=>$banner){
				if(filter_var($banner,FILTER_VALIDATE_URL)){
					$alt->setTable("noticia_banner");
					$alt->setFields("link='{$banner}'");
					$alt->setValueId($id);
					$alt->update();
				}
			}
		}

		if(isset($_POST['banner'])){

			$alt->setTable("noticia_banner");
			$alt->setFields("id_noticia,imagem,link");

			$dados = array();
			foreach($_POST['banner'] as $banner){

				 //$descricaoImagem = $_REQUEST['descricaoImagem'];
				 $imgThumb = $banner;
				 $imgGde = str_replace("thumb", "imagem", $banner['img']);
		
				 $deThumb = "../uploadTemp/thumb/".$imgThumb;
		  		 $paraThumb = "../upload/thumb/".$imgThumb;
		  		 copy($deThumb, $paraThumb);
		  		 @unlink($deThumb);
		  		 
		  		 $deGde = "../uploadTemp/imagem/".$imgGde;
		  		 $paraGde = "../upload/imagem/".$imgGde;
		  		 copy($deGde, $paraGde);
		  		 @unlink($deGde);

		  		 $link = 'NULL';

		  		 if(filter_var($banner['link'],FILTER_VALIDATE_URL)){
		  		 	$link = $banner['link'];
		  		 }

				$dados[] = "$idAlteracao,'$paraGde','$link'";
			}

			$alt->setDados($dados);
			$alt->insert();
		}
*/
		$urlRedirecionamento = '../admin/?telas=nova-noticia&idAlteracao='.$idAlteracao.'&acao=alterar&msn='.$erro;
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
	}
	
	if(isset($_POST["banners"])){
		
			if(isset($_POST['banner_link'])){
				$alt = new ManipulateData();
				
				foreach($_POST['banner_link'] as $banner){
					if($banner['id']){
						$alt->setTable("noticia_banner");
						$alt->setFields("link='{$banner['link']}'");
						$alt->setFieldId("id");
						$alt->setValueId($banner['id']);
						$alt->update();	
					}
				}
			}
		
			if($_POST['banner']){
				$cad = new ManipulateData();
				$cad->setTable("noticia_banner");
				$cad->setFields("imagem,link");
	
				$dados = array();
				
					foreach($_POST['banner'] as $banner){
						if($banner['img']){
							 //$descricaoImagem = $_REQUEST['descricaoImagem'];
							 $imgThumb = $banner['img'];
							 $imgGde = str_replace("thumb", "imagem", $banner['img']);
					
							 $deThumb = "../uploadTemp/thumb/".$imgThumb;
					  		 $paraThumb = "../upload/thumb/".$imgThumb;
					  		 copy($deThumb, $paraThumb);
					  		 @unlink($deThumb);
					  		 
					  		 $deGde = "../uploadTemp/imagem/".$imgGde;
					  		 $paraGde = "../upload/imagem/".$imgGde;
					  		 copy($deGde, $paraGde);
					  		 @unlink($deGde);
					  		 
					  		 $link = $banner['link'];
					  		 
			
							$dados[] = "'$paraGde','$link'";
						}
					}
				
	
				$cad->setDados($dados);
				$cad->insert();
			}
			
			
			$urlRedirecionamento = '../admin/?telas=banner-noticias';
			echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
		
		
	}
	
	//excluir o registro
	if(isset($_POST['id'])){

		$itemExclusao = $_POST['id'];
		
		//deleta imagens da noticia
			$conteudo = new Noticia();
			$conteudo->setId($itemExclusao);
			$conteudo->excluirImagem();
	
		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("noticia");
		//envio o campo de referente ao id de exclusao
		$exc->setFieldId("id");
		//envio o valor de referente ao id de exclusao
		$exc->setValueId($itemExclusao);
		//efetuando a exclusao
		$exc->delete();
		echo $erro = $exc->getStatus();
	}
		
	if($_POST['acao']=="excluirImagemTemp"){
		$arquivoTemp = $_POST['arquivoTemp'];
		$exc = new Noticia();
		//envio o nome da tabela
		$exc->setNomeArquivo($arquivoTemp);
		$exc->excluirImagemTemp();
	}
	
	if($_POST['acao']=="excluirImagemUpdate"){
		$arquivo = $_POST['arquivo'];
		$exc = new Noticia();
		//envio o nome da tabela
		$exc->setNomeArquivo($arquivo);
		$exc->excluirImagemUpdate();
	}

	if($_POST['acao']=="excluirImagemBanner"){
		$id = $_POST['idBanner'];
		$arquivo = $_POST['arquivo'];
		$exc = new Noticia();
		//envio o nome da tabela
		$exc->setNomeArquivo($arquivo);
		$exc->excluirImagemBanner($id);
	}
	
	if($_POST['acao']=="excluirImagemGaleria"){
		echo $idImagem = $_POST['idImagem'];
		$exc = new Noticia();
		//envio o nome da tabela
		$exc->setidImagem($idImagem);
		$exc->excluirImagemGaleria();
		
		//deleto o registro	
			//instanciando o objeto de exclusao
			$exc = new ManipulateData();
			//envio o nome da tabela
			$exc->setTable("noticia_banner");
			//envio o campo de referente ao id de exclusao
			$exc->setFieldId("id");
			//envio o valor de referente ao id de exclusao
			$exc->setValueId($idImagem);
			//efetuando a exclusao
			$exc->delete();
		
	}
	

?>
