<?php 
session_start();
include_once("classe/ComboBox.php");
$comboBox = new ComboBox();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title>Cadastro | Talk Radio - Soluções em Radiofusão</title>
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
            <h1 class="titulo"><span>Cadastre sua rádio sem compromisso e receba nosso orçamento</span></h1>

            <p><strong>Se você trabalha em uma rádio AM ou FM e quer levar a melhor programação do país para a sua cidade, entre em contato com a rede Talk Radio.</strong><br />
            <strong>Atenção: </strong><span class="vermelho">Antes de efetuar o seu cadastro tenha certeza de que sua emissora é uma rádio legalizada pelo Poder Público Federa</span>l (Anatel).</p>

            <form action="<?php echo URL;?>resposta-cadastro" method="post" id="formID" class="validacaptcha">
            	<input type="hidden" name="valida" id="valida" />
                <ul class="form-cada">
                    <li>
                        <label for="fantasia">Nome Fantasia:</label>
                        <div class="error" id="error_fantasia"></div>
                        <input type="text" name="fantasia" id="fantasia" class="" value="<?php echo $_SESSION['cadastro']['fantasia'];?>"/>
                    </li>

                    <li>
                        <label for="sintonia">Sintonia*:</label>
                        <input type="text" name="sintonia" id="sintonia" class="validate[required]" value="<?php echo $_SESSION['cadastro']['sintonia'];?>"/>
                    </li>

                    <li>
                        <label for="outorga">Outorga:</label>
                        <select name="outorga" id="outorga" class="validate[required]">
                        	<option value="">Selecione</option>
                            <?php 
			                	$comboBox->outorgaSite($_SESSION['cadastro']['outorga_id']);
			                ?>
                        </select>
                    </li>

                    <li>
                        <label for="prefixo">Prefixo*:</label>
                        <div class="error"></div>
                        <input type="text" name="prefixo" id="prefixo" class="validate[required]" value="<?php echo $_SESSION['cadastro']['prefixo'];?>"/>
                    </li>

                    <li>
                        <label for="razao">Razão Social*:</label>
                        <div class="error"></div>
                        <input type="text" name="razao" id="razao" class="validate[required]" value="<?php echo $_SESSION['cadastro']['razao'];?>"/>
                    </li>

                    <li>
                        <label for="cnpj">CNPJ*:</label>
                        <div class="error" id="cnpj_fantasia"></div>
                        <input type="text" name="cnpj" id="cnpj" class="validate[required] checkDados hideInputError" value="<?php echo $_SESSION['cadastro']['cnpj'];?>"/>
                    </li>

                    <!--<li>
                        <label for="pais">País*:</label>
                        <div class="error"></div>
                        <select name="pais" id="pais" class="selecionaEstados">
			                <option value=""></option>
			                <?php 
			                	//$comboBox->pais($paisId);
			                ?>
			            </select>
                    </li>-->

                    <li>
                        <label for="estado">Estado*:</label>
                        <div class="error"></div>
                        <select name="estado" id="estado" class="validate[required]">
			                <option value="">Selecione</option>
			                <?php 
			                	$comboBox->setPaisId(50);
			                	$comboBox->setEstadoId($_SESSION['cadastro']['estado_id']);
			                	$comboBox->estados();
			                ?>
			            </select>
                    </li>

                    <li>
                        <label for="cidade">Cidade:</label>
                        <input type="text" name="cidade" id="cidade" value="<?php echo $_SESSION['cadastro']['cidade'];?>"/>
                    </li>

                    <li>
                        <label for="tel">Telefone*:</label>
                        <div class="error"></div>
                        <input type="text" name="tel" id="tel" class="validate[required,custom[phone]]" value="<?php echo $_SESSION['cadastro']['tel'];?>"/>
                    </li>

                    <li>
                        <label for="endereco">Endereço Comercial*:</label>
                        <div class="error"></div>
                        <input type="text" name="endereco" id="endereco" class="validate[required]" value="<?php echo $_SESSION['cadastro']['endereco'];?>"/>
                    </li>

                    <li>
                        <label for="num">Número:</label>
                        <input type="text" name="num" id="num" value="<?php echo $_SESSION['cadastro']['num'];?>"/>
                    </li>
                </ul>

                <ul class="form-cada">
                    <li>
                        <label for="bairro">Bairro:</label>
                        <input type="text" name="bairro" id="bairro" value="<?php echo $_SESSION['cadastro']['bairro'];?>"/>
                    </li>

                    <li>
                        <label for="cep">CEP*:</label>
                        <div class="error"></div>
                        <input type="text" name="cep" id="cep" class="validate[required]" value="<?php echo $_SESSION['cadastro']['cep'];?>"/>
                    </li>

                    <li>
                        <label for="diretorcomercial">Diretor Geral*:</label>
                        <div class="error"></div>
                        <input type="text" name="diretorcomercial" id="diretorcomercial" class="validate[required]" value="<?php echo $_SESSION['cadastro']['diretorcomercial'];?>"/>
                    </li>

                    <li>
                        <label for="mailcomercial">E-mail Diretor Geral*:</label>
                        <div class="error"></div>
                        <input type="text" name="mailcomercial" id="mailcomercial" class="validate[required,custom[email]]" value="<?php echo $_SESSION['cadastro']['mailcomercial'];?>"/>
                    </li>

                    <li>
                        <label for="tel1">Telefone Diretor Geral*:</label>
                        <div class="error"></div>
                        <input type="text" name="tel1" id="tel1" class="validate[required,custom[phone]]" value="<?php echo $_SESSION['cadastro']['telefoneDiretorGeral'];?>"/>
                    </li>

                    <li>
                        <label for="diretorartistico">Diretor Artístico:</label>
                        <input type="text" name="diretorartistico" id="diretorartistico" value="<?php echo $_SESSION['cadastro']['diretorartistico'];?>"/>
                    </li>

                    <li>
                        <label for="mailartistico">E-mail Diretor Artístico:</label>
                        <input type="text" name="mailartistico" id="mailartistico" value="<?php echo $_SESSION['cadastro']['mailartistico'];?>"/>
                    </li>

                    <li>
                        <label for="tel2">Telefone Diretor Artistico:</label>
                        <div class="error"></div>
                        <input type="text" name="tel2" id="tel2" value="<?php echo $_SESSION['cadastro']['telefoneDiretorArtistico'];?>"/>
                    </li>

                    <li>
                        <label for="msn">Facebook / Skype:</label>
                        <input type="text" name="msn" id="msn" value="<?php echo $_SESSION['cadastro']['msn'];?>"/>
                    </li>

                    <li>
                        <label for="site">Site da Rádio:</label>
                        <input type="text" name="site" id="site" value="<?php echo $_SESSION['cadastro']['site'];?>"/>
                    </li>

                    <li>
                        <label for="nome">Seu Nome:</label>
                        <div class="error"></div>
                        <input type="text" name="nome" id="nome" value="<?php echo $_SESSION['cadastro']['nome'];?>"/>
                    </li>
                </ul>

                <ul class="form-cada">
                    <li>
                        <label for="servico">Já possui algum serviço parecido com a Talk Rádio, qual?</label>
                        <textarea name="servico" id="servico" rows="5" cols="50"><?php echo $_SESSION['cadastro']['servico'];?></textarea>
                    </li>

                    <li>
                        <label for="onde">Onde nos Conheceu*:</label>
                        <div class="error"></div>
                        <input type="text" name="onde" id="onde" class="validate[required]" value="<?php echo $_SESSION['cadastro']['onde'];?>"/>
                    </li>

                    <li>
                        <label for="necessidade">Qual a sua necessidade atual:</label>
                        <textarea name="necessidade" id="necessidade" rows="5" cols="50"><?php echo $_SESSION['cadastro']['necessidade'];?></textarea>
                    </li>

                    <!--<li>
                        <label for="obs">Observações:</label>
                        <textarea name="obs" id="obs" rows="5" cols="50"></textarea>
                    </li>-->
                    
                    <li>
                    	<input type="hidden" name="situacao" value="1">
                    	<input type="hidden" name="cadastropelo" value="site">
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
        </section><!-- FINAL CONTENT --> 
    </div> 
