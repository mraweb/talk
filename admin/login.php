<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>Talk Rádio - Gerenciamento de Conteúdo</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<!--[if ie]>
	<script type="text/javascript" src="js/html5-ie.js"></script>
<![endif]-->
</head>
<body itemscope itemtype="http://schema.org/WebPage">

<div class="login">
    <img src="img/logo-admin.jpg" />
    	<form id="submit" >
	        <ul>
	            <li>
	                <label class="oculta" for="email">E-mail:</label>
	                <input type="text" name="email" id="email" value="" />
	            </li>
	            
	            <li>
	                <label class="oculta" for="senha">Senha:</label>
	                <input type="password" name="senha" id="senha" value="" />
	            </li>
	            
	            <li>
	                <span><a href="javascript:void(0);" title="Esqueci minha senha!" class="modal">Esqueci minha senha!</a></span>
	                <input type="image" src="img/btentrar.jpg" class="bt-entrar efetuarLogin" />
	            </li>
	        </ul>
        </form>
   
    
    <div class="abre-div">
        <div>
        	<label class="oculta" for="enviaemail">Digite seu e-mail:</label>
            <input type="text" name="enviaemail" id="enviaemail" value="" />
            
            <input type="image" src="img/btenviar.jpg" class="bt-enviar enviaEsqueciSenha" />
        </div>
    </div>
</div>

<div class="hcc">
    <a href="http://www.htmlcomcss.com.br" rel="external" title="Gerenciador de Conteúdo - HTMLcomCSS" class="hidetxt">Gerenciador de Conteúdo - HTMLcomCSS</a>
</div>

<div class="mask"></div>

<script type="text/javascript" src="js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/jquery.infieldlabel.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
 
<script type="text/javascript">

/************************************************************/
	function FormLogin(){
		
		var email = $("#email").val();
		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test (email))){
			alert("Campo email incorreto");
			$('#email').focus(); 
			return (false);
		}
				
		var password = $("#senha").val();
		if(password =="" || password =="Senha:"){
			alert("Preencha o campo senha");
			$('#senha').focus();
			return (false);
		}	

	return true;
	
	}


	function EfetuarLogin() {
		if( FormLogin() ){
			// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
			var email = $("#email").val();
			var password = $("#senha").val();
			var txtLocal = "frmLogin";

			// Exibe mensagem de carregamento			
			//$("#status").html("<img src='images/loading.gif' />");

			// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
			$.post('../classe/Login.php', {email: email, password: password, txtLocal:txtLocal }, function(resposta) {
					// Se a resposta é um erro
					if (resposta != "ok") {
						// Exibe o erro na div
						alert(resposta);
					} 
					// Se resposta for false, ou seja, não ocorreu nenhum erro
					else {
						// Exibe mensagem de sucesso
						location.href="index.php"
					}				
			});
			
		}
	}
	
	function FormEsqueciSenha(){
		
		var email = $("#enviaemail").val();
		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test (email))){
			alert("Campo email incorreto");
			$('#enviaemail').focus(); 
			return (false);
		}
				
	return true;
	
	}	
	

	$(".enviaEsqueciSenha").click(function() {
		if( FormEsqueciSenha() ){
			// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
			var email = $("#enviaemail").val();
			var txtLocal = "frmEsqueciSenha";
			
			// Exibe mensagem de carregamento			
			//$("#statusEsqueciSenha").html("<img src='images/loading.gif' />");

			// Fazemos a requisão ajax com o arquivo php e enviamos os valores de cada campo através do método POST
			$.post('../classe/EsqueciSenhaSistema.php', {email: email, txtLocal:txtLocal }, function(resposta) {

				// Se a resposta é um erro
					if (resposta == "ok") {
						//TEM QUE FECHAR O MODAL
						alert("Senha enviada com sucesso ao email "+email);
					}else {
						// Exibe mensagem de sucesso
						alert(resposta);
					}	
						
			});
		}
	});	

	$('#submit').submit(function() {
		EfetuarLogin();
		return false;
	});

/************************************************************/
	
</script>
</body>
</html>
