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

class Parceiro extends CriaPaginacao{

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

	public function getNome(){ 
		return $this->nome;
	}
	
	public function getImagem(){ 
		return $this->imagem;
	}
	
	public function getLink(){ 
		return $this->link;
	}


	//------------------------------------------------------------------------------------------------------

	//lista parceido no admin
	public function geraLisParceiro(){ 
	
		$sql = "
			SELECT id,nome,imagem
			FROM parceiro
			WHERE dataExclusao IS NULL
		";
		if($this->strCampoPesquisa)
			$sql .= " AND nome LIKE '%$this->strCampoPesquisa%'";
		//if($this->coluna)
			//$sql .= " ORDER BY $this->coluna $this->ordenacao";
		else	
		 	$sql .= " ORDER BY nome";
	

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
				$caminhoImagem = URL.'upload/arquivos/'.$dados["imagem"];
				$contador ++;

				
				echo'	            
		            <div class="box">
				        <img src="'.$caminhoImagem.'" width="180" height="117" class="mrg-bottom" />
				        
				        <ul>
				            <li><a href="javascript:void(0);" class="excluirRegistro" id="'.$dados["id"].'"><img src="img/btexcluir.png" /></a></li>

				            <li><a href="javascript:void(0);" id=""><img src="img/bteditar.png" /></a></li>
				        </ul>
				    </div>
				';
				self::setContador($contador);
			}
		}
	}
	
	//lista parceiro
	public function getListAllParceiros(){ 
	
		$sql = "
			SELECT id,nome,imagem,link
			FROM parceiro
			WHERE dataExclusao IS NULL
			ORDER BY RAND()
		";
	

		$this->setParametro($this->strNumPagina); //numero de pagina atual
		$this->setFileName($this->strUrl); // nome da pagina atual
		$this->setInfoMaxPag(99999); // quantidade de produtos por tela
		$this->setMaximoLinks(10); //quantidade de links para a paginacao
		$this->setSQL($sql);
		self::iniciaPaginacao();
		$contador = 0; // contador para gerar o numero de paginas
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro
		$i = 1;
		if($qtRegistros > 0){
			while($dados = self::results()){
				$caminhoImagem = URL.'upload/arquivos/'.$dados["imagem"];

				$class = "";
				if($i == $qtRegistros)
					$class = 'class="sem-pdg-right"';

				echo'	            
		            <li '.$class.'>
						<a href="'.$dados["link"].'" title="'.$dados["nome"].'" rel="external"><img src="'.$caminhoImagem.'" alt="'.$dados["nome"].'" width="199" height="116" /></a>
		            </li>
				';
				self::setContador($contador);
				$i++;
			}
		}
	}
	
	//lista parceiro pelo id
	public function geraDadosIdParceiro(){

		$sql = "
			SELECT id,nome,imagem,link	
			FROM parceiro
			WHERE dataExclusao IS NULL
		";
		if($this->id)
			$sql .= " AND id = ".$this->id;

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->id = $dados["id"];
		$this->nome = $dados["nome"];
		$this->imagem = $dados["imagem"];
		$this->link = $dados["link"];	
	}


	
	//exclui imagem
	public function excluirArquivo(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT id,nome,imagem	
			FROM parceiro
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
		
		$sql = " UPDATE parceiro SET imagem = '' "; 
		if($this->id)
			$sql .=" WHERE id = '$this->id'";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);

	}
	

}

//------acoes------------------------------------------------------------------------------------------------------



	//cadastrar o registro
	if(isset($_POST["cadastrar"])){
		include_once("../funcoes/geral.php");
		require_once('../funcoes/uploadArquivo.php');

		//recupera os valores do formulario		
		$nome = addslashes($_POST["nome"]);
		$link = addslashes($_POST["site"]);
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
		$cad->setTable("parceiro");
		$cad->setFields("nome,imagem,link,dataCadastro");
		$cad->setDados("'$nome','$imagem','$link','$dataCadastro'");
		$cad->insert();
		$idRegistro = $cad->getRetornaIdCadastro(); 
		$erro = base64_encode($cad->getStatus());
		
		$urlRedirecionamento = '../admin/?telas=novo-parceiro&msn='.$erro;

		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}

	//alterar o registro
	if(isset($_POST["alterar"])){
		include_once("../funcoes/geral.php");
		require_once('../funcoes/uploadArquivo.php');
		
		//recupera os valores do formulario
		$idAlteracao = $_POST["idAlteracao"];					
		$nome = addslashes($_POST["nome"]);
		$link = addslashes($_POST["site"]);
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
		$alt->setTable("parceiro");//envio o nome da tabela
		//enviando os atributos do banco
		$alt->setFields("nome='$nome', link='$link', dataAlteracao='$dataAlteracao'");
		//envio o campo de referente ao id de alteracao
		$alt->setFieldId("id");
		//envio o valor de referente ao id de alteracao
		$alt->setValueId($idAlteracao);
		//efetuando a alteracao
		$alt->update();
		$erro = base64_encode($alt->getStatus());
		
		if($imagem){
			$alt->setTable("parceiro");//envio o nome da tabela
			//enviando os atributos do banco
			$alt->setFields("imagem='$imagem'");
			//envio o campo de referente ao id de alteracao
			$alt->setFieldId("id");
			//envio o valor de referente ao id de alteracao
			$alt->setValueId($idAlteracao);
			//efetuando a alteracao
			$alt->update();
		}

		
		$urlRedirecionamento = '../admin/?telas=novo-parceiro&idAlteracao='.$idAlteracao.'&acao=alterar&msn='.$erro;
		
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}

	//excluir o registro
	if(isset($_POST['id'])){

		$itemExclusao = $_POST['id'];

		//deleta imagens da noticia
		$conteudo = new Parceiro();
		$conteudo->setId($itemExclusao);
		$conteudo->excluirArquivo();

		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("parceiro");
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
		$conteudo = new Parceiro();
		$conteudo->setColuna($_POST['name']);
		$conteudo->setCampoPesquisa($_POST['value']);
		$conteudo->setId($_POST['idCheck']);
		echo $conteudo->checkDados();
	}
	
	if($_POST['acao']=="excluirArquivo"){
		$exc = new Parceiro();
		$exc->setId($_POST['idImagem']);
		$exc->excluirArquivo();
	}
?>

