<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title>Rede | Talk Radio - Soluções em Radiofusão</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css" />
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
            <h1 class="titulo h1-contato"><span>Rede +de 900 Rádios</span></h1>
            <p>Se você é proprietário de uma rádio e quer levar a melhor programação do país para a sua cidade, entre em contato com a Talk Radio.</p>

            <div class="regiao">
                <a href="#" title="Região Norte" class="bt01" data-pais="regiao-norte">Região Norte</a>
                <a href="#" title="Região Nordeste" class="bt02" data-pais="regiao-nordeste">Região Nordeste</a>
                <a href="#" title="Região Centro Oeste" class="bt03" data-pais="regiao-centro">Região Centro Oeste</a>
                <a href="#" title="Região Sudeste" class="bt04" data-pais="regiao-sudeste">Região Sudeste</a>
                <a href="#" title="Região Sul" class="bt05" data-pais="regiao-sul">Região Sul</a>
            </div>

            <section class="escolha">
                <h2>Escolha a Região</h2>

                <nav role="navigation">
                    <ul>
                        <li><a href="#" title="Brasil" data-pais="brasil">Brasil</a></li>
                    </ul>   
                </nav>
            </section>
        </section><!-- FINAL CONTENT --> 
    </div> 
</div>

<?php include "inc/footer.php"; ?>

<?php include "pais.php"; ?>

<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript">
(function($){
    $(window).load(function(){
        $(".content-pais, .content-regiao").mCustomScrollbar({
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
<script type="text/javascript">
$(".escolha nav a, .regiao a").on({
    click: function(e){
        e.preventDefault();
        var _This = $(this),
        id = _This.data("pais");
        $(".geral").find("#"+id).fadeIn();
        $("#mask").fadeIn();
    }
}),
$("#mask, .bt-fechar").on({
    click: function(e){
        e.preventDefault();
        $("#mask, .pais").fadeOut();
    }
});

$(".content-regiao tbody tr:nth-child(2n), .content-pais tbody tr:nth-child(2n)").addClass("cor-cinza");
</script>

<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
</body>
</html>




























