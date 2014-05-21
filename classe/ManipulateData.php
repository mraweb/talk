<?php
/*************************************************************************************
**	CLASSE EM PHP QUE FAZ A MANIPULAÃ‡ÃƒO DE DADOS NO BANCO DE DADOS MYSQL VERSÃƒO 1.0
**	CÃ“DIGO LIVRE MANTIDO PELA GNU
**
**	ESTA CLASSE SÃ“ PODERÃ� SER USANDO EM MODO DE HERANÃ‡A...
**
**	CLASSE ABSTRATA PARA CONEXÃƒO COM BANCO DE DADOS.
**************************************************************************************/
include_once("MySqlConn.php");

class ManipulateData extends MySqlConn{
	
	protected $sql, $table, $fields, $dados, $status, $fieldId, $fieldId2, $fieldId3, $fieldEmail, $fieldSenha, $valueId, $valueId2, $atributo; 

	//envia o nome da tabela a ser usada na classe
	public function setTable($t){
		$this->table = $t;
	}
	
	//envia os campos a serem usados na classe
	public function setFields($f){
		$this->fields = $f;
	}
	
	// envia os dados a serem usados na classe
	public function setDados($d){
		$this->dados = $d;
	}
	
	//envia o campo de pesquisa, normalmente o campo cÃ³digo
	public function setFieldId($fi){
		$this->fieldId = $fi;
	}
	
	public function setFieldId2($fi){
		$this->fieldId2 = $fi;
	}
	
	public function setFieldId3($fi){
		$this->fieldId3 = $fi;
	}
	
	public function setAtributo($atr){
		$this->atributo = $atr;
	}
	
	//envia o campo de pesquisa, normalmente o campo email
	public function setFieldEmail($email){
		$this->fieldEmail = $email;
	}
	
	//envia o campo de pesquisa, normalmente o campo email
	public function setFieldSenha($senha){
		$this->fieldSenha = $senha;
	}
	
	// envia os dados a serem cadastrados ou pesquisados
	public function setValueId($vi){
		$this->valueId = $vi;
	}

	// envia os dados a serem cadastrados ou pesquisados
	public function setValueId2($vi){
		$this->valueId2 = $vi;
	}
	
	//recebe o status atual, erros ou acertos
	public function getStatus(){
		return $this->status;
	}
	
