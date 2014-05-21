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

class Empresa extends CriaPaginacao{

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
	
	public function setCodigoPais($x){
		$this->codigoPais = $x;
	}
	
	public function setNomeRegiao($x){
		$this->nomeRegiao = $x;
	}
		
	//------------------------------------------------------------------------------------------------------
	public function getPaginas(){
		return $this->strNumPagina = $x;
	}

	public function getIdAlteracao(){ 
		return $this->idAlteracao;
	}
	
	public function getStatusId(){ 
		return $this->statusId;
	}

	public function getFantasia(){ 
		return $this->fantasia;
	}

	public function getSintonia(){ 
		return $this->sintonia;
	}

	public function getOutorgaId(){ 
		return $this->outorga_id;
	}
	
	public function getOutorgaNome(){ 
		return $this->outorga_nome;
	}

	public function getPrefixo(){ 
		return $this->prefixo;
	}
	
	public function getRazao(){ 
		return $this->razao;
	}

	public function getCnpj(){ 
		return $this->cnpj;
	}

	public function getPaisId(){ 
		return $this->pais_id;
	}
	
	public function getPaisNome(){ 
		return $this->pais_nome;
	}

	public function getEstadoId(){ 
		return $this->estado_id;
	}
	
	public function getEstadoNome(){ 
		return $this->estado_nome;
	}

	public function getCidade(){ 
		return $this->cidade;
	}
	public function getTel(){ 
		return $this->tel;
	}

	public function getEndereco(){ 
		return $this->endereco;
	}

	public function getBairro(){ 
		return $this->bairro;
	}

	public function getNum(){ 
		return $this->num;
	}

	public function getCep(){ 
		return $this->cep;
	}

	public function getNomeAlteracao(){ 
		return $this->nomeAlteracao;
	}

	public function getDiretorcomercial(){ 
		return $this->diretorcomercial;
	}

	public function getMailcomercial(){ 
		return $this->mailcomercial;
	}

	public function getDiretorartistico(){ 
		return $this->diretorartistico;
	}

	public function getMailartistico(){ 
		return $this->mailartistico;
	}

	public function getMsn(){ 
		return $this->msn;
	}

	public function getSite(){ 
		return $this->site;
	}

	public function getNomeContato(){ 
		return $this->nomeContato;
	}

	public function getServico(){ 
		return $this->servico;
	}

	public function getOnde(){ 
		return $this->onde;
	}

	public function getNecessidade(){ 
		return $this->necessidade;
	}
	
	public function getTelefoneDiretorGeral(){ 
		return $this->telefoneDiretorGeral;
	}
	
	public function getTelefoneDiretorArtistico(){ 
		return $this->telefoneDiretorArtistico;
	}
	
	public function getObs(){ 
		return $this->obs;
	}


		
	//------------------------------------------------------------------------------------------------------

