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

class Servico extends CriaPaginacao{

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
	
	public function setIdCategoriaServico($id){
		$this->idCategoriaServico = $id;
	}
	
	public function setType($x){
		$this->type = $x;
	}
	
	public function setItem($x){
		$this->item = $x;
	}
	
	public function setHrefSubCategoria($x){
		$this->hrefSubCategoria = $x;
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
	
	public function getStatus(){ 
		return $this->status;
	}
	
	public function getDescricao(){ 
		return $this->descricao;
	}
	
	public function getDescricaoInterna(){ 
		return $this->descricaoInterna;
	}
	
	public function getLogo(){ 
		return $this->logo;
	}
	
	public function getAudio(){ 
		return $this->audio;
	}

	
	public function getVideo(){ 
		return $this->video;
	}

	//------------------------------------------------------------------------------------------------------
	//lista servico pelo id
	public function geraDadosIdServico(){

		$sql = "
			SELECT s.id,s.nome,s.status,s.descricao,s.descricaointerna,s.logo,s.audio,s.video
			FROM servico AS s
			WHERE s.dataExclusao IS NULL
		";
		if($this->id)
			$sql .= " AND s.id = ".$this->id;

		//echo $sql;
		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->id = $dados["id"];
		$this->nome = $dados["nome"];
		$this->status = $dados["status"];
		$this->descricao = $dados["descricao"];
		$this->descricaoInterna = $dados["descricaointerna"];
		$this->logo = $dados["logo"];
		$this->audio = $dados["audio"];

		$this->video = $dados["video"];

	}

	//exclui imagem
	public function excluirArquivo(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT id,logo
			FROM servico
			WHERE id = '$this->id'
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			if($lista = self::resultsAll($this->qr)){
				deletaArquivo($lista['logo']);//deleto arquivo
			}
		}
		
		$sql = " UPDATE servico SET logo = '' "; 
		if($this->id)
			$sql .=" WHERE id = '$this->id'";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);

	}


	//lista servicos
	public function listServicosAdmin(){ 

		include_once("../funcoes/geral.php");
		include_once("../funcoes/define.php");
		$sql = "
			SELECT id,nome,status,descricao,descricaointerna,logo,audio,posicao
			FROM servico
			ORDER BY audio,posicao
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			while($dados = self::resultsAll($this->qr)){
				
				$caminhoImagem = URL.'upload/arquivos/'.$dados["logo"];
				
				if($dados['audio']=='SEM')
				 	$pag = 'servico-sem-audio';
				 else 
				 	$pag = 'servico-com-audio';
				
				echo'
				<section class="box-serv">
			        <a href="?telas='.$pag.'&id='.$dados['id'].'" title="'.$dados['nome'].'"><img src="'.$caminhoImagem.'" alt="'.$dados['nome'].'" width="120" height="83" />
			        
			        <h2>'.$dados['nome'].'</h2>
			        </a>
			    </section>
				';
			}
		}
	}
		
	//lista servicos site
	public function getListServicos(){ 

		include_once("funcoes/geral.php");
		$sql = "
			SELECT id,nome,status,descricao,logo,audio
			FROM servico
			WHERE status = 'A'
			ORDER BY audio,posicao
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			while($dados= self::resultsAll($this->qr)){
					$link = URL.'programas/'.criarSlug($dados['nome']);
					$logo = URL.'upload/arquivos/'.$dados['logo'];
					$size = explode('|', SizeImage($logo));
					
					echo'

						<section class="box-serv1">
						    	<a href="'.$link.'" title="'.$dados['nome'].'"><img src="'.$logo.'" alt="'.$dados['nome'].'" width="120" height="83" />
				
							<h2>'.$dados['nome'].'</h2>
				
							<p>'.nl2br(substr($dados['descricao'], 0, 100)).'</p>
							</a>
					    	</section>					

					';

			}
		}

	}
	
	//lista menu servicos site
	public function getListMenuServicos(){ 

		include_once("funcoes/geral.php");
		$sql = "
			SELECT id,nome,status,descricao,logo,audio
			FROM servico
			WHERE status = 'A'
			ORDER BY audio,posicao
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			while($dados= self::resultsAll($this->qr)){
				$link = URL.'programas/'.criarSlug($dados['nome']);
				
				$ativo = "";
				if($dados['id'] == $this->id)
					$ativo = "ativo";

				// echo '<li><a href="'.$link.'" title="'.$dados['nome'].'" class="'.$ativo.'">'.$dados['nome'].'</a></li>';

				echo '<li><a href="'.$link.'" title="'.$dados['nome'].'" class="'.$ativo.'">'.$dados['nome'].'</a></li>';

			}
		}

	}
	
	//lista servicos site
	public function getListServicosSemAudio(){ 

		include_once("funcoes/geral.php");
		$sql = "
			SELECT id,nome,status,descricao,logo,audio
			FROM servico
			WHERE status = 'A'
			ORDER BY audio,posicao
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			while($dados= self::resultsAll($this->qr)){

				if($this->type == 'interna'){
					if($dados['audio'] == 'SEM'){
						$link = URL.'programas/'.criarSlug($dados['nome']);
						echo'
							<li><a href="'.$link.'" title="'.$dados['nome'].'"><img src="upload/arquivos/'.$dados['logo'].'" alt="Serviço" width="120" height="83" /></a></li>
						';
					}else{
						echo'
							<li><a href="'.URL.'programas" title="'.$dados['nome'].'"><img src="upload/arquivos/'.$dados['logo'].'" alt="Serviço" width="120" height="83" /></a></li>
						';
					}
				}else{
                       //item da home
                       $link = URL.'programas/'.criarSlug($dados['nome']);
                       echo'
	                       <li>
	                       		<a href="'.$link.'" title="'.$dados['nome'].'"><img src="upload/arquivos/'.$dados['logo'].'" alt="Serviço" width="120" height="83" /></a>
	                   	   </li>
                       ';
				}

			}
		}

	}
	
	//ordenar servicos
	public function ordenarServico(){ 
	
		$sql = "
			SELECT id,nome,status,descricao,descricaointerna,logo,audio,posicao
			FROM servico
			ORDER BY audio,posicao
		";

		$this->setParametro($this->strNumPagina); //numero de pagina atual
		$this->setFileName($this->strUrl); // nome da pagina atual
		$this->setInfoMaxPag(99999999); // quantidade de produtos por tela
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
		            <tr>
		                <td>'.$dados["nome"].'</td>
		                <td>'.$dados["audio"].'</td>
		                <td>
		                	<input type="text" name="posicao['.$dados["id"].']" value="'.$dados["posicao"].'" maxlength="2" class="sonums">
		                </td>
		            </tr>
				';
				self::setContador($contador);
			}
		}
	}
	
	
	public function deleteServicoCategoria(){ 
		$sql = "DELETE FROM servico_categoria WHERE servico_id = $this->id";
	    	$this->sql = $sql;
		$this->qr = self::execSql($this->sql);
	}
	
	public function getTotalMenuServicoCategoria(){ 

		include_once("funcoes/geral.php");
		$sql = "
			SELECT cs.nome AS nomeCategoriaServico
			FROM servico_categoria AS sc
			INNER JOIN servico AS s ON s.id = sc.servico_id
			INNER JOIN categoria_servico AS cs ON sc.categoria_servico_id = cs.id
			WHERE sc.servico_id = '$this->id'
			ORDER BY cs.nome
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		
		return $qtRegistros;

	}
	

	public function getMenuServicoCategoria(){ 

		include_once("funcoes/geral.php");
		$sql = "
			SELECT cs.id AS idCategoriaServico, cs.nome AS nomeCategoriaServico, s.nome AS nomeServico
			FROM servico_programacao AS p
			INNER JOIN servico AS s ON s.id = p.servico_id
			INNER JOIN categoria_servico AS cs ON cs.id = p.categoria_servico_id
			INNER JOIN servico_categoria AS sc ON sc.servico_id = s.id
			WHERE sc.categoria_servico_id = cs.id
			AND p.status = 'A'
			AND s.status = 'A'
			AND s.id = $this->id
			GROUP BY sc.categoria_servico_id
			ORDER BY cs.nome				
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			while($dados = self::resultsAll($this->qr)){
				$ativo = "";
				if($dados['idCategoriaServico'] == $this->idCategoriaServico)
					$ativo = "ativo";
				
				$link = URL.'programas/'.criarSlug($dados['nomeServico']).'/'.criarSlug($dados['nomeCategoriaServico']);

				echo '<li><a href="'.$link.'" title="'.$dados['nomeCategoriaServico'].'" class='.$ativo.'>'.$dados['nomeCategoriaServico'].'</a></li>';

			}
		}

	}
	



}

