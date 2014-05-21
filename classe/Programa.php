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

class Programa extends CriaPaginacao{

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

	public function getId(){ 
		return $this->id;
	}	

	public function getDescricao(){ 
		return $this->descricao;
	}
	
	public function getImagem(){
		return $this->imagem;
	}

	//------------------------------------------------------------------------------------------------------

	public function geraLisPrograma(){ 
	
		$sql = "
			SELECT id,descricao
			FROM programa
			WHERE dataExclusao IS NULL
		";

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

				$contador ++;
				
				echo'
					<tr '.$class.'>
		            	<td></td>
		                <td>programa</td>
		                <td class="tamanho1"><a href="?telas=novo-programa&idAlteracao='.$dados["id"].'&acao=alterar"><img src="img/bteditar.png" width="55" height="17" /></a></td>
		                <td class="tamanho1"></td>
		            </tr>
				';
				self::setContador($contador);
			}
		}
	}


	public function geraDadosIdPrograma(){
		$sql = "
			SELECT id,descricao
			FROM programa
			WHERE dataExclusao IS NULL
			";

		if($this->id)
			$sql .= " AND id = ".$this->id;

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->id = $dados["id"];
		$this->descricao = $dados["descricao"];
	}


	public function galeriaImagensPrograma(){ 
	
		$sql = "	
			SELECT id, thumb, imagem
			FROM programa_imagem
			WHERE programa_id = $this->id
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		$i = 1;
		while($lista = self::resultsAll($this->qr)){

			if($lista['imagem']){
				$caminhoImagemCheck = 'upload/imagem/'.$lista['imagem'];

				//if(file_exists($caminhoImagemCheck)){
				  $caminhoImagem = URL.'upload/imagem/'.$lista['imagem'];
				  $caminhoImagemThumb = URL.'upload/thumb/'.$lista['thumb'];

				  echo'
				  	<li><a title="Foto" href="'.$caminhoImagem.'"><img alt="Foto" src="'.$caminhoImagemThumb.'" width="118" height="95"></a></li>
				  ';
				//}
			}
			
		$i++;
		}
	}	
	
	public function geraImagensPrograma(){ 
	
		$sql = "	
			SELECT id, thumb, imagem
			FROM programa_imagem
			WHERE programa_id = $this->id
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
	
	//exclui imagem da galeria
	public function excluirImagemGaleria(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT thumb
			FROM programa_imagem
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

	

}

//------acoes------------------------------------------------------------------------------------------------------

	//alterar o registro
	if(isset($_POST["alterar"])){
		include_once("../funcoes/geral.php");
		//recupera os valores do formulario
		$idAlteracao = $_POST["idAlteracao"];
		$descricao = addslashes($_POST["descricao"]);
		$dataAlteracao = date("Y-m-d H:i:s");

	
		//instanciando o objeto de alteracao
		$alt = new ManipulateData();
		$alt->setTable("programa");//envio o nome da tabela
			//enviando os atributos do banco
			$alt->setFields("descricao='$descricao', dataAlteracao='$dataAlteracao'");
			//envio o campo de referente ao id de alteracao
			$alt->setFieldId("id");
			//envio o valor de referente ao id de alteracao
			$alt->setValueId($idAlteracao);
			//efetuando a alteracao
			$alt->update();
			$erro = base64_encode($alt->getStatus());

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
			  		 	$cad->setTable("programa_imagem");
			  		 	$cad->setFields("programa_id,imagem,thumb");
						$cad->setDados("'$idAlteracao','$imgGde','$imgThumb'");
						$cad->insert();
				}
			}
		}
	
		$urlRedirecionamento = '../admin/?telas=programa&idAlteracao='.$idAlteracao.'&acao=alterar&msn='.$erro;
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
	}

		
	if($_POST['acao']=="excluirImagemTemp"){
		$arquivoTemp = $_POST['arquivoTemp'];
		$exc = new Programa();
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

		$exc = new Programa();
		$exc->setidImagem($idImagem);
		$exc->excluirImagemGaleria();
		
		//deleto o registro	
			//instanciando o objeto de exclusao
			$exc = new ManipulateData();
			//envio o nome da tabela
			$exc->setTable("programa_imagem");
			//envio o campo de referente ao id de exclusao
			$exc->setFieldId("id");
			//envio o valor de referente ao id de exclusao
			$exc->setValueId($idImagem);
			//efetuando a exclusao
			$exc->delete();
		
	}

?>
