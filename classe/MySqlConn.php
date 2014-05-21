<?php 
/*************************************************************************************
**	CLASSE EM PHP QUE FAZ A CONEXAOO COM O BANCO DE DADOS MYSQL VERSAO 1.0
**	DESENVOLVIDO POR: FERNANDO N VICENTE
**	ESTA CLASSE SAO PODERAO SER USANDO EM MODO DE HERANÃ‡A...
**	CLASSE ABSTRATA PARA CONEXAO COM BANCO DE DADOS.
**************************************************************************************/
abstract class mySqlConn{

	protected $host, $user, $pass, $dba, $conn, $sql, $qr, $data, $status, $totalFields, $error, $sql2, $qr2;
	
	//mÃ©todo que incializa automaticamente as variaveis de conexao

/*
	// SERVIDOR ANTIGO
	public function __construct(){
		$this->host = "localhost";
		$this->user = "root";
		$this->pass = ""; 
		$this->dba = "talk";	 
		self::connect(); // eexecuta o metodo de conexao automaticamente ao herdar a classe
	}
*/	
	

	// // SERVIDOR NOVO
	public function __construct(){
		$this->host = "mysql06.talksat.com.br";
		$this->user = "radiocensura7";
		$this->pass = "h4MzZJii0AyX"; 
		$this->dba = "radiocensura7";	 
		self::connect(); // eexecuta o metodo de conexao automaticamente ao herdar a classe
	}

				
	//metodo utilizando para efetuar a conexao com o banco de dados
	protected function connect(){
		$this->conn = @mysql_connect($this->host, $this->user, $this->pass) or die 
											("<b><center>Erro ao acessar banco de dados </b></center><br />".mysql_error());
		mysql_set_charset('utf8');
		$this->dba = @mysql_select_db($this->dba) or die 
											("<b><center>Erro ao selecionar banco de dados: </b></center><br />".mysql_error());
	}
	// metodo utilizando para executar comandos SQL
	protected function execSQL($sql){
		$this->qr = @mysql_query($sql) or die ("<b><center>Erro ao Executar o Query: $sql - </b></center><br />".mysql_error());
		return $this->qr;
	}
	
	// metodo que executa e lista dados do banco de dados
	protected function listQr($qr){
		$this->data = @mysql_fetch_assoc($qr);
		return $this->data;
	}

	// metodo que lista a quantidade de dados encontrados no query
	protected function countData($qr){
		$this->totalFields = mysql_num_rows($qr);
		return $this->totalFields;
	}
	
	protected function resultsAll($query){
		$this->dadosGerados = self::listQr($query);
		return $this->dadosGerados;
	}
	public function getQuantidadeData($sql){
		$this->sql = $sql;
		$this->qr = self::execSql($this->sql);
		return mysql_num_rows($this->qr);
	}
}
?>
