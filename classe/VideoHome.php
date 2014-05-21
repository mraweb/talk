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

class VideoHome extends CriaPaginacao{

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
	
	public function getUrl(){ 
		return $this->url;
	}
	
	public function getImagem(){ 
		return $this->imagem;
	}

	//------------------------------------------------------------------------------------------------------

	//lista os videos no admin
	public function getListAllVideosHomeAdmin(){ 
	
		$sql = "
			SELECT id,titulo,imagem,destaque
			FROM video_home
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
				$caminhoImagem = URL.'upload/img_small/'.$dados["imagem"];
				$contador ++;

				$checked = "";
				if($dados["destaque"]==1)
					$checked = "checked";
					
					
				echo'
					<div class="thumb-video" id="close_'.$dados["id"].'">
			    		<iframe width="230" height="129" src="//www.youtube.com/embed/'.$dados["imagem"].'"></iframe>
			
			    		<br /><input type="radio" name="destaque" id="'.$dados["id"].'" class="destaqueVideo" '.$checked.' />
			    		
			    		<a href="javascript:;" id="'.$dados["id"].'" class="excluirVideo" title="Excluir"><img src="img/btexcluir.png"></a>
			    		
			    	</div>
				';
				self::setContador($contador);
			}
		}
	}
	
	public function getDestaqueVideosHome(){ 
	
		$sql = "
			SELECT id,titulo,imagem
			FROM video_home
			WHERE dataExclusao IS NULL
			AND destaque = 1
		";
	

		$this->setParametro($this->strNumPagina); //numero de pagina atual
		$this->setFileName($this->strUrl); // nome da pagina atual
		$this->setInfoMaxPag(1); // quantidade de produtos por tela
		$this->setMaximoLinks(10); //quantidade de links para a paginacao
		$this->setSQL($sql);
		self::iniciaPaginacao();
		$contador = 0; // contador para gerar o numero de paginas
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro
		if($qtRegistros > 0){
			while($dados = self::results()){
				$caminhoImagem = URL.'upload/img_small/'.$dados["imagem"];
				$contador ++;

				
				echo'
					<iframe width="560" height="340" src="//www.youtube.com/embed/'.$dados["imagem"].'"></iframe>
				';
				self::setContador($contador);
			}
		}
	}

	
	//lista video pelo id
	public function geraDadosIdVideo(){

		$sql = "
			SELECT id,titulo,url,imagem	
			FROM video_home
			WHERE dataExclusao IS NULL
		";
		if($this->id)
			$sql .= " AND id = ".$this->id;

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->id = $dados["id"];
		$this->titulo = $dados["titulo"];
		$this->urltempoParceria = $dados["url"];	
		$this->imagem = $dados["imagem"];	
	}


	
	//exclui imagem
	public function excluirArquivo(){ 
		$id = $this->id;
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT id,titulo,url,imagem	
			FROM video_home
			WHERE dataExclusao IS NULL
			AND id = '$id'
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			if($lista = self::resultsAll($this->qr)){
				deletaImagemVideoHome($lista['imagem'].'.jpg');//deleto arquivo
			}
		}
		
		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("video_home");
		//envio o campo de referente ao id de exclusao
		$exc->setFieldId("id");
		//envio o valor de referente ao id de exclusao
		$exc->setValueId($id);
		//efetuando a exclusao
		$exc->delete();
		$erro = $exc->getStatus();

	}	
	
	//destaque video
	public function destaqueVideo(){ 
		$id = $this->id;
		
		echo $sql = "UPDATE video_home SET destaque = NULL WHERE destaque = 1";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);
		
		
		$alt = new ManipulateData();
		$alt->setTable("video_home");//envio o nome da tabela
			//enviando os atributos do banco
			$alt->setFields("destaque=1");
			//envio o campo de referente ao id de alteracao
			$alt->setFieldId("id");
			//envio o valor de referente ao id de alteracao
			$alt->setValueId($id);
			//efetuando a alteracao
			$alt->update();

	}
	
	
	
	//lista os videos
	public function getListAllVideosHome(){ 
	
		$sql = "
			SELECT id,titulo,imagem
			FROM video_home
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
				$caminhoImagem = URL.'upload/img_small/'.$dados["imagem"].'.jpg';
				$contador ++;

				
				echo'
					<li><a href="http://www.youtube.com/watch?v='.$dados["imagem"].'" class="youtube" title="'.$dados["titulo"].'"><img src="'.$caminhoImagem.'" width="120" height="74" alt="'.$dados["titulo"].'" /></a></li>
				';
				self::setContador($contador);
			}
		}
	}
	
	public function totalRegistros(){ 

		$sql = "
			SELECT id
			FROM video_home
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
		$titulo = addslashes($_POST["nome_video"]);
		$url = addslashes($_POST["url"]);
		$url = str_replace('https://www.youtube.com/watch?v=', 'http://www.youtube.com/watch?v=', $url);
		$nomeVideoURL = str_replace('http://www.youtube.com/watch?v=', '', $url);
		$imagemYoutube = video_imagem($url);
		moveImgViedeo($imagemYoutube,$nomeVideoURL.'.jpg');				
		$dataCadastro = date("Y-m-d H:i:s");
		

		//instanciando o objeto de cadastro
		$cad = new ManipulateData();
		$cad->setTable("video_home");
		$cad->setFields("titulo,url,imagem,dataCadastro");
		$cad->setDados("'$titulo','$url','$nomeVideoURL','$dataCadastro'");
		$cad->insert();
		$idRegistro = $cad->getRetornaIdCadastro(); 
		$erro = base64_encode($cad->getStatus());
		
		$urlRedirecionamento = '../admin/?telas=lista-videos&msn='.$erro;

		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}

	if($_POST['acao']=="excluirArquivo"){
		$exc = new VideoHome();
		$exc->setId($_POST['idImagem']);
		$exc->excluirArquivo();
	}
	
	if($_POST['acao']=="destaqueVideo"){
		$exc = new VideoHome();
		$exc->setId($_POST['id']);
		$exc->destaqueVideo();
	}
?>

