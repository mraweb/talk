<?php
	session_start();
	include_once('../classe/Email.php');
	include_once("define.php");

		
		if($_REQUEST['acao']=="contatoAssinar"){
	
			$Email = new Email(URL);
			
			$conteudo = "<strong>Nome:</strong> ".$_REQUEST['nome']."<br /> <br />";
			$conteudo .= "<strong>Email:</strong> ".$_REQUEST['mail']."<br /> <br />";
			$conteudo .= "<strong>Telefone:</strong> ".$_REQUEST['tel']."<br /> <br />";
			$conteudo .= "<strong>Rádio:</strong> ".$_REQUEST['radio']."<br /> <br />";
			$conteudo .= "<strong>Mensagem:</strong> <br /><br />".nl2br($_REQUEST['msg'])."<br /><br />";
			$conteudo = utf8_decode($conteudo);

			$tituloContato = 'Contato do serviço: '.$_REQUEST['assunto'];
				
			$assunto = sprintf('=?%s?%s?%s?=', 'UTF-8', 'B', base64_encode($tituloContato));
			$emailRemetente = $_REQUEST['mail'];
			$nomeRemetente = $_REQUEST['nome'];
			$emailDestinatario = EMAILDESTINATARIO;
		
			$resp = $Email->enviaEmail($emailDestinatario,$emailRemetente,$nomeRemetente,$assunto,$titulo,$conteudo);
			
			echo $resp;
			
		}
