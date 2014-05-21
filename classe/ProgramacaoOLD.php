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

class Programacao extends CriaPaginacao{

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
	
	public function setIdServico($x){
		$this->idServico = $x;
	}
	
	public function setIdCategoriaServico($x){
		$this->idCategoriaServico = $x;
	}
	
	public function setTipoProgramacao($x){
		$this->tipoProgramacao = $x;
	}
	
	

	//------------------------------------------------------------------------------------------------------

	public function getPaginas(){
		return $this->strNumPagina = $x;
	}

	public function getId(){ 
		return $this->id;
	}
	public function getStatus(){ 
		return $this->status;
	}
	public function getTipoProgramacao(){ 
		return $this->tipoProgramacao;
	}
	public function getServicoId(){ 
		return $this->servicoId;
	}
	public function getCategoriaServicoId(){ 
		return $this->categoriaServicoId;
	}
	public function getNomeProgramacao(){ 
		return $this->nomeProgramacao;
	}
	public function getDescricao(){ 
		return $this->descricao;
	}
	public function getSegmentacao(){ 
		return $this->segmentacao;
	}
	public function getIndicacaodehorario(){ 
		return $this->indicacaodehorario;
	}
	public function getExecucoesdiarias(){ 
		return $this->execucoesdiarias;
	}
	public function getTempo(){ 
		return $this->tempo;
	}
	public function getDistribuicaonagrade(){ 
		return $this->distribuicaonagrade;
	}
	public function getIndicativodeintervalo(){ 
		return $this->indicativodeintervalo;
	}
	public function getApresentacao(){ 
		return $this->apresentacao;
	}
	public function getAudio1(){ 
		return $this->audio1;
	}
	public function getAudio2(){ 
		return $this->audio2;
	}
	public function getAudio3(){ 
		return $this->audio3;
	}
	public function getAudio4(){ 
		return $this->audio4;
	}
	public function getAudio5(){ 
		return $this->audio5;
	}

	//------------------------------------------------------------------------------------------------------

