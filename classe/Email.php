<?php
$enderecoUrl = explode("/", $_SERVER['PHP_SELF']);

if($enderecoUrl[3]=="EsqueciSenhaSistema.php" || $enderecoUrl[3]=="contatoAssinar.php")
	include_once('../phpmailer/class.phpmailer.php');
else
	include_once('phpmailer/class.phpmailer.php');

class Email extends PHPMailer{
	
	public $urlBase;
	
	public function __construct($urlBase){
		$this->IsSMTP();
		$this->Host = "smtp.conteudoradiofonico.com.br"; // SMTP servers
		$this->SMTPAuth = true; // Caso o servidor SMTP precise de autentica��o
		$this->Username = "send@conteudoradiofonico.com.br"; // SMTP username
		$this->Password = "12x8x32x"; // SMTP password 
		$this->urlBase = $urlBase; 
		$this->IsHTML(true);
		$this->Port = 587;
	}
	
	public function enviaEmail($emailDestinatario,$emailRemetente,$nomeRemetente,$assunto,$titulo,$conteudo){
		
		$this->From = EMAILENVIO;
    	$this->FromName = "send@conteudoradiofonico.com.br";

	    $this->AddAddress($emailDestinatario, NOMEDOSITE);
	    $this->AddReplyTo($emailRemetente, $nomeRemetente);   
	    $this->AddBCC("rede@talkradio.com.br");
	    $this->AddBCC("marcelo@mraweb.com.br");
	    $this->Subject = $assunto;
	    $this->Body = $this->getBodyMail($titulo, $conteudo);
		
    	if($this->Send()){
    		return 'ok';
    	}else{
    		return 'erro';
    	}
	}
	
	public function getBodyMail($titulo, $conteudo){
		
		return $conteudo;
	}
	
}
?>