	//mÃ©todo que efetua cadastro de dados no banco
	public function insert(){

		if(is_array($this->dados))
			$this->dados = implode('),(', $this->dados); // assim não precisa fazer uma query pra cada inserção...
		
		$this->sql = "INSERT INTO $this->table(
							$this->fields
					  )VALUES(
					  		$this->dados
					  )";
		if(self::execSql($this->sql)){
			$this->status = "Cadastrado com Sucesso!!!";
		}			  
	}
	
	// mÃ©todo que efetua a exclusÃ£o de dados no banco
	public function delete(){
		$this->sql = "DELETE FROM $this->table WHERE $this->fieldId = '$this->valueId'";
		if(self::execSQL($this->sql)){
			$this->status = "Apagado com Sucesso!!!";
		}
	}
	
	// mÃ©todo que faz a alteraÃ§ao de dados no banco
	public function update(){
		$this->sql = "UPDATE $this->table SET
							$this->fields
					  WHERE
					  		$this->fieldId = '$this->valueId'
					  ";
		if(self::execSql($this->sql)){
			$this->status = "Alterado com Sucesso!!!";
		}		
	}

	//mÃ©todo que busca o ultimo cÃ³digo na tabela cadastrada
	public function getLastId(){
		return mysql_insert_id();
	}
	
	//retorna um atributo
	public function getAtributo(){
		$this->sql = "SELECT $this->atributo FROM $this->table WHERE $this->fieldId = '$this->valueId'";
		$this->qr = self::execSql($this->sql);
		$this->data = self::listQr($this->qr);
		return $this->data["$this->atributo"];
	}
	
	//mÃ©todo que busca o ultimo cÃ³digo na tabela cadastrada
	public function getIdPorNome(){
		$this->sql = "SELECT * FROM $this->table";
		$this->qr = self::execSql($this->sql);
		while($prod = self::resultsAll($this->qr)){
			if(criarSlug($prod["nome"])==$this->fieldId){
				$id = $prod["id"];
			}		
		}
		return $id;
	} 
	
	public function getIdPorEmpresa(){
		$this->sql = "SELECT * FROM $this->table";
		$this->qr = self::execSql($this->sql);
		while($prod = self::resultsAll($this->qr)){
			if(criarSlug($prod["nome_fantasia"])==$this->fieldId){
				$id = $prod["id"];
			}		
		}
		return $id;
	}
	
	public function getUmValorTabela(){
		$this->sql = "SELECT * FROM $this->table";
		$this->qr = self::execSql($this->sql);
		while($prod = self::resultsAll($this->qr)){
			if(criarSlug($prod["$this->fieldId2"])==$this->fieldId){
				$item = $prod["$this->atributo"];
			}		
		}
		return $item;
	}
	
	//mÃ©todo que busca o ultimo cÃ³digo na tabela cadastrada
	public function getIdFotoNome(){
		$this->sql = "SELECT * FROM $this->table";
		$this->qr = self::execSql($this->sql);
		while($prod = self::resultsAll($this->qr)){
			if($prod["thumb"]==$this->fieldId){
				$id = $prod["id"];
			}		
		}
		return $id;
	}	

	//dados do plano
	public function getDadosPlano(){
		$this->sql = "SELECT * FROM $this->table WHERE $this->fieldId = '$this->valueId'";
		$this->qr = self::execSql($this->sql);
		while($prod = self::resultsAll($this->qr)){
			
				$_SESSION['planoId'] = $prod["id"];
				$_SESSION['quantidadeFotosPlano'] = $prod["quantidadefotos"];
				$_SESSION['quantidadeCategoriasPlano'] = $prod["quantidadecategorias"];
				$_SESSION['duracaoPlano'] = $prod["duracao"];
									
		}
		
	}

	public function getOrcamentoDados(){
		$this->sql = "SELECT * FROM $this->table WHERE $this->fieldId = '$this->valueId'";
		$this->qr = self::execSql($this->sql);
		while($prod = self::resultsAll($this->qr)){
			
				$orcamentoDados = $prod["nome"].'|'.$prod["telefone"].'|'.$prod["id"];
									
		}
		return $orcamentoDados;
	}
	
	public function getListaProdutosOrcamento(){
		$this->sql = "SELECT * FROM $this->table 
					  WHERE $this->fieldId = '$this->valueId'
					  AND $this->fieldId2 = '$this->valueId2'";
		
		$this->qr = self::execSql($this->sql);
		while($prod2 = self::resultsAll($this->qr)){
			
				$linha .='
				  <tr>
				    <td>'.$prod2["nome_produto"].'</td>
				    <td>'.$prod2["unidade"].'</td>
				  </tr>
				';
									
		}
		return $linha;
	}

	protected function resultsAll($query){
		$this->dadosGerados = self::listQr($query);
		return $this->dadosGerados;
	}
	
	// mÃ©todo que verifica se existem valores duplicados, returna 1 existe 0 nao existe
	public function getDadosDuplicados($valorPesquisado){
		$this->sql = "SELECT $this->fieldId FROM $this->table WHERE $this->fieldId = '$valorPesquisado' AND dataexclusao IS NULL";
		$this->qr = self::execSql($this->sql);
		return self::countData($this->qr);
	}
	
	public function getDadosDuplicadosNewsletter($valorPesquisado){
		$this->sql = "SELECT $this->fieldId FROM $this->table WHERE $this->fieldId = '$valorPesquisado'";
		$this->qr = self::execSql($this->sql);
		return self::countData($this->qr);
	}
	
	public function getDadosDuplicadosProdutos($valorPesquisado,$valorPesquisado2,$valorPesquisado3){
		$this->sql = "SELECT $this->fieldId FROM $this->table 
					  WHERE $this->fieldId = '$valorPesquisado'
					  AND $this->fieldId2 = '$valorPesquisado2' 
					  AND $this->fieldId3 = '$valorPesquisado3'  
					  AND dataexclusao IS NULL";
		$this->qr = self::execSql($this->sql);
		return self::countData($this->qr);
	}
	
	// mÃ©todo que busca o total de dados cadastrado em uma query
	public function getTotalData(){
		$this->sql = "SELECT $this->fieldId FROM $this->table ORDER BY $this->fieldId";
		$this->qr = self::execSql($this->sql);
		return self::countData($this->qr); 
	} 
			
	// mÃ©todo que retorna o id cadastrado
    public function getRetornaIdCadastro(){

        return mysql_insert_id();
    }
}


?>
