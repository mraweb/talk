<?php 
session_start();
include_once("classe/ComboBox.php");
include_once("classe/Cliente.php");
$comboBox = new ComboBox();
$clientes = new Cliente();
$clientes->getStatusModal();
$statusModal = $clientes->getModalCadastro();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title>Programas | Talk Radio - Soluções em Radiofusão</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css">
<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css" />
<link rel="stylesheet" href="css/sc-player-artwork.css" type="text/css">
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
            <h1 class="titulo"><span>Programas</span></h1>

            <p>Programas e Programetes para Radios que irão fazer a diferença em sua programação, qualidade, diferencial, exclusividade em sua área de abrangência e o melhor custo beneficio.</p>

	    <?php
			include_once 'classe/Servico.php';
			$servico = new Servico();
			$servico->getListServicos();
	    ?>
        </section><!-- FINAL CONTENT --> 
    </div> 
</div>

<!--<?php // include "servicos-audio.php"; ?>-->

<?php include "inc/footer.php"; ?>

<section id="formulario-assine">
    <h3>Assine Já: <span id="tituloAssine"></span></h3>

    <a href="#" title="Fechar" class="bt-fechar1 hidetxt">Fechar</a>

    <div class="content-regiao">
        <ul>
            <li>
                <label for="nome">Nome*:</label>
                <input type="text" name="nome" id="nome" class="validate[required]" />
                <input type="hidden" name="assunto" id="assunto" />
            </li>

            <li>
                <label for="mail">E-mail*:</label>
                <input type="text" name="mail" id="mail" class="validate[required,custom[email]]" />
            </li>

            <li>
                <label for="tel">Telefone*:</label>
                <input type="text" name="tel" id="tel" class="validate[required,custom[phone]]" />
            </li>

            <li>
                <label for="radio">Rádio:</label>
                <input type="text" name="radio" id="radio" />
            </li>

            <li>
                <label for="msg">Mensagem:</label>
                <textarea name="msg" id="msg" rows="5" cols="50"></textarea>
            </li>

            <li>
                <span>*Campos Obrigatórios</span>
                <input type="image" src="img/bt-cancelar.jpg" name="Cancelar" alt="Cancelar" class="cancelar" />
                <input type="image" src="img/bt-enviar1.jpg" name="Enviar" alt="Enviar" class="enviar" />
            </li>
        </ul>
    </div>
</section>
<?php if($statusModal=='ativo'){?>
<section id="modal-cadastro">
    <p>Para ter acesso aos aúdios dos nossos programas realize o cadastro abaixo:</p>

    <form action="javascript:void(0);" method="post" id="formCadastro">
        <ul>
            <li>
                <label for="mailcadastro">E-mail:</label>
                <input type="text" name="mailcadastro" id="mailcadastro" class="validate[required,custom[email]] checkEmail" />
            </li>

            <li>
                <label for="nomecadastro">Nome:</label>
                <input type="text" name="nomecadastro" id="nomecadastro" class="validate[required]" />
            </li>

            <li>
                <label for="radiocadastro">Rádio:</label>
                <input type="text" name="radiocadastro" id="radiocadastro" class="validate[required]" />
            </li>

            <li>
                <label for="cidade">Cidade:</label>
                <input type="text" name="cidade" id="cidade" class="validate[required]" />
            </li>

            <li>
                <label for="estado">Estado:</label>
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
                <label for="telcadastro">Telefone:</label>
                <input type="text" name="telcadastro" id="telcadastro" class="validate[required,custom[phone]]" />
            </li>

            <li>
                <span>Todos os campos são obrigatórios<br />
                Se já se cadastrou, digite apenas<br />
                seu e-mail.</span>

                <input type="submit" name="Cadastrar" value="Cadastrar" class="cadastro" />
            </li>
        </ul>
    </form>
</section>

<div id="mask2"></div>
<?php }?>
<input type="hidden" id="statusModal" value="<?php echo $statusModal?>">
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
(function($){
    $(window).load(function(){
        $(".scroll-pane").mCustomScrollbar({
            scrollButtons:{
                enable:true
            },
            advanced:{
                updateOnContentResize: true
            }
        });
    });
})(jQuery);
</script>
<script type="text/javascript" src="js/soundcloud.player.api.js"></script>
<script type="text/javascript" src="js/sc-player.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".linhas:nth-child(2n)").addClass("cor-bg"); 
    });
