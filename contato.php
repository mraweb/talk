<?php session_start(); ?><!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title>Contato | Talk Radio - Programas de Radio.</title>
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
                <form action="<?php echo URL;?>resposta-contato" method="post" id="conversion-form" class="validacaptcha">
                    <input type="hidden" name="valida" id="valida" />
                    <ul>
                        <li>
                            <label for="nome">Nome*:</label>
                            <input type="text" name="nome" id="nome" class="validate[required]" value="<?php echo $_SESSION['contato']['nome'];?>" />
                        </li>

                        <li>
                            <label for="email">E-mail*:</label>
                            <input type="text" name="email" id="email" class="validate[required,custom[email]]" value="<?php echo $_SESSION['contato']['email'];?>" />
                        </li>

                        <li>
                            <label for="tel">Telefone*:</label>
                            <input type="text" name="tel" id="tel" class="validate[required,custom[phone]]" value="<?php echo $_SESSION['contato']['tel'];?>" />
                        </li>

                        <li>
                            <label for="emissora">Emissora:</label>
                            <input type="text" name="emissora" id="emissora" value="<?php echo $_SESSION['contato']['emissora'];?>" />
                        </li>

                        <li>
                            <label for="assunto">Assunto:</label>
                            <input type="text" name="assunto" id="assunto" value="<?php echo $_SESSION['contato']['assunto'];?>" />
                        </li>

                        <li>
                            <label for="msg">Mensagem:</label>
                            <textarea name="msg" id="msg" rows="5" cols="50"><?php echo $_SESSION['contato']['mensagem'];?></textarea>
                        </li>

                        <li>
                            <div class="captcha">
                                <p>Digite o texto abaixo:</p>

                                <img src="<?php echo URL; ?>funcoes/get_captcha.php" alt="Captcha" title="Captcha" id="captcha" />
                                
                                <div><img src="<?php echo URL; ?>img/refresh.png" width="30" alt="refresh" title="refresh" class="refresh" /></div>

                                <input type="text" name="captcha" id="captchatext" class="validate[required,minSize[5]]" maxlength="5" />
                            </div>

                            <span>*Campos Obrigatórios</span>

                            <input type="image" src="img/btenviar.jpg" name="Enviar" alt="Enviar" class="bt-enviar" />

                            <input type="hidden" id="urlbase" value="<?php echo URL; ?>">
                        </li>
                    </ul>
                </form>
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
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine-pt.js"></script>
<script type="text/javascript" src="js/jquery.mask.js"></script>
<script type="text/javascript" src="js/validacao.js"></script>
<script type="text/javascript" src="js/form.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
</body>
</html>