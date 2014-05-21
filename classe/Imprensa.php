<?php 
if($url[0]=="admin"){
	include_once("../classe/MySqlConn.php");
	include_once("../classe/ManipulateData.php");
	include_once("../classe/CriaPaginacao.php");
}else{
	include_once("MySqlConn.php");
	include_once("ManipulateData.php");
	include_once("CriaPaginacao.php");
}

class Impresa extends CriaPaginacao{

	private $strCampoPesquisa, $strNumPagina, $strPaginas, $strUrl, $idPesquisa, $ordenacao, $coluna;
	
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

	//------------------------------------------------------------------------------------------------------

	//lista as imprensa no admin
	public function geraLisImprensa(){ 
	
		$sql = "
			SELECT id,titulo,descricao,foto_capa,destaque,dataEvento
			FROM imprensa
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
		                <td class="tamanho1"><a href="?telas=nova-reportagem&idAlteracao='.$dados["id"].'&acao=alterar"><img src="img/bteditar.png" width="55" height="17" /></a></td>
		                <td class="tamanho1"><a href="javascript:void(0);" class="excluirRegistro" id="'.$dados["id"].'"><img src="img/btexcluir.png" width="55" height="17" /></a></td>
		            </tr>
				';
				self::setContador($contador);
			}
		}
	}


	public function geraDadosIdImprensa(){
		$sql = "
			SELECT id,titulo,descricao,foto_capa,destaque,dataEvento
			FROM imprensa
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
		$this->dataEvento = converteData($dados["dataEvento"]);;
	}	
	
	//lista imagens
	public function geraImagensImprensa(){ 
	
		$sql = "	
			SELECT i.id, i.thumb, i.imagem
			FROM imprensa_imagem AS i
			WHERE i.imprensa_id = $this->id
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		$i = 1;
		while($lista = self::resultsAll($this->qr)){

			if($lista['imagem']){
				$caminhoImagemCheck = URL.'upload/imagem/'.$lista['imagem'];

				//if(file_exists($caminhoImagemCheck)){
				  $caminhoImagem = URL.'upload/imagem/'.$lista['imagem'];
				  $caminhoImagemThumb = URL.'upload/thumb/'.$lista['thumb'];

				  echo'
				  	<li id="li_'.$lista['id'].'"><img src="'.$caminhoImagemThumb.'" width="55" height="50" /><a href="javascript:void(0);" id="'.$lista['id'].'" class="excluirImagemGaleria"><img src="img/btexcluir.png" width="55" height="17" ></a></li>
				  ';
				//}
			}
			
		$i++;
		}
	}
	
	//exclui imagem temp
	public function excluirImagemTemp(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		deletaImagemTemp($this->nomeArquivo);//deleto arquivo
		
	}
	
	//exclui imagem
	public function excluirImagemUpdate(){ 
		
		$sql = " UPDATE imprensa SET foto_capa = '' "; 
		if($this->id)
			$sql .=" WHERE id = '$this->id'";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");		
		deletaImagem($this->nomeArquivo);//deleto arquivo
		
	}
	
	//exclui imagem
	public function excluirImagem(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT foto_capa as thumb
			FROM imprensa
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
	
	//exclui imagem da galeria
	public function excluirImagemGaleria(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT thumb
			FROM imprensa_imagem
		"; 
		if($this->idImagem)
			$sql .=" WHERE id = '$this->idImagem'";
			
		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			while($lista = self::resultsAll($this->qr)){

				deletaImagem($lista["thumb"]);//deleto a imagem do arquivo
			
			}
		}

	}
	
	//lista imprensa
	public function getListAllImprensa(){ 
	
		$sql = "
			SELECT id,titulo,descricao,foto_capa,destaque,dataEvento
			FROM imprensa
			WHERE dataExclusao IS NULL
		";
		//if($this->strCampoPesquisa)
			//$sql .= " AND titulo LIKE '%$this->strCampoPesquisa%'";
		//if($this->coluna)
			//$sql .= " ORDER BY $this->coluna $this->ordenacao";
		//else	
		 	$sql .= " ORDER BY id DESC";
	

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
				$caminhoImagem = URL.'upload/arquivos/'.$dados["imagem"];
				$link = URL.'imprensa/'.criarSlug($dados["titulo"]);
				$contador ++;

				
				echo'
					<section class="box-imprensa">
		                <h2><a href="'.$link.'" title="'.$dados["titulo"].'">'.$dados["titulo"].'</a></h2>
		                
		                <p>'.nl2br(substr($dados['descricao'], 0, 290)).'...</p>
		                
		                <p class="saibamais hidetxt">Saiba + &raquo;</p>
		            </section>
				';
				self::setContador($contador);
			}
		}
	}
	
	public function totalRegistros(){ 

		$sql = "
			SELECT id,titulo,descricao,foto_capa,destaque,dataEvento
			FROM imprensa
			WHERE dataExclusao IS NULL
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro

		return $qtRegistros;

	}
	
	//lista imagens no detalhes
	public function getGaleriaImagensDetalhe(){ 
	
		$sql = "	
			SELECT i.id, i.thumb, i.imagem
			FROM imprensa_imagem AS i
			WHERE i.imprensa_id = $this->id
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		$i = 1;
		while($lista = self::resultsAll($this->qr)){

			if($lista['imagem']){
				$caminhoImagemCheck = URL.'upload/imagem/'.$lista['imagem'];

				//if(file_exists($caminhoImagemCheck)){
				  $caminhoImagem = URL.'upload/imagem/'.$lista['imagem'];
				  $caminhoImagemThumb = URL.'upload/thumb/'.$lista['thumb'];

				  echo'
				  	<li><a href="'.$caminhoImagem.'" title=""><img src="'.$caminhoImagemThumb.'" alt="Foto" width="116" height="85" /></a></li>
				  ';
				//}
			}
			
		$i++;
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
		$destaque = $_POST["destaque"];
		$descricao = addslashes($_POST["descricao"]);
		$dataCadastro = date("Y-m-d H:m:s");
		

		$nomeArquivo = $_REQUEST['nomeArquivoTemp'];
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
		
	
		//instanciando o objeto de cadastro
		$cad = new ManipulateData();
		$cad->setTable("imprensa");
		$cad->setFields("titulo,descricao,foto_capa,destaque,dataEvento,dataCadastro");
		$cad->setDados("'$titulo','$descricao','$imgThumb','$destaque','$dataEvento','$dataCadastro'");
		$cad->insert();
		$idRegistro = $cad->getRetornaIdCadastro(); 
		$erro = base64_encode($cad->getStatus());
		

				if($_POST['nomeImagemTemp']){
					foreach ($_POST['nomeImagemTemp'] as $nomeArquivo) {
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
					  		 	//cadastro da imagem
					  		 	$cad = new ManipulateData();
					  		 	$cad->setTable("imprensa_imagem");
					  		 	$cad->setFields("imprensa_id,imagem,thumb");
								$cad->setDados("'$idRegistro','$imgGde','$imgThumb'");
								$cad->insert();
						}
					}
				}
			
		

	$urlRedirecionamento = '../admin/?telas=nova-reportagem&msn='.$erro;
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
	}
	//alterar o registro
	if(isset($_POST["alterar"])){
		include_once("../funcoes/geral.php");
		//recupera os valores do formulario
		$idAlteracao = $_POST["idAlteracao"];
		$dataEvento = converteData($_POST["dataEvento"]);
		$titulo = addslashes($_POST["titulo"]);
		$destaque = $_POST["destaque"];
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
		$alt->setTable("imprensa");//envio o nome da tabela
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

		if($_POST['nomeImagemTemp']){
			foreach ($_POST['nomeImagemTemp'] as $nomeArquivo) {
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
			  		 	//cadastro da imagem
			  		 	$cad = new ManipulateData();
			  		 	$cad->setTable("imprensa_imagem");
			  		 	$cad->setFields("imprensa_id,imagem,thumb");
						$cad->setDados("'$idAlteracao','$imgGde','$imgThumb'");
						$cad->insert();
				}
			}
		}
	
		$urlRedirecionamento = '../admin/?telas=nova-reportagem&idAlteracao='.$idAlteracao.'&acao=alterar&msn='.$erro;
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
	}
	
	//excluir o registro
	if(isset($_POST['id'])){

		$itemExclusao = $_POST['id'];
		
		//deleta imagens da imprensa
			$conteudo = new Impresa();
			$conteudo->setId($itemExclusao);
			$conteudo->excluirImagem();
	
		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("imprensa");
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
		$exc = new Impresa();
		//envio o nome da tabela
		$exc->setNomeArquivo($arquivoTemp);
		$exc->excluirImagemTemp();
	}
	
	if($_POST['acao']=="excluirImagemUpdate"){
		$arquivo = $_POST['arquivo'];
		$exc = new Impresa();
		//envio o nome da tabela
		$exc->setNomeArquivo($arquivo);
		$exc->excluirImagemUpdate();
	}
	
	if($_POST['acao']=="excluirImagemGaleria"){
		$idImagem = $_POST['idImagem'];
		$exc = new Impresa();
		//envio o nome da tabela
		$exc->setidImagem($idImagem);
		$exc->excluirImagemGaleria();
		
		//deleto o registro	
			//instanciando o objeto de exclusao
			$exc = new ManipulateData();
			//envio o nome da tabela
			$exc->setTable("imprensa_imagem");
			//envio o campo de referente ao id de exclusao
			$exc->setFieldId("id");
			//envio o valor de referente ao id de exclusao
			$exc->setValueId($idImagem);
			//efetuando a exclusao
			$exc->delete();
		
	}

?>
