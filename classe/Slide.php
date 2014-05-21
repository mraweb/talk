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

class Slide extends CriaPaginacao{

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
	
	public function setType($x){
		$this->type = $x;
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
	
	public function getLink(){ 
		return $this->link;
	}
	
	public function getImagem(){ 
		return $this->imagem;
	}

	public function getDescricao(){ 
		return $this->descricao;
	}


	//------------------------------------------------------------------------------------------------------


	public function geraLisSlide(){ 
	
		$sql = "
			SELECT id,titulo,imagem,link,descricao
			FROM slide
			WHERE dataExclusao IS NULL
		";
		if($this->strCampoPesquisa)
			$sql .= " AND titulo LIKE '%$this->strCampoPesquisa%'";
		//if($this->coluna)
			//$sql .= " ORDER BY $this->coluna $this->ordenacao";
		else	
		 	$sql .= " ORDER BY id";
	

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
		                <td class="tamanho1"><a href="?telas=novo-slide&idAlteracao='.$dados["id"].'&acao=alterar"><img src="img/bteditar.png" width="55" height="17" /></a></td>
		                <td class="tamanho1"><a href="javascript:void(0);" class="excluirRegistro" id="'.$dados["id"].'"><img src="img/btexcluir.png" width="55" height="17" /></a></td>
		            </tr>
				';
				self::setContador($contador);
			}
		}
	}
	

	public function geraDadosIdSlide(){

		$sql = "
			SELECT id,titulo,imagem,link,descricao	
			FROM slide
			WHERE dataExclusao IS NULL
		";
		if($this->id)
			$sql .= " AND id = ".$this->id;

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->id = $dados["id"];
		$this->titulo = $dados["titulo"];
		$this->link = $dados["link"];	
		$this->imagem = $dados["imagem"];	
		$this->descricao = $dados["descricao"];
	}


	
	//exclui imagem
	public function excluirArquivo(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT id,imagem
			FROM slide
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
		
		$sql = " UPDATE slide SET imagem = '' "; 
		if($this->id)
			$sql .=" WHERE id = '$this->id'";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);

	}
	
	
	//verifica se já existe nome/email cadastrado
	public function checkDados(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT id, $this->coluna
			FROM slide
			WHERE $this->coluna = '$this->strCampoPesquisa'
		";
		
		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		$resp = false;
		if($qtRegistros > 0){
			if($lista = self::resultsAll($this->qr)){
				if($lista["id"]==$this->id)
					$resp = false;
				else 
					$resp = true;
			}
		}
		return $resp;
	}	
	
	

	public function listSlideHome(){ 
	
		$sql = "
			SELECT id,titulo,imagem,link,descricao
			FROM slide
			WHERE dataExclusao IS NULL
			ORDER BY id";
	

		$this->setParametro($this->strNumPagina); //numero de pagina atual
		$this->setFileName($this->strUrl); // nome da pagina atual
		$this->setInfoMaxPag(9999999999); // quantidade de produtos por tela
		$this->setMaximoLinks(10); //quantidade de links para a paginacao
		$this->setSQL($sql);
		self::iniciaPaginacao();
		$contador = 0; // contador para gerar o numero de paginas
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro
		if($qtRegistros > 0){
			while($dados = self::results()){
			
				$caminhoImagem = URL.'upload/arquivos/'.$dados['imagem'];
				$descricaoSlide = nl2br($dados['descricao']);
				echo '
				
					<section class="slides">
                        <div>
                            <h2><a href="'.$dados['link'].'" title="'.$dados['titulo'].'">'.$dados['titulo'].'</a></h2>

                            '.$descricaoSlide.'
                            <p class="saiba">Saiba Mais »</p>
                        </div>

                        <img src="'.$caminhoImagem.'" alt="'.$dados['titulo'].'" width="453" height="314" class="right" />
                    </section>
				
				';

			}
		}
	}

}

//------acoes------------------------------------------------------------------------------------------------------



	//cadastrar o registro
	if(isset($_POST["cadastrar"])){
		include_once("../funcoes/geral.php");
		require_once('../funcoes/uploadArquivo.php');

		//recupera os valores do formulario		
		$titulo = addslashes($_POST["titulo"]);
		$link = addslashes($_POST["link"]);
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
		$cad->setTable("slide");
		$cad->setFields("titulo,imagem,descricao,link,dataCadastro");
		$cad->setDados("'$titulo','$imagem','$descricao','$link','$dataCadastro'");
		$cad->insert();
		$idRegistro = $cad->getRetornaIdCadastro(); 
		$erro = base64_encode($cad->getStatus());
		
		$urlRedirecionamento = '../admin/?telas=novo-slide&msn='.$erro;

		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}

	//alterar o registro
	if(isset($_POST["alterar"])){
		include_once("../funcoes/geral.php");
		require_once('../funcoes/uploadArquivo.php');
		
		//recupera os valores do formulario
		$idAlteracao = $_POST["idAlteracao"];					
		$titulo = addslashes($_POST["titulo"]);
		$link = addslashes($_POST["link"]);
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
		$alt->setTable("slide");//envio o nome da tabela
		//enviando os atributos do banco
		$alt->setFields("titulo='$titulo', descricao='$descricao', link='$link', dataAlteracao='$dataAlteracao'");
		//envio o campo de referente ao id de alteracao
		$alt->setFieldId("id");
		//envio o valor de referente ao id de alteracao
		$alt->setValueId($idAlteracao);
		//efetuando a alteracao
		$alt->update();
		$erro = base64_encode($alt->getStatus());
		
		if($imagem){
			$alt->setTable("slide");//envio o nome da tabela
			//enviando os atributos do banco
			$alt->setFields("imagem='$imagem'");
			//envio o campo de referente ao id de alteracao
			$alt->setFieldId("id");
			//envio o valor de referente ao id de alteracao
			$alt->setValueId($idAlteracao);
			//efetuando a alteracao
			$alt->update();
		}

		
		$urlRedirecionamento = '../admin/?telas=novo-slide&idAlteracao='.$idAlteracao.'&acao=alterar&msn='.$erro;
		
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}

	//excluir o registro
	if(isset($_POST['id'])){

		$itemExclusao = $_POST['id'];


		$conteudo = new Slide();
		$conteudo->setId($itemExclusao);
		$conteudo->excluirArquivo();

		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("slide");
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
	
	if($_POST['acao']=="checkDados"){
		$conteudo = new Slide();
		$conteudo->setColuna($_POST['name']);
		$conteudo->setCampoPesquisa($_POST['value']);
		$conteudo->setId($_POST['idCheck']);
		echo $conteudo->checkDados();
	}
	
	if($_POST['acao']=="excluirArquivo"){
		$exc = new Slide();
		$exc->setId($_POST['idImagem']);
		$exc->excluirArquivo();
	}
?>

