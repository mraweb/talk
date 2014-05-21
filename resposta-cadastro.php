<?php
session_start();
if ($_POST["cadastropelo"] == "site"){
	
	
		//gravo session
		$_SESSION['cadastro']['status_id']  = $_POST["situacao"];
		$_SESSION['cadastro']['fantasia'] = addslashes($_POST["fantasia"]);
		$_SESSION['cadastro']['sintonia'] = addslashes($_POST["sintonia"]);
		$_SESSION['cadastro']['outorga_id'] = $_POST["outorga"];
		$_SESSION['cadastro']['prefixo'] = addslashes($_POST["prefixo"]);
		$_SESSION['cadastro']['razao'] = addslashes($_POST["razao"]);
		$_SESSION['cadastro']['cnpj'] = addslashes($_POST["cnpj"]);
		$_SESSION['cadastro']['pais_id'] = $_POST["pais"];
		$_SESSION['cadastro']['estado_id'] = $_POST["estado"];
		$_SESSION['cadastro']['cidade'] = addslashes($_POST["cidade"]);
		$_SESSION['cadastro']['tel'] = $_POST["tel"];
		$_SESSION['cadastro']['endereco'] = addslashes($_POST["endereco"]);
		$_SESSION['cadastro']['bairro'] = addslashes($_POST["bairro"]);
		$_SESSION['cadastro']['num'] = addslashes($_POST["num"]);
		$_SESSION['cadastro']['cep'] = addslashes($_POST["cep"]);
		$_SESSION['cadastro']['diretorcomercial'] = addslashes($_POST["diretorcomercial"]);
		$_SESSION['cadastro']['mailcomercial'] = addslashes($_POST["mailcomercial"]);
		$_SESSION['cadastro']['diretorartistico'] = addslashes($_POST["diretorartistico"]);
		$_SESSION['cadastro']['mailartistico'] = addslashes($_POST["mailartistico"]);
		$_SESSION['cadastro']['msn'] = addslashes($_POST["msn"]);
		$_SESSION['cadastro']['site'] = addslashes($_POST["site"]);
		$_SESSION['cadastro']['nome'] = addslashes($_POST["nome"]);
		$_SESSION['cadastro']['servico'] = addslashes($_POST["servico"]);
		$_SESSION['cadastro']['onde'] = addslashes($_POST["onde"]);
		$_SESSION['cadastro']['necessidade'] = addslashes($_POST["necessidade"]);
		$_SESSION['cadastro']['telefoneDiretorGeral'] = addslashes($_POST["tel1"]);
		$_SESSION['cadastro']['telefoneDiretorArtistico'] = addslashes($_POST["tel2"]);
		
		
		if(strtolower($_SESSION['random_number']) != strtolower($_POST['captcha'])){ 
			echo'<meta http-equiv="refresh" content="0;url=http://talksat.com.br/cadastro">';
			exit;
		}else{

			//----------------------------------------------------------------
			$status_id  = $_POST["situacao"];
			$fantasia = addslashes($_POST["fantasia"]);
			$sintonia = addslashes($_POST["sintonia"]);
			$outorga_id = $_POST["outorga"];
			$prefixo = addslashes($_POST["prefixo"]);
			$razao = addslashes($_POST["razao"]);
			$cnpj = addslashes($_POST["cnpj"]);
			$pais_id = $_POST["pais"];
			$estado_id = $_POST["estado"];
			$cidade = addslashes($_POST["cidade"]);
			$tel = $_POST["tel"];
			$endereco = addslashes($_POST["endereco"]);
			$bairro = addslashes($_POST["bairro"]);
			$num = addslashes($_POST["num"]);
			$cep = addslashes($_POST["cep"]);
			$diretorcomercial = addslashes($_POST["diretorcomercial"]);
			$mailcomercial = addslashes($_POST["mailcomercial"]);
			$diretorartistico = addslashes($_POST["diretorartistico"]);
			$mailartistico = addslashes($_POST["mailartistico"]);
			$msn = addslashes($_POST["msn"]);
			$site = addslashes($_POST["site"]);
			$nome = addslashes($_POST["nome"]);
			$servico = addslashes($_POST["servico"]);
			$onde = addslashes($_POST["onde"]);
			$necessidade = addslashes($_POST["necessidade"]);
			$telefoneDiretorGeral = addslashes($_POST["tel1"]);
			$telefoneDiretorArtistico = addslashes($_POST["tel2"]);
			$dataCadastro = date("Y-m-d H:m:s");
		
			include_once("classe/MySqlConn.php");
			include_once("classe/ManipulateData.php");
			include_once("classe/Empresa.php");
	
			$cad = new ManipulateData();
			$cad->setTable("empresa");
			$cad->setFieldId("cnpj"); //aqui é o atributo de pesquisa da tabela, para que não ocorra a duplicação
		 
			//verificando se existe registro cadastrado
			if($cad->getDadosDuplicados($cnpj) >= 1){
				$erro = "cnpj informado já esta cadastrado!";
			}else{
				$cad->setFields("status_id,fantasia,sintonia,outorga_id,prefixo,razao,cnpj,pais_id,estado_id,cidade,tel,endereco,bairro,num,cep,diretorcomercial,mailcomercial,diretorartistico,mailartistico,msn,site,nome,servico,onde,necessidade,telefoneDiretorGeral,telefoneDiretorArtistico,dataCadastro");
				$cad->setDados("'$status_id','$fantasia','$sintonia','$outorga_id','$prefixo','$razao','$cnpj','$pais_id','$estado_id','$cidade','$tel','$endereco','$bairro','$num','$cep','$diretorcomercial','$mailcomercial','$diretorartistico','$mailartistico','$msn','$site','$nome','$servico','$onde','$necessidade','$telefoneDiretorGeral','$telefoneDiretorArtistico','$dataCadastro'");
				$cad->insert();
				$idRegistro = $cad->getRetornaIdCadastro(); 
				$erro = $cad->getStatus();
				
				
				//teste do id estado 0		
				if(!$estado_id || $estado_id == 0){
					
					include_once('classe/Email.php');
					include_once("funcoes/define.php");
					$Email = new Email(URL);
					
					$conteudo = utf8_decode($fantasia." foi cadastro com idEstado 0 - id.: ".$idRegistro);
				
					$tituloContato = "error - cadastro com idEstado 0";
					$assunto = sprintf('=?%s?%s?%s?=', 'UTF-8', 'B', base64_encode($tituloContato));
					$emailRemetente = $_REQUEST['email'];
					$nomeRemetente = $_REQUEST['fantasia'];
					$emailDestinatario = "fernando.nvicente@gmail.com";
				
					echo $resp = $Email->enviaEmail($emailDestinatario,$emailRemetente,$nomeRemetente,$assunto,$titulo,$conteudo);
				}	
				
			}
			
			if($erro=='Cadastrado com Sucesso!!!'){
				$empresa = new Empresa();
				$empresa->setId($idRegistro);
				$empresa->geraDadosIdEmpresa();
				
				
				include_once('classe/Email.php');
				include_once("funcoes/define.php");
	
							
				$Email = new Email(URL);
				
				$conteudo = "<strong>IP:</strong> ". $_SERVER["REMOTE_ADDR"]."<br /><br />";
		
				$conteudo .= "<strong>Cadastro enviado pelo site TalkSat</strong><br /><br />";
				
			   	$conteudo .= "<strong>Nome fantasia:</strong> ".$empresa->getFantasia()."<br />";
				$conteudo .= "<strong>Sintonia:</strong> ".$empresa->getSintonia()."<br />";
				$conteudo .= "<strong>Outorga:</strong> ".$empresa->getOutorgaNome()."<br />";
				$conteudo .= "<strong>Prefixo:</strong> ".$empresa->getPrefixo()."<br />";
				$conteudo .= "<strong>Razão Social:</strong> ".$empresa->getRazao()."<br />";
				$conteudo .= "<strong>CNPJ:</strong> ".$empresa->getRazao()."<br />";
				$conteudo .= "<strong>Telefone:</strong> ".$_POST["tel"]."<br /><br />";
				
				$conteudo .= "<strong>Endereço Comercial:</strong> ".$empresa->getEndereco().", ".$empresa->getNum()."<br />";
				$conteudo .= "<strong>País:</strong> ".$empresa->getPaisNome()."<br />";
				$conteudo .= "<strong>Estado:</strong> ".$empresa->getEstadoNome()."<br />";
				$conteudo .= "<strong>Cidade:</strong> ".$empresa->getCidade()."<br />";
				$conteudo .= "<strong>Bairro:</strong> ".$empresa->getBairro()."<br />";
				$conteudo .= "<strong>CEP:</strong> ".$empresa->getCep()."<br /><br />";
				
				$conteudo.= "<strong>Diretor comercial:</strong> ".$empresa->getDiretorcomercial()."<br />";
				$conteudo .= "<strong>E-mail comercial:</strong> ".$empresa->getMailcomercial()."<br />";
				$conteudo .= "<strong>Telefone comercial:</strong> ".$_POST['tel1']."<br />";
				
				$conteudo .= "<strong>Diretor Artístico:</strong> ".$empresa->getDiretorartistico()."<br />";
				$conteudo .= "<strong>E-mail Artístico:</strong> ".$empresa->getMailartistico()."<br />";
				$conteudo .= "<strong>Telefone Artístico:</strong> ".$_POST['tel2']."<br />";
				$conteudo .= "<strong>Facebook/Skype:</strong> ".$empresa->getMsn()."<br /><br />";
				
				$conteudo .= "<strong>Site da Rádio:</strong> ".$empresa->getSite()."<br />";
				$conteudo .= "<strong>Nome do Contato:</strong> ".$empresa->getNomeContato()."<br />";
				$conteudo .= "<strong>Já possui algum serviço parecido com a Talk Rádio, qual?</strong> ".$empresa->getServico()."<br />";
				$conteudo .= "<strong>Onde nos Conheceu?</strong> ".$empresa->getOnde()."<br />";
				$conteudo .= "<strong>Qual a sua necessidade atual?</strong> ".$empresa->getNecessidade()."<br />";
				$conteudo = utf8_decode($conteudo);
			
				$tituloContato = "Cadastro enviado pelo site TalkSat";
				$assunto = sprintf('=?%s?%s?%s?=', 'UTF-8', 'B', base64_encode($tituloContato));
				$emailRemetente = EMAILENVIO;
				$nomeRemetente = $_POST["fantasia"];
				$emailDestinatario = EMAILDESTINATARIO;
			
				$resp = $Email->enviaEmail($emailDestinatario,$emailRemetente,$nomeRemetente,$assunto,$titulo,$conteudo);
				
				unset($_SESSION['cadastro']);
			}
		}
}
if($resp=="ok" || $_POST['valida'] == "" || $_SERVER["REMOTE_ADDR"] != "192.99.4.25" || $_SERVER["REMOTE_ADDR"] != "62.210.142.7" || $_SERVER["REMOTE_ADDR"] != "37.187.142.194" || $_SERVER["REMOTE_ADDR"] != "91.121.170.197" || $_SERVER["REMOTE_ADDR"] != "188.143.232.31" || $_SERVER["REMOTE_ADDR"] != "91.121.170.197" || $_SERVER["REMOTE_ADDR"] != "188.143.232.31" || $_SERVER["REMOTE_ADDR"] != "62.210.122.209"){
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title>Cadastro Enviado | Talk Radio - Soluções em Radiofusão</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<!--[if ie]>
	<script type="text/javascript" src="js/html5-ie.js"></script>
<![endif]-->
<?php include "analytics.php"; ?>
<?php include "inc/monitor.php"; ?>
</head>
<body itemscope itemtype="http://schema.org/WebPage">

<div class="bg-int">
    <?php include "inc/header.php"; ?>
    
    <div role="main">
        <section id="content">          
            <h1 class="titulo"><span>Cadastre sua rádio sem compromisso e receba nosso orçamento</span></h1>

            <p><strong>Se você trabalha em uma rádio e quer levar a melhor programação do país para a sua cidade, entre em contato com a rede Talk Rádio.</strong><br />
            <strong>Atenção: </strong>Antes de efetuar o seu cadastro tenha certeza de que sua emissora está devidamente outorgada pelo Poder Público Federal.</p>

            <p><strong>Obrigado <?php echo $_POST["nome"]; ?>, sua solicitação foi enviada com sucesso. Em breve nossa Equipe entrará em contato.</strong></p>
        </section><!-- FINAL CONTENT --> 
    </div> 
</div>

<?php include "inc/footer.php"; ?>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
</body>
</html>
<?php }else{
	echo 'Erro ao enviar a Mensagem. Tente mais tarde!';
}
?>