	//lista o programacao no admin
	public function geraLisProgramacao(){ 
	
		$sql = "
			SELECT p.id, p.status, p.tipo_programacao, p.servico_id, s.nome AS nomeServico, p.categoria_servico_id, cs.nome AS nomeCategoriaServico, 
			p.nome AS nomeProgramacao, p.descricao, p.segmentacao, p.indicacaodehorario, p.execucoesdiarias, p.tempo, distribuicaonagrade, p.indicativodeintervalo, p.apresentacao, 
			p.audio1, p.audio2, p.audio3, p.audio4, p.audio5
			FROM servico_programacao AS p
			INNER JOIN servico AS s ON s.id = p.servico_id
			INNER JOIN categoria_servico AS cs ON cs.id = p.categoria_servico_id
			WHERE s.audio = 'COM'
		";
		if($this->strCampoPesquisa)
			$sql .= " AND p.nome LIKE '%$this->strCampoPesquisa%'";
		
		$sql .= " ORDER BY p.nome";
	

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
		            	<td>'.$dados["nomeServico"].'</td>
		                <td>'.$dados["nomeCategoriaServico"].'</td>
		                <td>'.$dados["nomeProgramacao"].'</td>
		                <td class="tamanho1"><a href="?telas=nova-programacao-servico&idAlteracao='.$dados["id"].'&acao=alterar"><img src="img/bteditar.png" width="55" height="17" /></a></td>
		                <td class="tamanho1"><a href="javascript:void(0);" class="excluirRegistro" id="'.$dados["id"].'"><img src="img/btexcluir.png" width="55" height="17" /></a></td>
		            </tr>
				';
				self::setContador($contador);
			}
		}
	}
	
	
	
	//lista programacao pelo id
	public function geraDadosIdProgramacao(){

		$sql = "
			SELECT p.id, p.status, p.tipo_programacao, p.servico_id, s.nome AS nomeServico, p.categoria_servico_id, cs.nome AS nomeCategoriaServico, 
			p.nome AS nomeProgramacao, p.descricao, p.segmentacao, p.indicacaodehorario, p.execucoesdiarias, p.tempo, distribuicaonagrade, p.indicativodeintervalo, p.apresentacao, 
			p.audio1, p.audio2, p.audio3, p.audio4, p.audio5
			FROM servico_programacao AS p
			INNER JOIN servico AS s ON s.id = p.servico_id
			INNER JOIN categoria_servico AS cs ON cs.id = p.categoria_servico_id
			WHERE s.audio = 'COM'
		";
		if($this->id)
			$sql .= " AND p.id = ".$this->id;

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->id = $dados["id"];
		$this->status = $dados["status"];
		$this->tipoProgramacao = $dados["tipo_programacao"];	
		$this->servicoId = $dados["servico_id"];	
		$this->categoriaServicoId = $dados["categoria_servico_id"];
		$this->nomeProgramacao = $dados["nomeProgramacao"];
		$this->descricao = $dados["descricao"];
		$this->segmentacao = $dados["segmentacao"];
		$this->indicacaodehorario = $dados["indicacaodehorario"];	
		$this->execucoesdiarias = $dados["execucoesdiarias"];	
		$this->tempo = $dados["tempo"];
		$this->distribuicaonagrade = $dados["distribuicaonagrade"];
		$this->indicativodeintervalo = $dados["indicativodeintervalo"];
		$this->apresentacao = $dados["apresentacao"];	
		$this->audio1 = $dados["audio1"];	
		$this->audio2 = $dados["audio2"];
		$this->audio3 = $dados["audio3"];
		$this->audio4 = $dados["audio4"];
		$this->audio5 = $dados["audio5"];	

	}
	
	public function existeTipoProgramacao(){ 

		$sql = "
			SELECT *
			FROM servico_programacao
			WHERE servico_id = $this->idServico
			AND categoria_servico_id = $this->idCategoriaServico
			AND tipo_programacao = '$this->tipoProgramacao'
		";
		
		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 

		if($qtRegistros > 0)
			return true;
		else
			return false;
	}
	
	public function getListProgramacao(){ 


		$sql = "
			SELECT p.id, p.status, p.tipo_programacao, p.servico_id, s.nome AS nomeServico, p.categoria_servico_id, cs.nome AS nomeCategoriaServico, 
			p.nome AS nomeProgramacao, p.descricao, p.segmentacao, p.indicacaodehorario, p.execucoesdiarias, p.tempo, distribuicaonagrade, p.indicativodeintervalo, p.apresentacao, 
			p.audio1, p.audio2, p.audio3, p.audio4, p.audio5
			FROM servico_programacao AS p
			INNER JOIN servico AS s ON s.id = p.servico_id
			INNER JOIN categoria_servico AS cs ON cs.id = p.categoria_servico_id
			WHERE s.audio = 'COM'
			AND p.servico_id = $this->idServico
			AND p.categoria_servico_id = $this->idCategoriaServico
			AND p.tipo_programacao = '$this->tipoProgramacao'
			AND p.status = 'A'
			ORDER BY p.nome
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros > 0){
			while($dados = self::resultsAll($this->qr)){
				
				$ativo = "";
				if($dados['id'] == $this->id)
					$ativo = "ativo";

				$link = URL.'servicos/'.criarSlug($dados['nomeServico']).'/'.criarSlug($dados['nomeCategoriaServico']).'/'.criarSlug($dados['nomeProgramacao']);

				echo '<li><a href="'.$link.'" title="'.$dados['nomeProgramacao'].'" class='.$ativo.'>'.$dados['nomeProgramacao'].'</a></li>';

			}
		}

	}

	public function getAcessoDiretoProgramacao(){ 


		$sql = "
			SELECT s.nome AS nomeServico, cs.nome AS nomeCategoriaServico, p.nome AS nomeProgramacao
			FROM servico_programacao AS p
			INNER JOIN servico AS s ON s.id = p.servico_id
			INNER JOIN categoria_servico AS cs ON cs.id = p.categoria_servico_id
			WHERE s.audio = 'COM'
			AND p.servico_id = $this->idServico
			AND p.status = 'A'
			ORDER BY p.id
			LIMIT 1 
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro
		
		if($qtRegistros > 0){
			while($dados = self::resultsAll($this->qr)){

				$link = URL.'servicos/'.criarSlug($dados['nomeServico']).'/'.criarSlug($dados['nomeCategoriaServico']).'/'.criarSlug($dados['nomeProgramacao']);

			}
		return $link;
		}

	}

	public function getAcessoDiretoProgramacaoPorIds(){ 


		$sql = "
			SELECT p.servico_id, p.categoria_servico_id, p.id
			FROM servico_programacao AS p
			INNER JOIN servico AS s ON s.id = p.servico_id
			INNER JOIN categoria_servico AS cs ON cs.id = p.categoria_servico_id
			WHERE s.audio = 'COM'
			AND p.servico_id = $this->idServico
			AND p.status = 'A'
			ORDER BY cs.nome	
			LIMIT 1 
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro
		
		if($qtRegistros > 0){
			while($dados = self::resultsAll($this->qr)){

				$ids['idCategoriaServico'] = $dados['categoria_servico_id'];
				$ids['idProgramacao'] = $dados['id'];

			}
		return $ids;
		}

	}
}