	//lista a empresa no admin
	public function geraLisEmpresa(){ 
	
		$sql = "
			SELECT e.id,e.fantasia,e.sintonia,e.outorga_id,e.prefixo,e.razao,e.cnpj,e.pais_id,e.estado_id,e.cidade,e.tel,e.endereco,e.bairro,e.num,e.cep,e.diretorcomercial,e.mailcomercial,e.diretorartistico,e.mailartistico,e.msn,e.site,e.nome,e.servico,e.onde,e.necessidade,
			s.id AS statusId,s.imagem AS statusImagem,e.telefoneDiretorGeral,e.telefoneDiretorArtistico,e.obs
			FROM empresa AS e
			INNER JOIN status AS s ON s.id = e.status_id
			WHERE e.dataExclusao IS NULL
		";
		if($this->strCampoPesquisa)
			$sql .= " AND e.fantasia LIKE '%$this->strCampoPesquisa%'";
		if($this->coluna)
			$sql .= " AND e.$this->coluna = $this->ordenacao ORDER BY e.id DESC";
		else	
		 	$sql .= " ORDER BY e.id DESC";

		//echo $sql;
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
				
				$titleStatus = "";
				if($dados["statusId"]==1)
					$titleStatus = "Ativar Cadastro";
				
				$contador ++;
				
				echo'
					<tr '.$class.'>
		            	<td>'.$dados["id"].'</td>
		                <td>'.$dados["fantasia"].'</td>
		                <td>'.$dados["obs"].'</td>
		                <td class="tamanho1"><a href="?telas=nova-empresa&idAlteracao='.$dados["id"].'&acao=alterar"><img src="img/bteditar.png" width="55" height="17" /></a></td>
		                <td class="tamanho1"><a href="javascript:void(0);" class="excluirRegistro" id="'.$dados["id"].'"><img src="img/btexcluir.png" width="55" height="17" /></a></td>
		                ';
						if($dados["statusId"]!=1){
		                	echo '<td class="tamanho"><a href="javascript:void(0);" title="'.$titleStatus.'"><img src="img/'.$dados["statusImagem"].'" /></a></td>';
						}else{
							echo '<td class="tamanho"><a href="javascript:void(0);" class="ativarRegistro" id="'.$dados["id"].'" title="'.$titleStatus.'"><img src="img/'.$dados["statusImagem"].'" /></a></td>';
						}
		        echo '</tr>
				';
				self::setContador($contador);
			}
		}
	}


	public function geraDadosIdEmpresa(){
		$sql = "
			SELECT e.id,e.status_id,e.fantasia,e.sintonia,e.outorga_id,e.prefixo,e.razao,e.cnpj,e.pais_id,e.estado_id,e.cidade,e.tel,e.endereco,e.bairro,e.num,e.cep,e.diretorcomercial,e.mailcomercial,e.diretorartistico,e.mailartistico,e.msn,e.site,e.nome,e.servico,e.onde,e.necessidade,
			o.nome AS outorgaNome, uf.nome AS estadoNome, e.telefoneDiretorGeral,e.telefoneDiretorArtistico, e.obs
			FROM empresa AS e
			INNER JOIN outorga AS o ON o.id = e.outorga_id
			INNER JOIN estados AS uf ON uf.id = e.estado_id
			WHERE e.dataExclusao IS NULL
			";

		if($this->id)
			$sql .= " AND e.id = ".$this->id;

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->idAlteracao = $dados["id"];
		$this->statusId = $dados["status_id"];
		$this->fantasia = $dados["fantasia"];
		$this->sintonia = $dados["sintonia"];
		$this->outorga_id = $dados["outorga_id"];
		$this->outorga_nome = $dados["outorgaNome"];		
		$this->prefixo = $dados["prefixo"];
		$this->razao = $dados["razao"];
		$this->cnpj = $dados["cnpj"];
		$this->pais_id = $dados["pais_id"];
		//$this->pais_nome = $dados["paisNome"];
		$this->estado_id = $dados["estado_id"];
		$this->estado_nome = $dados["estadoNome"];
		$this->cidade = $dados["cidade"];
		$this->tel = $dados["tel"];
		$this->endereco = $dados["endereco"];
		$this->bairro = $dados["bairro"];
		$this->num = $dados["num"];
		$this->cep = $dados["cep"];
		$this->diretorcomercial = $dados["diretorcomercial"];
		$this->mailcomercial = $dados["mailcomercial"];
		$this->diretorartistico = $dados["diretorartistico"];
		$this->mailartistico = $dados["mailartistico"];
		$this->msn = $dados["msn"];
		$this->site = $dados["site"];
		$this->nomeContato = $dados["nome"];
		$this->servico = $dados["servico"];
		$this->onde = $dados["onde"];
		$this->necessidade = $dados["necessidade"];
		$this->telefoneDiretorGeral = $dados["telefoneDiretorGeral"];
		$this->telefoneDiretorArtistico = $dados["telefoneDiretorArtistico"];
		$this->obs = $dados["obs"];
	}	
	
	//verifica se já existe nome/email cadastrado
	public function checkDados(){ 
		
		//deleta a imagem da pasta
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT id, $this->coluna
			FROM empresa
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
	
	//monta as redes
	public function getRede(){ 

		$sql = "
			SELECT e.id,e.fantasia,e.sintonia,e.outorga_id,e.prefixo,e.razao,e.cnpj,e.pais_id,e.estado_id,e.cidade,e.tel,e.endereco,e.bairro,e.num,e.cep,e.diretorcomercial,e.mailcomercial,e.diretorartistico,e.mailartistico,e.msn,e.site,e.nome,e.servico,e.onde,e.necessidade,
			o.nome AS outorgaNome, uf.nome AS estadoNome, r.nome AS nomeRegiao
			FROM empresa AS e
			INNER JOIN outorga AS o ON o.id = e.outorga_id
			INNER JOIN estados AS uf ON uf.id = e.estado_id
			LEFT JOIN regiao AS r ON r.id = uf.regiao_id
			WHERE e.dataExclusao IS NULL
			AND e.status_id = 2
		";
		if($this->codigoPais)
			$sql .= " AND uf.paises_id = $this->codigoPais";
		if($this->nomeRegiao)
			$sql .= " AND r.nome = '$this->nomeRegiao'";
			
		$sql .= " ORDER BY uf.nome, r.nome, e.fantasia";
		
		//echo $sql;	
		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 

		if($qtRegistros > 0){
			echo'
				<table>
		            <thead>
		                <tr>
		                    <td class="tam01">Afiliada</td>
		                    <td>Dial</td>
		                    <td>Cidade</td>
		                </tr>
		            </thead>
				';
			while($dados = self::resultsAll($this->qr)){
				echo'
		                <tr>
		                    <td>'.$dados['fantasia'].'</td>
		                    <td>'.$dados['sintonia'].'</td>
		                    <td>'.$dados['cidade'].'/'.$dados['estadoNome'].'</td>
		                </tr>
				';
			}
			echo' </table>';
		}
	}
}

