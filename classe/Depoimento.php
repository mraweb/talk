<?php 

if($url[0]=="admin"){
	include_once("../classe/MySqlConn.php");
	include_once("../classe/ManipulateData.php");
	include_once("../classe/CriaPaginacao.php");
	include_once("../funcoes/geral.php");
}else{
	include_once("MySqlConn.php");
	include_once("ManipulateData.php");
	include_once("CriaPaginacao.php");
}

class Depoimento extends CriaPaginacao{

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
	
	public function setImagem($x){
		$this->imagem = $x;
	}

	public function setId($id){
		$this->id = $id;
	}


	//------------------------------------------------------------------------------------------------------

	public function getPaginas(){
		return $this->strNumPagina = $x;
	}

	public function getId(){ 
		return $this->id;
	}

	public function getTitulo(){ 
		return $this->titulo;
	}
	
	public function getTempoParceria(){ 
		return $this->tempoParceria;
	}
	
	public function getImagem(){ 
		return $this->imagem;
	}

	public function getDescricao(){ 
		return $this->descricao;
	}


	//------------------------------------------------------------------------------------------------------

	//lista os depoimentos no admin
	public function geraLisDepoimento(){ 
	
		$sql = "
			SELECT id,titulo,tempo_parceria,imagem,descricao
			FROM depoimento
			WHERE dataExclusao IS NULL
		";
		if($this->strCampoPesquisa)
			$sql .= " AND titulo LIKE '%$this->strCampoPesquisa%'";
		//if($this->coluna)
			//$sql .= " ORDER BY $this->coluna $this->ordenacao";
		else	
		 	$sql .= " ORDER BY titulo";
	

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
		            	<td>'.$dados["titulo"].'</td>
		                <td class="tamanho1"><a href="?telas=novo-depoimento&idAlteracao='.$dados["id"].'&acao=alterar"><img src="img/bteditar.png" width="55" height="17" /></a></td>
		                <td class="tamanho1"><a href="javascript:void(0);" class="excluirRegistro" id="'.$dados["id"].'"><img src="img/btexcluir.png" width="55" height="17" /></a></td>
		            </tr>
				';
				self::setContador($contador);
			}
		}
	}
	
	//lista depoimento pelo id
	public function geraDadosIdDepoimento(){

		$sql = "
			SELECT id,titulo,tempo_parceria,imagem,descricao	
			FROM depoimento
			WHERE dataExclusao IS NULL
		";
		if($this->id)
			$sql .= " AND id = ".$this->id;

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->id = $dados["id"];
		$this->titulo = $dados["titulo"];
		$this->tempoParceria = $dados["tempo_parceria"];	
		$this->imagem = $dados["imagem"];	
		$this->descricao = $dados["descricao"];
	}


	
	//exclui imagem
	public function excluirArquivo(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT id,titulo,tempo_parceria,imagem,descricao	
			FROM depoimento
			WHERE id = '$this->id'
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			if($lista = self::resultsAll($this->qr)){
				deletaArquivo($lista['imagem']);//deleto arquivo
			}
		}
		
		$sql = " UPDATE depoimento SET imagem = '' "; 
		if($this->id)
			$sql .=" WHERE id = '$this->id'";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);

	}	
	
	
	//lista os depoimentos
	public function getListAllDepoimento(){ 
	
		$sql = "
			SELECT id,titulo,tempo_parceria,imagem,descricao
			FROM depoimento
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
				$contador ++;

				
				echo'
					<section class="box-depo-int">
		                <img src="'.$caminhoImagem.'" alt="Logo" width="154" height="90" class="img-left" />
		
		                <div>
		                    <h2>'.$dados["titulo"].'</h2>
		                    <h3>'.$dados["tempo_parceria"].'</h3>
		
		                    '.nl2br($dados["descricao"]).'
		                </div>
		            </section>
				';
				self::setContador($contador);
			}
		}
	}
	
	//lista os depoimentos
	public function getListDepoimentoHome(){ 
	
		$sql = "
			SELECT id,titulo,tempo_parceria,imagem,descricao
			FROM depoimento
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
				$contador ++;

				
				echo'	            
			        <section class="box-depo">
	                	<img src="'.$caminhoImagem.'" alt="'.$dados["titulo"].'" width="100" height="66" class="left" />
	                    
	                    '.nl2br(substr($dados['descricao'], 0, 130)).'
	                </section>
				';
				self::setContador($contador);
			}
		}
	}
	
	public function totalRegistros(){ 

		$sql = "
			SELECT id,titulo,tempo_parceria,imagem,descricao
			FROM depoimento
			WHERE dataExclusao IS NULL	
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro

		return $qtRegistros;

	}

}

