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

class Administrador extends CriaPaginacao{

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
		
	//------------------------------------------------------------------------------------------------------
	public function getPaginas(){
		return $this->strNumPagina = $x;
	}

	public function getIdAlteracao(){ 
		return $this->idAlteracao;
	}

	public function getNomeAlteracao(){ 
		return $this->nomeAlteracao;
	}	

	public function getEmailAlteracao(){ 
		return $this->emailAlteracao;
	}
	//------------------------------------------------------------------------------------------------------

	//lista o administrador no admin
	public function geraLisAdministrador(){ 
	
		$sql = "
			SELECT id,nome,email
			FROM administrador
			WHERE dataExclusao IS NULL
		";
		if($this->strCampoPesquisa)
			$sql .= " AND nome LIKE '%$this->strCampoPesquisa%'";
		if($this->coluna)
			$sql .= " ORDER BY $this->coluna $this->ordenacao";
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
		                <td class="tamanho1"><a href="?telas=novo-usuario&idAlteracao='.$dados["id"].'&acao=alterar"><img src="img/bteditar.png" width="55" height="17" /></a></td>
		                <td class="tamanho1"><a href="javascript:void(0);" class="excluirRegistro" id="'.$dados["id"].'"><img src="img/btexcluir.png" width="55" height="17" /></a></td>
		            </tr>
				';
				self::setContador($contador);
			}
		}
	}


	public function geraDadosIdAdministrador(){
		$sql = "
			SELECT id,nome,email
			FROM administrador
			WHERE dataExclusao IS NULL
			";

		if($this->id)
			$sql .= " AND id = ".$this->id;

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->idAlteracao = $dados["id"];
		$this->nomeAlteracao = $dados["nome"];
		$this->emailAlteracao = $dados["email"];
	}	

	

}

//------acoes------------------------------------------------------------------------------------------------------

	//cadastrar o registro
	if(isset($_POST["cadastrar"])){

		//recupera os valores do formulario
		$nome = $_POST["nome"];
		$email = $_POST["email"];
		$senha = md5($_REQUEST["senha"]);
		//$senha = $_POST["senha"];
		$dataCadastro = date("Y-m-d H:m:s");
	
		//instanciando o objeto de cadastro
		$cad = new ManipulateData();
		$cad->setTable("administrador");
		$cad->setFieldId("email"); //aqui é o atributo de pesquisa da tabela, para que não ocorra a duplicação
	
		//verificando se existe registro cadastrado
		if($cad->getDadosDuplicados($email) >= 1){
			$erro = base64_encode("email informado já esta cadastrado!");
		}else{
			$cad->setFields("nome,email,senha,dataCadastro");
			$cad->setDados("'$nome','$email','$senha','$dataCadastro'");
			$cad->insert();
			$erro = base64_encode($cad->getStatus());
		}

	$urlRedirecionamento = '../admin/?telas=novo-usuario&msn='.$erro;
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
	}
	//alterar o registro
	if(isset($_POST["alterar"])){

		//recupera os valores do formulario
		$idAlteracao = $_POST["idAlteracao"];
		$nome = $_POST["nome"];
		$email = $_POST["email"];
		$dataAlteracao = date("Y-m-d H:i:s");
	
		//instanciando o objeto de alteracao
		$alt = new ManipulateData();
		$alt->setTable("administrador");//envio o nome da tabela
			//enviando os atributos do banco
			$alt->setFields("nome='$nome', email='$email', dataAlteracao='$dataAlteracao'");
			//envio o campo de referente ao id de alteracao
			$alt->setFieldId("id");
			//envio o valor de referente ao id de alteracao
			$alt->setValueId($idAlteracao);
			//efetuando a alteracao
			$alt->update();
			$erro = base64_encode($alt->getStatus());
		
		if($_POST["senha"] != ""){

			$senha = md5($_POST["senha"]);
			//enviando os atributos do banco
			$alt->setFields("senha='$senha'");
			//envio o campo de referente ao id de alteracao
			$alt->setFieldId("id");
			//envio o valor de referente ao id de alteracao
			$alt->setValueId($idAlteracao);
			//efetuando a alteracao
			$alt->update();
		 
		}

		$urlRedirecionamento = '../admin/?telas=novo-usuario&idAlteracao='.$idAlteracao.'&acao=alterar&msn='.$erro;
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";
	}
	
	//excluir o registro
	if(isset($_POST['id'])){

		$itemExclusao = $_POST['id'];
	
		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("administrador");
		//envio o campo de referente ao id de exclusao
		$exc->setFieldId("id");
		//envio o valor de referente ao id de exclusao
		$exc->setValueId($itemExclusao);
		//efetuando a exclusao
		$exc->delete();
		echo $erro = $exc->getStatus();
	}
		
	
	

?>
