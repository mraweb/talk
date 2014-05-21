<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title>Serviços | Talk Radio - Soluções em Radiofusão</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
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
            <h1 class="titulo"><span>Serviços</span></h1>

            <p>Programas de Radio que irão fazer a diferença em sua programação, qualidade, diferencial, exclusividade em sua área de abrangência e o melhor custo beneficio.</p>

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
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
<!-- END LivePerson Button code -->
</body>
</html>
