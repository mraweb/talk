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

class AudioHome extends CriaPaginacao{

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
	
	public function getAudio(){ 
		return $this->audio;
	}

	//------------------------------------------------------------------------------------------------------

	//lista os audio no admin
	public function getListAllVideosHomeAdmin(){ 
	
		$sql = "
			SELECT id,titulo,audio
			FROM audio_home
			WHERE dataExclusao IS NULL
		";
		$sql .= " ORDER BY id DESC";
	

		$this->setParametro($this->strNumPagina); //numero de pagina atual
		$this->setFileName($this->strUrl); // nome da pagina atual
		$this->setInfoMaxPag(999999999); // quantidade de produtos por tela
		$this->setMaximoLinks(10); //quantidade de links para a paginacao
		$this->setSQL($sql);
		self::iniciaPaginacao();
		$contador = 0; // contador para gerar o numero de paginas
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro
		if($qtRegistros > 0){
			while($dados = self::results()){
				$contador ++;

				echo'
					<div class="box-audio" id="remove_'.$dados['id'].'">
			    		<p>'.$dados['titulo'].'</p>

			    		<a href="'.$dados['audio'].'" class="sc-player borda" title="'.$dados['titulo'].'">'.$dados['titulo'].'</a>
			
			    		<a href="javascript:;" class="bt-excluir" id="'.$dados['id'].'" title="Excluir"><img src="img/btexcluir.png"></a>
			    	</div>
				';
				self::setContador($contador);
			}
		}
	}
	
	//lista audio pelo id
	public function geraDadosIdAudio(){

		$sql = "
			SELECT id,titulo,audio
			FROM audio_home
			WHERE dataExclusao IS NULL
		";
		if($this->id)
			$sql .= " AND id = ".$this->id;

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->id = $dados["id"];
		$this->titulo = $dados["titulo"];
		$this->audio = $dados["audio"];
	}


	
	//exclui imagem
	public function excluirArquivo(){ 
		$id = $this->id;
		
		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("audio_home");
		//envio o campo de referente ao id de exclusao
		$exc->setFieldId("id");
		//envio o valor de referente ao id de exclusao
		$exc->setValueId($id);
		//efetuando a exclusao
		$exc->delete();
		$erro = $exc->getStatus();

	}	
	
	
	
	
	//lista os audio
	public function getListAllAudioHome(){ 
	
		$sql = "
			SELECT id,titulo,audio
			FROM audio_home
			WHERE dataExclusao IS NULL
			ORDER BY rand()
			LIMIT 3
		";
		
		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	

		if($qtRegistros > 0){
			while($dados = self::resultsAll($this->qr)){
				$contador ++;
				echo'
					<li>
		            	<h3>'.$dados['titulo'].'</h3>

		            	<a href="'.$dados['audio'].'" class="sc-player borda" title="'.$dados['titulo'].'">'.$dados['titulo'].'</a>
		            </li>
				';
				self::setContador($contador);
			}
		}
		
	}
	
	public function totalRegistros(){ 

		$sql = "
			SELECT id
			FROM audio_home
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
		

		//recupera os valores do formulario		
		$titulo = addslashes($_POST["titulo"]);
		$audio = addslashes($_POST["audio"]);			
		$dataCadastro = date("Y-m-d H:i:s");
		

		//instanciando o objeto de cadastro
		$cad = new ManipulateData();
		$cad->setTable("audio_home");
		$cad->setFields("titulo,audio,dataCadastro");
		$cad->setDados("'$titulo','$audio','$dataCadastro'");
		$cad->insert();
		$idRegistro = $cad->getRetornaIdCadastro(); 
		$erro = base64_encode($cad->getStatus());
		
		$urlRedirecionamento = '../admin/?telas=lista-audios&msn='.$erro;

		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}

	if($_POST['acao']=="excluirArquivo"){
		$exc = new AudioHome();
		$exc->setId($_POST['idAudio']);
		$exc->excluirArquivo();
	}

?>