//------acoes------------------------------------------------------------------------------------------------------



	//cadastrar o registro
	if(isset($_POST["cadastrar"])){
		include_once("../funcoes/geral.php");

		//recupera os valores do formulario		
		$status = addslashes($_POST["status"]);
		$tipoProgramacao = addslashes($_POST["tipoProgramacao"]);
		$servico = addslashes($_POST["servico"]);
		$categoria = addslashes($_POST["categoria"]);
		$nome = addslashes($_POST["nome"]);
		$descricao = addslashes($_POST["descricao"]);
		$segmentacao = addslashes($_POST["segmentacao"]);
		$indicacaodehorario = addslashes($_POST["indicacaodehorario"]);
		$execucoesdiarias = addslashes($_POST["execucoesdiarias"]);
		$tempo = addslashes($_POST["tempo"]);
		$distribuicaonagrade = addslashes($_POST["distribuicaonagrade"]);
		$indicativodeintervalo = addslashes($_POST["indicativodeintervalo"]);
		$apresentacao = addslashes($_POST["apresentacao"]);
		$audio1 = addslashes($_POST["audio1"]);
		$audio2 = addslashes($_POST["audio2"]);
		$audio3 = addslashes($_POST["audio3"]);
		$audio4 = addslashes($_POST["audio4"]);
		$audio5 = addslashes($_POST["audio5"]);
		$dataCadastro = date("Y-m-d H:i:s");
		


		//instanciando o objeto de cadastro
		$cad = new ManipulateData();
		$cad->setTable("servico_programacao");
		$cad->setFields("status,tipo_programacao,servico_id,categoria_servico_id,nome,descricao,segmentacao,
		indicacaodehorario,execucoesdiarias,tempo,distribuicaonagrade,indicativodeintervalo,apresentacao,
		audio1,audio2,audio3,audio4,audio5,dataCadastro");
		$cad->setDados("'$status','$tipoProgramacao','$servico','$categoria','$nome','$descricao','$segmentacao',
		'$indicacaodehorario','$execucoesdiarias','$tempo','$distribuicaonagrade','$indicativodeintervalo','$apresentacao',
		'$audio1','$audio2','$audio3','$audio4','$audio5','$dataCadastro'");
		$cad->insert();
		$idRegistro = $cad->getRetornaIdCadastro(); 
		$erro = base64_encode($cad->getStatus());
		
		$urlRedirecionamento = '../admin/?telas=nova-programacao-servico&msn='.$erro;

		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}

	//alterar o registro
	if(isset($_POST["alterar"])){
		include_once("../funcoes/geral.php");
		
		//recupera os valores do formulario
		$idAlteracao = $_POST["idAlteracao"];					
		$status = addslashes($_POST["status"]);
		$tipoProgramacao = addslashes($_POST["tipoProgramacao"]);
		$servico = addslashes($_POST["servico"]);
		$categoria = addslashes($_POST["categoria"]);
		$nome = addslashes($_POST["nome"]);
		$descricao = addslashes($_POST["descricao"]);
		$segmentacao = addslashes($_POST["segmentacao"]);
		$indicacaodehorario = addslashes($_POST["indicacaodehorario"]);
		$execucoesdiarias = addslashes($_POST["execucoesdiarias"]);
		$tempo = addslashes($_POST["tempo"]);
		$distribuicaonagrade = addslashes($_POST["distribuicaonagrade"]);
		$indicativodeintervalo = addslashes($_POST["indicativodeintervalo"]);
		$apresentacao = addslashes($_POST["apresentacao"]);
		$audio1 = addslashes($_POST["audio1"]);
		$audio2 = addslashes($_POST["audio2"]);
		$audio3 = addslashes($_POST["audio3"]);
		$audio4 = addslashes($_POST["audio4"]);
		$audio5 = addslashes($_POST["audio5"]);
		$dataAlteracao = date("Y-m-d H:i:s");

		//instanciando o objeto de alteracao
		$alt = new ManipulateData();
		$alt->setTable("servico_programacao");//envio o nome da tabela
		//enviando os atributos do banco
		$alt->setFields("status='$status', tipo_programacao='$tipoProgramacao', servico_id='$servico', 
		categoria_servico_id='$categoria', nome='$nome', descricao='$descricao', segmentacao='$segmentacao', indicacaodehorario='$indicacaodehorario',
		execucoesdiarias='$execucoesdiarias', tempo='$tempo', distribuicaonagrade='$distribuicaonagrade',
		indicativodeintervalo='$indicativodeintervalo', apresentacao='$apresentacao', audio1='$audio1',
		audio2='$audio2', audio3='$audio3', audio4='$audio4', audio5='$audio5',	dataAlteracao='$dataAlteracao'");
		//envio o campo de referente ao id de alteracao
		$alt->setFieldId("id");
		//envio o valor de referente ao id de alteracao
		$alt->setValueId($idAlteracao);
		//efetuando a alteracao
		$alt->update();
		$erro = base64_encode($alt->getStatus());
		
		$urlRedirecionamento = '../admin/?telas=nova-programacao-servico&idAlteracao='.$idAlteracao.'&acao=alterar&msn='.$erro;
		
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}

	//excluir o registro
	if(isset($_POST['id'])){

		$itemExclusao = $_POST['id'];

		//deleta imagens da noticia
		$conteudo = new Programacao();

		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("servico_programacao");
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

?>

