<?php
session_start();
  
  //gravo session
  $_SESSION['contato']['nome'] = addslashes($_POST["nome"]);
  $_SESSION['contato']['email'] = addslashes($_POST["email"]);
  $_SESSION['contato']['tel'] = addslashes($_POST["tel"]);
  $_SESSION['contato']['emissora'] = addslashes($_POST["emissora"]);
  $_SESSION['contato']['assunto'] = addslashes($_POST["assunto"]);
  $_SESSION['contato']['msg'] = addslashes($_POST["msg"]);

  if(strtolower($_SESSION['random_number']) != strtolower($_POST['captcha'])){ 
      echo'<meta http-equiv="refresh" content="0;url=http://talksat.com.br/contato">';
      exit;
  }elseif ($_SERVER['REQUEST_METHOD']=='POST') {
  function addLeadConversionToRdstationCrm( $rdstation_token, $identifier, $data_array ) {
    $api_url = "http://www.rdstation.com.br/api/1.2/conversions";
 
    try {
      if (empty($data_array["token_rdstation"]) && !empty($rdstation_token)) { $data_array["token_rdstation"] = $rdstation_token; }
      if (empty($data_array["identificador"]) && !empty($identifier)) { $data_array["identificador"] = $identifier; }
      if (empty($data_array["c_utmz"])) { $data_array["c_utmz"] = $_COOKIE["__utmz"]; }
      unset($data_array["password"], $data_array["password_confirmation"], $data_array["senha"], 
            $data_array["confirme_senha"], $data_array["captcha"], $data_array["_wpcf7"], 
            $data_array["_wpcf7_version"], $data_array["_wpcf7_unit_tag"], $data_array["_wpnonce"], 
            $data_array["_wpcf7_is_ajax_call"]);
        
      if ( !empty($data_array["token_rdstation"]) && !( empty($data_array["email"]) && empty($data_array["email_lead"]) ) ) {
        $data_query = http_build_query($data_array);
        if (in_array ('curl', get_loaded_extensions())) {
          $ch = curl_init($api_url);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data_query);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_exec($ch);
          curl_close($ch);
        } else {
          $params = array('http' => array('method' => 'POST', 'content' => $data_query, 'ignore_errors' => true));
          $ctx = stream_context_create($params); 
          $fp = @fopen($api_url, 'rb', false, $ctx);
        }
      }
    } catch (Exception $e) { }
  }
 
  $form_data = $_POST;
  addLeadConversionToRdstationCrm("9029eda69766424aeeb8d691cbd1311a", "contato", $form_data);
}
if ($_POST["valida"] == ""){

	include_once('classe/Email.php');
	include_once("funcoes/define.php");

	$Email = new Email(URL);
	
	$conteudo = "<strong>Nome:</strong> ". $_POST["nome"]."<br />";
  $conteudo .= "<strong>E-mail:</strong> ". $_POST["email"]."<br />";
  $conteudo .= "<strong>Telefone:</strong> ". $_POST["tel"]."<br />";
  $conteudo .= "<strong>Emissora:</strong> ". $_POST["emissora"]."<br />";
  $conteudo .= "<strong>Assunto:</strong> ". $_POST["assunto"]."<br />";
  $$conteudo .= "<strong>Mensagem:</strong> ".nl2br($_POST["msg"])."<br />";
	$conteudo = utf8_decode($conteudo);

	$tituloContato = "Contato enviado pelo site Talk Radio";
	$assunto = sprintf('=?%s?%s?%s?=', 'UTF-8', 'B', base64_encode($tituloContato));
	$emailRemetente = $_REQUEST['email'];
	$nomeRemetente = $_REQUEST['nome'];
	$emailDestinatario = EMAILDESTINATARIO;

	$resp = $Email->enviaEmail($emailDestinatario,$emailRemetente,$nomeRemetente,$assunto,$titulo,$conteudo);
}
if($resp=="ok"){
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title>Contato | Talk Radio - Soluções em Radiofusão</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css">
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
            <h1 class="titulo h1-contato"><span>Contato</span></h1>
            <h2 class="h2-contato">Esse é o canal direto de contato com a Talk Radio</h2>

            <div class="formulario">
                <p><strong>Obrigado <?php echo $_POST["nome"]; ?>, sua mensagem foi enviada com sucesso!</strong></p>
            </div>

            <div class="contatos">
                <p>Caso tenha alguma dúvida ou interesse sobre os serviços, entre em contato com a Talk Radio, basta preencher o formulário ao lado e aguardar o breve retorno de nossa equipe de atendimento.</p>

                <p class="dados"><a href="mailto:rede@talkradio.com.br" title="E-mail" class="link">rede@talkradio.com.br</a></p>
            </div>
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
	echo 'Sua mensagem foi enviada com sucesso!';
}
?>