//------acoes------------------------------------------------------------------------------------------------------

	//cadastrar o registro
	if(isset($_POST["cadastrar"])){

		//recupera os valores do formulario
		$status_id  = $_POST["situacao"];
		$fantasia = addslashes($_POST["fantasia"]);
		$sintonia = addslashes($_POST["sintonia"]);
		$outorga_id = $_POST["outorga"];
		$prefixo = addslashes($_POST["prefixo"]);
		$razao = addslashes($_POST["razao"]);
		$cnpj = addslashes($_POST["cnpj"]);
		$pais_id = $_POST["pais"];
		$estado_id = $_POST["estado"];
		$cidade = addslashes($_POST["cidade"]);
		$tel = $_POST["tel"];
		$endereco = addslashes($_POST["endereco"]);
		$bairro = addslashes($_POST["bairro"]);
		$num = addslashes($_POST["num"]);
		$cep = addslashes($_POST["cep"]);
		$diretorcomercial = addslashes($_POST["diretorcomercial"]);
		$mailcomercial = addslashes($_POST["mailcomercial"]);
		$diretorartistico = addslashes($_POST["diretorartistico"]);
		$mailartistico = addslashes($_POST["mailartistico"]);
		$msn = addslashes($_POST["msn"]);
		$site = addslashes($_POST["site"]);
		$nome = addslashes($_POST["nome"]);
		$servico = addslashes($_POST["servico"]);
		$onde = addslashes($_POST["onde"]);
		$necessidade = addslashes($_POST["necessidade"]);
		$telefoneDiretorGeral= addslashes($_POST["tel1"]);
		$telefoneDiretorArtistico = addslashes($_POST["tel2"]);
		$obs = addslashes($_POST["obs"]);
		$dataCadastro = date("Y-m-d H:m:s");
	
		//instanciando o objeto de cadastro
		$cad = new ManipulateData();
		$cad->setTable("empresa");
		$cad->setFieldId("cnpj"); //aqui é o atributo de pesquisa da tabela, para que não ocorra a duplicação
	
		//verificando se existe registro cadastrado
		if($cad->getDadosDuplicados($cnpj) >= 1){
			$erro = base64_encode("cnpj informado já esta cadastrado!");
		}else{
			$cad->setFields("status_id,fantasia,sintonia,outorga_id,prefixo,razao,cnpj,pais_id,estado_id,cidade,tel,endereco,bairro,num,cep,diretorcomercial,mailcomercial,diretorartistico,mailartistico,msn,site,nome,servico,onde,necessidade,telefoneDiretorGeral,telefoneDiretorArtistico,obs,dataCadastro");
			$cad->setDados("'$status_id','$fantasia','$sintonia','$outorga_id','$prefixo','$razao','$cnpj','$pais_id','$estado_id','$cidade','$tel','$endereco','$bairro','$num','$cep','$diretorcomercial','$mailcomercial','$diretorartistico','$mailartistico','$msn','$site','$nome','$servico','$onde','$necessidade','$telefoneDiretorGeral','$telefoneDiretorArtistico','$obs','$dataCadastro'");
			$cad->insert();
			$erro = base64_encode($cad->getStatus());
		}

		$urlRedirecionamento = '../admin/?telas=lista-de-empresas&msn='.$erro;
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
	}
	//alterar o registro
	if(isset($_POST["alterar"])){

		//recupera os valores do formulario
		$idAlteracao = $_POST["idAlteracao"];
		$status_id = $_POST["situacao"];
		$fantasia = addslashes($_POST["fantasia"]);
		$sintonia = addslashes($_POST["sintonia"]);
		$outorga_id = $_POST["outorga"];
		$prefixo = addslashes($_POST["prefixo"]);
		$razao = addslashes($_POST["razao"]);
		$cnpj = addslashes($_POST["cnpj"]);
		$pais_id = $_POST["pais"];
		$estado_id = $_POST["estado"];
		$cidade = addslashes($_POST["cidade"]);
		$tel = $_POST["tel"];
		$endereco = addslashes($_POST["endereco"]);
		$bairro = addslashes($_POST["bairro"]);
		$num = addslashes($_POST["num"]);
		$cep = addslashes($_POST["cep"]);
		$diretorcomercial = addslashes($_POST["diretorcomercial"]);
		$mailcomercial = addslashes($_POST["mailcomercial"]);
		$diretorartistico = addslashes($_POST["diretorartistico"]);
		$mailartistico = addslashes($_POST["mailartistico"]);
		$msn = addslashes($_POST["msn"]);
		$site = addslashes($_POST["site"]);
		$nome = addslashes($_POST["nome"]);
		$servico = addslashes($_POST["servico"]);
		$onde = addslashes($_POST["onde"]);
		$necessidade = addslashes($_POST["necessidade"]);
		$telefoneDiretorGeral= addslashes($_POST["tel1"]);
		$telefoneDiretorArtistico = addslashes($_POST["tel2"]);
		$obs = addslashes($_POST["obs"]);
		$dataAlteracao = date("Y-m-d H:i:s");
	
		//instanciando o objeto de alteracao
		$alt = new ManipulateData();
		$alt->setTable("empresa");//envio o nome da tabela
			//enviando os atributos do banco
			$alt->setFields("status_id='$status_id',fantasia='$fantasia',sintonia='$sintonia',outorga_id='$outorga_id',prefixo='$prefixo',razao='$razao',cnpj='$cnpj',pais_id='$pais_id',estado_id='$estado_id',cidade='$cidade',tel='$tel',endereco='$endereco',
			bairro='$bairro',num='$num',cep='$cep',diretorcomercial='$diretorcomercial',mailcomercial='$mailcomercial',diretorartistico='$diretorartistico',mailartistico='$mailartistico',msn='$msn',site='$site',nome='$nome',servico='$servico',
			onde='$onde',necessidade='$necessidade', telefoneDiretorGeral='$telefoneDiretorGeral', telefoneDiretorArtistico='$telefoneDiretorArtistico', obs='$obs', dataAlteracao='$dataAlteracao'");
			//envio o campo de referente ao id de alteracao
			$alt->setFieldId("id");
			//envio o valor de referente ao id de alteracao
			$alt->setValueId($idAlteracao);
			//efetuando a alteracao
			$alt->update();
			$erro = base64_encode($alt->getStatus());

		//$urlRedirecionamento = '../admin/?telas=nova-empresa&idAlteracao='.$idAlteracao.'&acao=alterar&msn='.$erro;
		$urlRedirecionamento = '../admin/?telas=lista-de-empresas&msn='.$erro;
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
	}
	
	//excluir o registro
	if(isset($_POST['id'])){

		$itemExclusao = $_POST['id'];
	
		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("empresa");
		//envio o campo de referente ao id de exclusao
		$exc->setFieldId("id");
		//envio o valor de referente ao id de exclusao
		$exc->setValueId($itemExclusao);
		//efetuando a exclusao
		$exc->delete();
		echo $erro = $exc->getStatus();
	}
	
	if($_POST['acao']=="checkDados"){
		$conteudo = new Empresa();
		$conteudo->setColuna($_POST['name']);
		$conteudo->setCampoPesquisa($_POST['value']);
		$conteudo->setId($_POST['idCheck']);
		echo $conteudo->checkDados();
	}
	
	if($_POST['acao']=="ativarRegistro"){
		//instanciando o objeto de alteracao
		$alt = new ManipulateData();
		$alt->setTable("empresa");//envio o nome da tabela
			//enviando os atributos do banco
			$alt->setFields("status_id=2,dataAlteracao='$dataAlteracao'");
			//envio o campo de referente ao id de alteracao
			$alt->setFieldId("id");
			//envio o valor de referente ao id de alteracao
			$alt->setValueId($_POST['idAtivacao']);
			//efetuando a alteracao
			$alt->update();
			echo $erro = $alt->getStatus();
	}
	
	

?>