</script>
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine-pt.js"></script>
<script type="text/javascript" src="js/jquery.mask.js"></script>
<script type="text/javascript" src="js/validacao.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/cookie.js"></script>
<script type="text/javascript">
    $(".programa").hide();
    $(".box-serv a").on({
        click: function(e){
            e.preventDefault();
            var _This = $(this),
            id = _This.data("radio");
            //alert(id);
            $(".teste").find("#"+id).fadeIn();
        }
    });

    $("#close, #close1, #close2, #close3, #close4, #close5, #close6, #close7").click(function(e){
        e.preventDefault();
        $(".programa").fadeOut();
    });

    $("#formulario-assine").hide();
    $(".bt-assine").click(function(e){
        e.preventDefault();
        $('#tituloAssine').html($(this).attr('id'));
        $('#assunto').val($(this).attr('id'));
        $("#formulario-assine").fadeIn();
    });
    $(".cancelar, .bt-fechar1").click(function(e){
        e.preventDefault();
        $("#formulario-assine").fadeOut();
    });

    $('.enviar').click(function() {  

		var nome = $("#nome").val();
		var assunto = $("#assunto").val();
		var mail = $("#mail").val();
		var tel = $("#tel").val();
		var radio = $("#radio").val();
		var msg = $("#msg").val();
		var acao = "contatoAssinar";

		// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
		$.post('funcoes/contatoAssinar.php', {
			nome: nome, 
			assunto: assunto, 
			mail: mail,
			tel: tel, 
			radio: radio,
			msg: msg,
			acao : acao
				}, function(resposta) { 

					var str = $.trim(resposta);

					if(str == "ok"){
						alert('Email envido com sucesso!');
						$("#formulario-assine").hide();
					}else{
						alert('Erro no envio do email, entre em contato por telefone');
                }
		});
 	});
</script>
<script type="text/javascript">
// abre cesta home
// $(document).ready(function(){
//     var id = $(this).attr("href");

//     var alturaTela = $(document).height();
//     var larguraTela = $(window).width();

//     //colocando o fundo preto
//     $('#mask2').css({'width':larguraTela,'height':alturaTela});
//     $('#mask2').fadeIn(1000); 
//     $('#mask2').fadeTo("slow",0.8);

//     var left = ($(window).width() /2) - ( $(id).width() / 2 );
//     var top = ($(window).height() / 2) - ( $(id).height() / 2 );
    
//     $(id).css({'top':top,'left':left});
//     $(id).show();   

// });

$(document).ready(function(){
    $('#mask2').fadeIn(1000); 
});

var $sidebar   = $("#modal-cadastro"),
    $window    = $(window),
    offset     = $sidebar.offset(),
    topPadding = -  50;

$window.scroll(function() {
    if ($window.scrollTop() > offset.top) {
        $sidebar.stop().animate({
            marginTop: $window.scrollTop() - offset.top + topPadding
        });
    } 

});

$("#formCadastro").submit(function( event ) {

	var acao = "modalCadastro";
	var mailcadastro = $('#mailcadastro').val();
	var nomecadastro = $('#nomecadastro').val();
	var radiocadastro = $('#radiocadastro').val();
	var cidade = $('#cidade').val();
	var estado = $('#estado').val();
	var telcadastro = $('#telcadastro').val();

	if(mailcadastro=='' || nomecadastro=='' || radiocadastro=='' || cidade=='' || estado=='' || telcadastro==''){
		return false;
	}

	var urlbase = 'classe/Cliente.php';

	$.ajax({
        url: urlbase,
        type: "post",
        data: {'mailcadastro':mailcadastro,
	           'nomecadastro':nomecadastro,
	           'radiocadastro':radiocadastro,
	           'cidade':cidade,
	           'estado':estado,
	           'telcadastro':telcadastro,
	           'acao': acao},
        dataType: 'html',
        success: function(retorno){

			if(retorno == 1){
		        $("#mask2").hide();
		        $("#modal-cadastro").hide();
		        gerarCookie('clientetalksat_cookie', 1, 30);
			}else{
				alert("erro addModalCadastro");
	            return false;
			}
			
        },
        error:function(){
            alert("erro de acesso a classe, addModalCadastro");
            return false;
        }
	});

});

$(".checkEmail").change(function(event) {

	var acao = "checkEmail";
	var mailcadastro = $('#mailcadastro').val();

	var urlbase = 'classe/Cliente.php';

	$.ajax({
        url: urlbase,
        type: "post",
        data: {'mailcadastro':mailcadastro,
	           'acao': acao},
        dataType: 'html',
        success: function(retorno){

			if(retorno==1){
		        $("#mask2").hide();
		        $("#modal-cadastro").hide();
			}else{
				return false;
			}
			
        },
        error:function(){
            alert("erro de acesso a classe, checkEmail");
            return false;
        }
	});

});

//verifica a validação do modal
var statusModal = $('#statusModal').val();
if(statusModal=='inativo' || lerCookie('clientetalksat_cookie')==true){
    $("#mask2").hide();
    $("#modal-cadastro").hide();
}
</script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
<!-- END LivePerson Button code -->
</body>
</html>