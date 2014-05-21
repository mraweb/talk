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

class Cliente extends CriaPaginacao{

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
	
	public function setEmail($x){
		$this->email = $x;
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
	
	public function getEmail(){ 
		return $this->email;
	}
	
	public function getRadio(){ 
		return $this->radio;
	}
	
	public function getCidade(){ 
		return $this->cidade;
	}
	
	public function getEstadoId(){ 
		return $this->estadoId;
	}
	
	public function getTelefone(){ 
		return $this->telefone;
	}
	
	public function getObs(){ 
		return $this->obs;
	}
	
	public function getModalCadastro(){ 
		return $this->modalCadastro;
	}
	

	//------------------------------------------------------------------------------------------------------

	public function geraLisCliente(){ 
	
		$sql = "
			SELECT id,nome,email
			FROM cliente_produto
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
				$res = $contador % 2;
				$class = "";
				if($res==0){
					$class = 'class="cor"';
				}
				
				$contador ++;

				
				echo'
					<tr '.$class.'>
		            	<td>'.$dados["nome"].'</td>
		                <td>'.$dados["email"].'</td>
		                <td class="tamanho1"><a href="?telas=novo-cadastro&idAlteracao='.$dados["id"].'&acao=alterar"><img src="img/bteditar.png" width="55" height="17" /></a></td>
		                <td class="tamanho1"><a href="javascript:void(0);" class="excluirRegistro" id="'.$dados["id"].'"><img src="img/btexcluir.png" width="55" height="17" /></a></td>
		            </tr>
				';
				self::setContador($contador);
			}
		}
	}
	
	public function geraDadosIdCliente(){

		$sql = "
			SELECT id,nome,email,radio,estado_id,cidade,telefone,obs
			FROM cliente_produto
			WHERE dataExclusao IS NULL
		";
		if($this->id)
			$sql .= " AND id = ".$this->id;

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->id = $dados["id"];
		$this->nome = $dados["nome"];
		$this->email = $dados["email"];	
		$this->radio = $dados["radio"];	
		$this->estadoId = $dados["estado_id"];
		$this->cidade = $dados["cidade"];
		$this->telefone = $dados["telefone"];
		$this->obs = $dados["obs"];
	}
	
	public function getStatusModal(){

		$sql = "
			SELECT modal_cadastro
			FROM configuracao
			WHERE id = 1
		";

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->modalCadastro = $dados["modal_cadastro"];
		
	}
	
	public function checkEmail(){ 

		$sql = "
			SELECT id
			FROM cliente_produto
			WHERE dataExclusao IS NULL
			AND email = '$this->email'	
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro

		return $qtRegistros;

	}
	
	public function getClientesExport(){ 
		
		$sql = "
			SELECT cp.id,cp.nome,cp.email,cp.radio,e.sigla as uf,cp.cidade,cp.telefone,cp.obs
			FROM cliente_produto as cp
			INNER JOIN estados as e ON e.id = cp.estado_id
			ORDER BY cp.nome
		";

		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	

		
		while($row = self::resultsAll($this->qr)){
			
			$html .= "
					<tr>
						<td>$row[nome]</td>
						<td>$row[email]</td>
						<td>$row[radio]</td>
						<td>$row[uf]</td>
						<td>$row[cidade]</td>
						<td>$row[telefone]</td>
					</tr>
			";

		}
		
		return $html;
		
	}

}

//------acoes------------------------------------------------------------------------------------------------------



	//cadastrar o registro
	if($_POST["acao"]=='modalCadastro'){
		
		//recupera os valores do formulario		
		$mailcadastro = addslashes($_POST["mailcadastro"]);
		$nomecadastro = addslashes($_POST["nomecadastro"]);
		$radiocadastro = addslashes($_POST["radiocadastro"]);
		$cidade = addslashes($_POST["cidade"]);
		$estado = $_POST["estado"];
		$telcadastro = $_POST["telcadastro"];
		$obs = addslashes($_POST["obs"]);
		$dataCadastro = date("Y-m-d H:i:s");
		

		//instanciando o objeto de cadastro
		$cad = new ManipulateData();
		$cad->setTable("cliente_produto");
		$cad->setFields("nome,email,radio,estado_id,cidade,telefone,dataCadastro");
		$cad->setDados("'$nomecadastro','$mailcadastro','$radiocadastro','$estado','$cidade','$telcadastro','$dataCadastro'");
		$cad->insert();
		$idRegistro = $cad->getRetornaIdCadastro(); 
		$msg = $cad->getStatus() == 'Cadastrado com Sucesso!!!' ? 1 : 0;

		echo $msg;

	}
	
	if(isset($_POST["alterar"])){
		
		//recupera os valores do formulario		
		$idAlteracao = $_POST["idAlteracao"];
		$mailcadastro = addslashes($_POST["mailcadastro"]);
		$nomecadastro = addslashes($_POST["nomecadastro"]);
		$radiocadastro = addslashes($_POST["radiocadastro"]);
		$cidade = addslashes($_POST["cidade"]);
		$estado = $_POST["estado"];
		$telcadastro = $_POST["telcadastro"];
		$obs = addslashes($_POST["obs"]);
		$dataAlteracao = date("Y-m-d H:i:s");
		

		//instanciando o objeto de alteracao
		$alt = new ManipulateData();
		$alt->setTable("cliente_produto");//envio o nome da tabela
		//enviando os atributos do banco
		$alt->setFields("nome='$nomecadastro', email='$mailcadastro', radio='$radiocadastro', estado_id='$estado', cidade='$cidade', telefone='$telcadastro', obs='$obs', dataAlteracao='$dataAlteracao'");
		//envio o campo de referente ao id de alteracao
		$alt->setFieldId("id");
		//envio o valor de referente ao id de alteracao
		$alt->setValueId($idAlteracao);
		//efetuando a alteracao
		$alt->update();
		$erro = base64_encode($alt->getStatus());

		$urlRedirecionamento = '../admin/?telas=novo-cadastro&idAlteracao='.$idAlteracao.'&acao=alterar&msn='.$erro;
		
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}
	
	if($_POST["acao"]=='checkEmail'){
		$exc = new Cliente();
		$exc->setEmail($_POST['mailcadastro']);
		echo $exc->checkEmail();
		
	}
	
	//excluir o registro
	if(isset($_POST['id'])){

		$itemExclusao = $_POST['id'];

		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("cliente_produto");
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
	
	if($_POST["acao"]=='statusModalCadastro'){
		
		//recupera os valores do formulario		
		$ativo_inativo = $_POST["value"];
				
		//instanciando o objeto de alteracao
		$alt = new ManipulateData();
		$alt->setTable("configuracao");//envio o nome da tabela
		//enviando os atributos do banco
		$alt->setFields("modal_cadastro='$ativo_inativo'");
		//envio o campo de referente ao id de alteracao
		$alt->setFieldId("id");
		//envio o valor de referente ao id de alteracao
		$alt->setValueId(1);
		//efetuando a alteracao
		$alt->update();
		if($alt->getStatus()=='Alterado com Sucesso!!!'){
			echo '1';
		}

	}

?>

