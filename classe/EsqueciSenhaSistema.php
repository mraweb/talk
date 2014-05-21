<?php
	include_once("MySqlConn.php");
	include_once("ManipulateData.php"); 
	include_once("../funcoes/geral.php");
	include_once('../phpmailer/class.phpmailer.php');
	
	class EsqueciSenhaSistema extends MySqlConn{
	
		private $email;
		
		public function setEmail($conteudoEmail){
			$this->email = $conteudoEmail;
		}
		
		public function setSite($conteudoSite){
			$this->site = $conteudoSite;
		}
			
		public function executeEsqueciSenha(){
			$sql = "
				SELECT id, nome, email
				FROM administrador
				WHERE dataExclusao IS NULL
				AND email = '".$this->email."' 
			";		
			 
			$qr = self::execSql($sql);
			$total = self::countData($qr);

			if($total > 1){
				echo "Dados Duplicados, login não efetuado, entre em contato com administrador";
			}elseif($total <= 0){
				echo "E-mail informado não foi localizado";
			}elseif($total == 1){
				$senhaPadrao = RandomPass(8);
				$senhaPadraoCriptografada = md5($senhaPadrao);
				$dataAlteracao = date("Y-m-d H:i:s");
				
				//instanciando o objeto de alteracao
				$alt = new ManipulateData();
				$alt->setTable("administrador");//envio o nome da tabela
				//enviando os atributos do banco
				$alt->setFields("senha='$senhaPadraoCriptografada', dataAlteracao='$dataAlteracao'");
				//envio o campo de referente ao id de alteracao
				$alt->setFieldId("email");
				//envio o valor de referente ao id de alteracao
				$alt->setValueId($this->email);
				//efetuando a alteracao
				$alt->update();
				$erro = $alt->getStatus();
				
				if($erro == "Alterado com Sucesso!!!"){
					include_once("../funcoes/define.php");
					include_once('Email.php');
					$Email = new Email(URL);
					
					$dados = self::listQr($qr);	//resgata dados do sql	
					
					$mensagem = "Segue os dados de login <br /><br />";
					$mensagem .= "<strong>Email:</strong> ".$dados['email']." <br />";
					$mensagem .= "<strong>Senha:</strong> ".$senhaPadrao." <br /><br />";
					$mensagem .= "Após o acesso, favor alterar a senha";
					$mensagem = nl2br($mensagem);
					
	
					$assunto = sprintf('=?%s?%s?%s?=', 'UTF-8', 'B', base64_encode("Reenvio de senha do Talk Rádio"));
					$conteudo .= $mensagem;
					
					$emailRemetente = EMAILENVIO; 
					$nomeRemetente = utf8_decode(NOMEDOSITE);
					$emailDestinatario = $dados['email']; 
	
					$erro = $Email->enviaEmail($emailDestinatario,$emailRemetente,$nomeRemetente,$assunto,$titulo,$conteudo);
					
				}
				
				echo $erro;
			}
		}	
		
	}

/****************************************************************************/
//executando o esqueci senha
/****************************************************************************/

	if($_POST["txtLocal"] == "frmEsqueciSenha"){	
		$esquecisenha = new EsqueciSenhaSistema();
		$esquecisenha->setEmail($_POST["email"]);
		$esquecisenha->executeEsqueciSenha();
	}

?>