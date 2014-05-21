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

class CategoriaServico extends CriaPaginacao{

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
	
	public function setIdServico($id){
		$this->idServico = $id;
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

	public function getNome(){ 
		return $this->nome;
	}

	//------------------------------------------------------------------------------------------------------

	//lista no admin
	public function geraLisCategoriaServico(){ 
	
		$sql = "
			SELECT id,nome
			FROM categoria_servico
		";
		if($this->strCampoPesquisa)
			$sql .= " WHERE nome LIKE '%$this->strCampoPesquisa%'";
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
		                <td class="tamanho1"><a href="?telas=nova-categoria-servico&idAlteracao='.$dados["id"].'&acao=alterar"><img src="img/bteditar.png" width="55" height="17" /></a></td>
		                <td class="tamanho1"><a href="javascript:void(0);" class="excluirRegistro" id="'.$dados["id"].'"><img src="img/btexcluir.png" width="55" height="17" /></a></td>
		            </tr>
				';
				self::setContador($contador);
			}
		}
	}
	
	//lista pelo id
	public function geraDadosIdCategoriaServico(){

		$sql = "
			SELECT id,nome
			FROM categoria_servico
			WHERE id = $this->id;
		";

		$qr = self::execSql($sql);
		$dados = self::listQr($qr);

		$this->id = $dados["id"];
		$this->nome = $dados["nome"];
	}
	
	public function checkboxCategoriaServico(){ 
		$categoriaServico = new CategoriaServico();
		include_once("../funcoes/geral.php");
		$sql = "
			SELECT id,nome
			FROM categoria_servico
			ORDER BY nome
		";
		
		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		while($dados = self::resultsAll($this->qr)){
			if($this->idServico)
				$checked = $categoriaServico->verificaCheckboxCategoriaServico($this->idServico,$dados['id']);

			echo'<p><input type="checkbox" value="'.$dados['id'].'" name="categoria-servico[]" '.$checked.'> - '.$dados['nome'].'</p>';
		}
	}
	
	public function verificaCheckboxCategoriaServico($idServico,$idCategoriaServico){ 

		$sql = "
			SELECT servico_id,categoria_servico_id
			FROM servico_categoria
			WHERE servico_id = $idServico
			AND categoria_servico_id = $idCategoriaServico
		";
		
		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);	
		$qtRegistros = $this->getQuantidadeData($sql); // retorna a quantidade de registro	 
		if($qtRegistros){
			$checked = 'checked="checked"';
		}
		return $checked;
	}

}

//------acoes------------------------------------------------------------------------------------------------------



	//cadastrar o registro
	if(isset($_POST["cadastrar"])){
		include_once("../funcoes/geral.php");

		//recupera os valores do formulario		
		$nome = addslashes($_POST["nome"]);

		//instanciando o objeto de cadastro
		$cad = new ManipulateData();
		$cad->setTable("categoria_servico");
		$cad->setFields("nome");
		$cad->setDados("'$nome'");
		$cad->insert();
		$idRegistro = $cad->getRetornaIdCadastro(); 
		$erro = base64_encode($cad->getStatus());
		
		$urlRedirecionamento = '../admin/?telas=nova-categoria-servico&msn='.$erro;

		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}

	//alterar o registro
	if(isset($_POST["alterar"])){
		include_once("../funcoes/geral.php");
		
		//recupera os valores do formulario
		$idAlteracao = $_POST["idAlteracao"];					
		$nome = addslashes($_POST["nome"]);

		//instanciando o objeto de alteracao
		$alt = new ManipulateData();
		$alt->setTable("categoria_servico");//envio o nome da tabela
		//enviando os atributos do banco
		$alt->setFields("nome='$nome'");
		//envio o campo de referente ao id de alteracao
		$alt->setFieldId("id");
		//envio o valor de referente ao id de alteracao
		$alt->setValueId($idAlteracao);
		//efetuando a alteracao
		$alt->update();
		$erro = base64_encode($alt->getStatus());

		
		$urlRedirecionamento = '../admin/?telas=nova-categoria-servico&idAlteracao='.$idAlteracao.'&acao=alterar&msn='.$erro;
		
		echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=$urlRedirecionamento'>";

	}

	//excluir o registro
	if(isset($_POST['id'])){

		$itemExclusao = $_POST['id'];

		//instanciando o objeto de exclusao
		$exc = new ManipulateData();
		//envio o nome da tabela
		$exc->setTable("categoria_servico");
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