//------acoes------------------------------------------------------------------------------------------------------

	if($_POST['acao']=="addServico"){
		include_once("../funcoes/geral.php");
		require_once('../funcoes/uploadArquivo.php');
		
		$nome = addslashes($_POST["nome"]);
		$status = addslashes($_POST["status"]);
		$descricao = addslashes($_POST["descricao"]);
		$descricaointerna = addslashes($_POST["descricaointerna"]);

		$audio = addslashes($_POST["audio"]);

		$video = addslashes($_POST["video"]);

		$dataCadastro = date("Y-m-d H:i:s");
		
		//upload da imagem
		if($_FILES['arquivo']['name']){
			$arquivo = $_FILES['arquivo'];
 			$arquivoName = $_FILES['arquivo']['name'];
 			$arquivoTemp = $_FILES['arquivo']['tmp_name'];
			$arquivo1 = upload_arquivo($arquivo, $arquivoName, $arquivoTemp);
			if($arquivo1 != "erro upload") 
				$logo = $arquivo1;
		}
		
		//cadastro serviço sem audio
		$cad = new ManipulateData();
		$cad->setTable("servico");
		$cad->setFields("nome,status,descricao,descricaointerna,logo,audio,dataCadastro,video");
		$cad->setDados("'$nome','$status','$descricao','$descricaointerna','$logo','$audio','$dataCadastro','$video'");
		$cad->insert();
		$idRegistro = $cad->getRetornaIdCadastro(); 
		$erro = base64_encode($cad->getStatus());
		
		if($_POST['categoria-servico']){
			foreach ($_POST['categoria-servico'] as $categoria_servico_id) {
				$cad->setTable("servico_categoria");
				$cad->setFields("servico_id,categoria_servico_id");
				$cad->setDados("'$idRegistro','$categoria_servico_id'");
				$cad->insert();
			}
		}
		
		if($audio=='SEM')
			$urlRedirecionamento = '../admin/?telas=servico-sem-audio&msn='.$erro;
		else
			$urlRedirecionamento = '../admin/?telas=servico-com-audio&msn='.$erro;

		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
	}



	//alterar o registro
	if($_POST['acao']=="editServico"){
		include_once("../funcoes/geral.php");
		require_once('../funcoes/uploadArquivo.php');
		$servico = new Servico();
		$cad = new ManipulateData();
		
		//recupera os valores do formulario
		$idAlteracao = $_POST["idAlteracao"];
		$audio = addslashes($_POST["audio"]);

		$video = addslashes($_POST["video"]);

		$nome = addslashes($_POST["nome"]);
		$status = addslashes($_POST["status"]);
		$descricao = addslashes($_POST["descricao"]);
		$descricaointerna = addslashes($_POST["descricaointerna"]);
		$dataAlteracao = date("Y-m-d H:i:s");
		
		//upload da imagem
		if($_FILES['arquivo']['name']){
			deletaArquivo($_POST['arquivo_anterior']);//deleta o arquivo anterior
			$arquivo = $_FILES['arquivo'];
 			$arquivoName = $_FILES['arquivo']['name'];
 			$arquivoTemp = $_FILES['arquivo']['tmp_name'];
			$arquivo1 = upload_arquivo($arquivo, $arquivoName, $arquivoTemp);
			if($arquivo1 != "erro upload") 
				$logo = $arquivo1;
		}
		

		//instanciando o objeto de alteracao
		$alt = new ManipulateData();
		$alt->setTable("servico");//envio o nome da tabela
		//enviando os atributos do banco
		$alt->setFields("nome='$nome', video='$video', status='$status', descricao='$descricao', descricaointerna='$descricaointerna', dataAlteracao='$dataAlteracao'");
		//envio o campo de referente ao id de alteracao
		$alt->setFieldId("id");
		//envio o valor de referente ao id de alteracao
		$alt->setValueId($idAlteracao);
		//efetuando a alteracao
		$alt->update();
		$erro = base64_encode($alt->getStatus());
		
		if($logo){
			$alt->setTable("servico");//envio o nome da tabela
			//enviando os atributos do banco
			$alt->setFields("logo='$logo'");
			//envio o campo de referente ao id de alteracao
			$alt->setFieldId("id");
			//envio o valor de referente ao id de alteracao
			$alt->setValueId($idAlteracao);
			//efetuando a alteracao
			$alt->update();
		}
		
		if($_POST['categoria-servico']){

			$servico->setId($idAlteracao);
			$servico->deleteServicoCategoria();
			foreach ($_POST['categoria-servico'] as $categoria_servico_id) {
				$cad->setTable("servico_categoria");
				$cad->setFields("servico_id,categoria_servico_id");
				$cad->setDados("'$idAlteracao','$categoria_servico_id'");
				$cad->insert();
			}
		}

		if($audio=='SEM')
			$urlRedirecionamento = '../admin/?telas=servico-sem-audio&id='.$idAlteracao.'&msn='.$erro;
		else
			$urlRedirecionamento = '../admin/?telas=servico-com-audio&id='.$idAlteracao.'&msn='.$erro;
		
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
		
	}
	
	//salvar ordem de servico
	if($_POST['acao']=="salvarOrdemDeServico"){

		if($_POST['posicao']){

			foreach ($_POST['posicao'] as $idServico => $posicao) {
				//instanciando o objeto de alteracao
				$alt = new ManipulateData();
				$alt->setTable("servico");//envio o nome da tabela
				//enviando os atributos do banco
				$alt->setFields("posicao='$posicao'");
				//envio o campo de referente ao id de alteracao
				$alt->setFieldId("id");
				//envio o valor de referente ao id de alteracao
				$alt->setValueId($idServico);
				//efetuando a alteracao
				$alt->update();
			}
			$erro = base64_encode("alterado");
		}

		$urlRedirecionamento = '../admin/?telas=ordenar-servicos&msn='.$erro;
		
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
		
	}

	
	if($_POST['acao']=="excluir-logo"){
		$exc = new Servico();
		$exc->setId($_POST['idImagem']);
		$exc->excluirArquivo();
	}
?>