//------acoes------------------------------------------------------------------------------------------------------



	//cadastrar o registro
	if(isset($_POST["cadastrar"])){
		include_once("../funcoes/geral.php");
		require_once('../funcoes/uploadArquivo.php');

		//recupera os valores do formulario		
		$titulo = addslashes($_POST["titulo"]);
		$tempo_parceria= addslashes($_POST["tempo_parceria"]);
		$descricao = addslashes($_POST["descricao"]);
		$dataCadastro = date("Y-m-d H:i:s");
		
		//upload da imagem
		if($_FILES['arquivo']['name']){
			$arquivo = $_FILES['arquivo'];
 			$arquivoName = $_FILES['arquivo']['name'];
 			$arquivoTemp = $_FILES['arquivo']['tmp_name'];
			$arquivo1 = upload_arquivo($arquivo, $arquivoName, $arquivoTemp);
			if($arquivo1 != "erro upload") 
				$imagem = $arquivo1;
		}

		//instanciando o objeto de cadastro
		$cad = new ManipulateData();
		$cad->setTable("depoimento");
		$cad->setFields("titulo,tempo_parceria,imagem,descricao,dataCadastro");
		$cad->setDados("'$titulo','$tempo_parceria','$imagem','$descricao','$dataCadastro'");
		$cad->insert();
		$idRegistro = $cad->getRetornaIdCadastro(); 
		$erro = base64_encode($cad->getStatus());
		
		$urlRedirecionamento = '../admin/?telas=novo-depoimento&msn='.$erro;

		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}

	//alterar o registro
	if(isset($_POST["alterar"])){
		include_once("../funcoes/geral.php");
		require_once('../funcoes/uploadArquivo.php');
		
		//recupera os valores do formulario
		$idAlteracao = $_POST["idAlteracao"];					
		$titulo = addslashes($_POST["titulo"]);
		$tempo_parceria = addslashes($_POST["tempo_parceria"]);
		$descricao = addslashes($_POST["descricao"]);
		$dataAlteracao = date("Y-m-d H:i:s");
		
		//upload da imagem
		if($_FILES['arquivo']['name']){
			deletaArquivo($_POST['arquivo_anterior']);//deleta o arquivo anterior
			$arquivo = $_FILES['arquivo'];
 			$arquivoName = $_FILES['arquivo']['name'];
 			$arquivoTemp = $_FILES['arquivo']['tmp_name'];
			$arquivo1 = upload_arquivo($arquivo, $arquivoName, $arquivoTemp);
			if($arquivo1 != "erro upload") 
				$imagem = $arquivo1;
				
		}

		//instanciando o objeto de alteracao
		$alt = new ManipulateData();
		$alt->setTable("depoimento");//envio o nome da tabela
		//enviando os atributos do banco
		$alt->setFields("titulo='$titulo', tempo_parceria='$tempo_parceria',  descricao='$descricao', dataAlteracao='$dataAlteracao'");
		//envio o campo de referente ao id de alteracao
		$alt->setFieldId("id");
		//envio o valor de referente ao id de alteracao
		$alt->setValueId($idAlteracao);
		//efetuando a alteracao
		$alt->update();
		$erro = base64_encode($alt->getStatus());
		
		if($imagem){
			$alt->setTable("depoimento");//envio o nome da tabela
			//enviando os atributos do banco
			$alt->setFields("imagem='$imagem'");
			//envio o campo de referente ao id de alteracao
			$alt->setFieldId("id");
			//envio o valor de referente ao id de alteracao
			$alt->setValueId($idAlteracao);
			//efetuando a alteracao
			$alt->update();
		}

		
		$urlRedirecionamento = '../admin/?telas=novo-depoimento&idAlteracao='.$idAlteracao.'&acao=alterar&msn='.$erro;
		
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}

	//excluir o registro
	if(isset($_POST['id'])){

		$itemExclusao = $_POST['id'];

		//deleta imagens da noticia
		$conteudo = new Depoimento();
		$conteudo->setId($itemExclusao);
		$conteudo->excluirArquivo();

		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("depoimento");
		//envio o campo de referente ao id de exclusao
		$exc->setFieldId("id");
		//envio o valor de referente ao id de exclusao
		$exc->setValueId($itemExclusao);
		//efetuando a exclusao
		$exc->delete();
		
		$resp = false;
		if($exc->getStatus()=="Apagado com Sucesso!!!")
			$resp = true;
			
		echo $resp;
	}
	
	if($_POST['acao']=="excluirArquivo"){
		$exc = new Depoimento();
		$exc->setId($_POST['idImagem']);
		$exc->excluirArquivo();
	}
?>

