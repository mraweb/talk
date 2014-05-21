<?php
	session_start();
	include_once('../classe/Email.php');
	include_once("define.php");

		
		if($_REQUEST['acao']=="enviaOrcamento"){
			/*
			$Email = new Email(URL);
			
			$conteudo = "<strong>Nome:</strong> ".$_REQUEST['nome']."<br /> <br />";
			$conteudo .= "<strong>Telefone:</strong> ".$_REQUEST['fone']."<br /> <br />";
			$conteudo .= "<strong>Cidade:</strong> ".$_REQUEST['cidade']."<br /> <br />";
			$conteudo .= "<strong>Observações:</strong> <br /><br />".nl2br($_REQUEST['obs'])."<br /><br />";
			$conteudo = utf8_decode($conteudo);

			if($_REQUEST['dadosNomeProduto'])
				$tituloContato = "Orçamento do produto ".$_REQUEST['dadosNomeProduto'];
			else 
				$tituloContato = "Orçamento de produto ";
				
			$assunto = sprintf('=?%s?%s?%s?=', 'UTF-8', 'B', base64_encode($tituloContato));
			$emailRemetente = $_REQUEST['mail'];
			$nomeRemetente = $_REQUEST['nome'];
			$emailDestinatario = EMAILDESTINATARIO;
		
			$resp = $Email->enviaEmail($emailDestinatario,$emailRemetente,$nomeRemetente,$assunto,$titulo,$conteudo);
			
			echo $resp;
			*/
			echo 'ok';
			
		}