</div>

<?php include "inc/footer.php"; ?>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine-pt.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript">
    $('#cnpj').mask('99.999.999/9999-99');
    $("#cep").mask("99999-999");
</script>
<script type="text/javascript" src="js/jquery.mask.js"></script>
<script type="text/javascript">
// validacao formulario
jQuery(document).ready(function(){
    jQuery("#formID, #form-Lateral").validationEngine();
});
function checkHELLO(field, rules, i, options){
    if (field.val() != "HELLO") {
        return options.allrules.validate2fields.alertText;
    }
}

 $('#tel, #tel1, #tel2').mask('(00) 0000-0000',{onKeyPress: function(phone, e, currentField, options){
     var new_sp_phone = phone.match(/^(\(11\) 9(5[0-9]|6[0-9]|7[01234569]|8[0-9]|9[0-9])[0-9]{1})/g);
     new_sp_phone ? $(currentField).mask('(00) 00000-0000', options) : $(currentField).mask('(00) 0000-0000', options)
   }
 });

var masks = ['00.000.000/0000-00'],
    maskBehavior = function(val, e, field, options) {
    return val.length > 14 ? masks[0] : masks[1];
};

$('#cnpj').mask(maskBehavior, {onKeyPress: 
   function(val, e, field, options) {
       field.mask(maskBehavior(val, e, field, options), options);
   }
});

 
</script>
<script type="text/javascript" src="js/form.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
</body>
</html>
