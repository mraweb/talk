<?php
	include_once("MySqlConn.php");
	
	class Login extends MySqlConn{
	
		private $usuario, $senha;
		
		public function setUsuario($usr){
			$this->usuario = $usr;
		}
		
		public function setSenha($snh){
			$this->senha = $snh;
		}
		
		public function loginAdministrador(){
			$sql = "
				SELECT id, nome, email
				FROM administrador
				WHERE dataExclusao IS NULL
				AND email = '".$this->usuario."' 
				AND senha = '".$this->senha."'
			";
			 
			$qr = self::execSql($sql);
			$total = self::countData($qr);

			if($total > 1){
				echo "Dados Duplicados, login não efetuado, entre em contato com administrador";
			}elseif($total <= 0){
				echo "Login ou Senha Incorreto";
			}elseif($total == 1){
				session_start();
				$dados = self::listQr($qr);	//resgata dados do sql
				$_SESSION["LOGADO"] = "TRUE"; //carrego a sessao logado
				$_SESSION["idAdministrador"] = $dados["id"]; //carrego a sessao idPessoa
				$_SESSION["nomeAdministrador"] = $dados["nome"]; //carrego a sessao nome
				$_SESSION["emailAdministrador"] = $dados["email"]; //carrego a sessao nome
				echo "ok";
			}
		}
	}

/****************************************************************************/
//executando o login
/****************************************************************************/

	if($_POST["txtLocal"] == "frmLogin"){
		$login = new Login();
		$login->setUsuario($_POST["email"]);
		$login->setSenha(md5($_POST["password"]));
		$login->loginAdministrador();
	}elseif($_GET["txtLocal"] == "logOff"){
		session_start();
		session_destroy();
		session_unset();
		//$erro = base64_encode("Muito obrigado por utilizar nosso sistema");
		@header("Location: ../admin/login.php");
		//echo "Muito obrigado por utilizar nosso sistema";
	}else{
		//echo $erro = base64_encode("Acesso de forma incorreta, entre em contato com o administrador");
		//@header("Location: ../admin2/login.php?msn=$erro");
		echo "Acesso de forma incorreta, entre em contato com o administrador";
	}
	
?>
