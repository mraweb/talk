<?php 
include_once("classe/Servico.php");
$servico = new Servico();
$servico->setId($idServico);
$servico->geraDadosIdServico();
$totalMenuCategoria = $servico->getTotalMenuServicoCategoria();

$servicoLogo = URL.'upload/arquivos/'.$servico->getLogo();
$size = explode('|', SizeImage($servicoLogo));

include_once("classe/CategoriaServico.php");
$servicoCategoria = new CategoriaServico();
$servicoCategoria->setId($idCategoriaServico);
$servicoCategoria->geraDadosIdCategoriaServico();

include_once("classe/Programacao.php");
$programacao = new Programacao();
$programacao->setId($idProgramacao);
$programacao->geraDadosIdProgramacao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title><?php echo $programacao->getNomeProgramacao();?> | Talk Radio - Soluções em Radiofusão</title>
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/colorbox.css">
<?php include "analytics.php"; ?>
<?php include "inc/monitor.php"; ?>
<!--[if ie]>
	<script type="text/javascript" src="<?php echo URL;?>js/html5-ie.js"></script>
<![endif]-->
<?php include "analytics.php"; ?>
</head>
<body itemscope itemtype="http://schema.org/WebPage">

<div class="bg-int">
    <?php include "inc/header.php"; ?>
    
    <div role="main">
        <section id="content">
            <div class="cont-serv">
                <nav role="navigation">
                    <ul class="nav-left">
                        <li class="titulo">Escolha a Categoria de Conteúdo</li>
                        <?php
                    		$servico->setId($idServico);
                    		$servico->getListMenuServicos();
                    	?>
                    </ul>
                </nav>

                <section class="cont-programa">
                    <div itemprop="breadcrumb" id="bread-serv">
                        <a href="<?php echo URL;?>" class="link">Home</a> &raquo;
                        <a href="<?php echo URL.'programas';?>" class="link">Programas</a> &raquo;
                        <a href="<?php echo URL.'programas/'.criarSlug($servico->getNome());?>" class="link"><?php echo $servico->getNome();?></a> &raquo;
                        <a href="<?php echo URL.'programas/'.criarSlug($servico->getNome()).'/'.criarSlug($servicoCategoria->getNome());?>" class="link"><?php echo $servicoCategoria->getNome();?></a> &raquo;
                        <strong><?php echo $programacao->getNomeProgramacao();?></strong>
                    </div>

                    <p class="bt-voltar1"><a href="javascript:history.back(-1);" title="Voltar" class="hidetxt">Voltar</a></p>

                    <div class="logo-descr">
                        <img src="<?php echo $servicoLogo;?>" alt="<?php echo $servico->getNome();?>" width="120" height="83" class="left" />
                       
                        <span>
                            <h1 class="tit-logo"><?php echo $servico->getNome();?></h1>
                            <div class="fb-like" data-width="450" data-layout="button_count" data-show-faces="false" data-send="true"></div>

                            <p><?php echo nl2br($servico->getDescricaoInterna());?></p>
                            <?php if($servico->getVideo()):?>
                            <div class='video-link-container'>
                                <a href='<?php echo $servico->getVideo();?>' class='video-link' alt='Abrir vídeo'>
                                    <span class='video-link-bt'></span>
                                </a>
                            </div>
                            <?php endif?>
                        </span>
                    </div>

                    <?php if($servico->getAudio()=='COM' && $totalMenuCategoria > 0){?>

                    <p class="cor-red"><strong>Escolha a Segmentação de Programa</strong></p>

                    <nav role="navigation">
                        <ul class="submenu">
                        	<?php 
                        		$servico->setId($idServico);
                        		$servico->setIdCategoriaServico($idCategoriaServico);
                        		$servico->getMenuServicoCategoria();
                        	?>
                        </ul>
                    </nav>
                    <?php }?>

                    <div class="cont-submenu">
                        <div class="sub-menu">
                        	<?php 
                        		$programacao->setIdServico($idServico);
                        		$programacao->setIdCategoriaServico($idCategoriaServico);
                        		$programacao->setTipoProgramacao('D');
                        		$programacao->setId($idProgramacao);
                        		$existeProgramacaoD = $programacao->existeTipoProgramacao();
                        	
                        		if($existeProgramacaoD){
                        			echo'<p>Programação Diária</p>';
                        			
                        			echo'
                        				<ul>
                        			';
                                		$programacao->getListProgramacao();		
                        			echo'
                            			</ul>
                        			';
                        		}
                        	?>

                            <?php 
                        		$programacao->setIdServico($idServico);
                        		$programacao->setIdCategoriaServico($idCategoriaServico);
                        		$programacao->setTipoProgramacao('S');
                        		$programacao->setId($idProgramacao);
                        		$existeProgramacaoS = $programacao->existeTipoProgramacao();
                        	
                        		if($existeProgramacaoS){
                        			echo'<p>Programação Semanal</p>';
                        			
                        			echo'
                        				<ul>
                        			';
                                		$programacao->getListProgramacao();		
                        			echo'
                            			</ul>
                        			';
                        		}	
                        	?>
                        </div>

                        <div class="audios">
                            <h1><?php echo $programacao->getNomeProgramacao();?></h1>

                            <p><?php echo nl2br($programacao->getDescricao());?></p>

                            <div class="cont-audio">
                                <p>Veja abaixo alguns trechos do programa:</p>
								<?php 
								if($programacao->getAudio1()){
									echo '
	                                <h2>BLOCO 1</h2>
	                                <iframe width="100%" height="166" scrolling="no" frameborder="no" src="'.$programacao->getAudio1().'"></iframe>
									';
								}
								if($programacao->getAudio2()){
									echo '
	                                <h2>BLOCO 2</h2>
	                                <iframe width="100%" height="166" scrolling="no" frameborder="no" src="'.$programacao->getAudio2().'"></iframe>
									';
								}
								if($programacao->getAudio3()){
									echo '
	                                <h2>BLOCO 3</h2>
	                                <iframe width="100%" height="166" scrolling="no" frameborder="no" src="'.$programacao->getAudio3().'"></iframe>
									';
								}
								if($programacao->getAudio4()){
									echo '
	                                <h2>BLOCO 4</h2>
	                                <iframe width="100%" height="166" scrolling="no" frameborder="no" src="'.$programacao->getAudio4().'"></iframe>
									';
								}if($programacao->getAudio5()){
									echo '
	                                <h2>BLOCO 5</h2>
	                                <iframe width="100%" height="166" scrolling="no" frameborder="no" src="'.$programacao->getAudio5().'"></iframe>
									';
								}

                                ?>
                            </div>

                            <ul class="detalhes1">
                                <li><span>Segmentação: </span> <?php echo $programacao->getSegmentacao();?></li>
                                <li><span>Distribuição na grade: </span> <?php echo $programacao->getDistribuicaonagrade();?></li>
                                <li><span>Indicação de horário: </span> <?php echo $programacao->getIndicacaodehorario();?></li>
                                <li><span>Indicativo de intervalo: </span> <?php echo $programacao->getIndicativodeintervalo();?></li>
                                <li><span>Execuções diárias: </span> <?php echo $programacao->getExecucoesdiarias();?></li>
                                <li><span>Apresentação: </span> <?php echo $programacao->getApresentacao();?></li>
                                <li><span>Tempo: </span> <?php echo $programacao->getTempo();?></li>
                            </ul>

                            <p><a href="#" title="Assine Agora" class="bt-assine">Assine Agora!!!</a></p>
                        </div>
                    </div><!-- FINAL CONT-SUBMENU -->
                </section><!-- FINAL CONT-PROGRAMA -->
            </div><!-- FINAL CONT-SERV -->
        </section><!-- FINAL CONTENT --> 
    </div> 
</div>

<?php include "inc/footer.php"; ?>

<section id="formulario-assine">
    <h3>Assine Já: <span id="assunto"><?php echo $programacao->getNomeProgramacao();?></span></h3>

    <a href="#" title="Fechar" class="bt-fechar1 hidetxt">Fechar</a>

    <div class="content-regiao">
        <!-- <form action="#" method="post" id="formID">  -->
            <ul>
                <li>
                    <label for="nome">Nome*:</label>
                    <input type="text" name="nome" id="nome" class="validate[required]" />
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
                    <input type="image" src="<?php echo URL;?>img/bt-cancelar.jpg" name="Cancelar" alt="Cancelar" class="cancelar" />
                    <input type="image" src="<?php echo URL;?>img/bt-enviar1.jpg" name="Enviar" alt="Enviar" class="enviar" />
                </li>
            </ul>
        <!-- </form>  -->
    </div>
</section>
<input type="hidden" id="url" value="<?php echo URL;?>">
<script type="text/javascript" src="<?php echo URL;?>js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>js/jquery.colorbox.js"></script>
<script type="text/javascript">
    $(".bt-assine").click(function(e){
        e.preventDefault();
        $("#formulario-assine").fadeIn();
    });
    $(".cancelar, .bt-fechar1").click(function(e){
        e.preventDefault();
        $("#formulario-assine").fadeOut();
    });

    $('.video-link').colorbox({iframe: true, width: 640, height: 390, href:function(){
        var videoId = new RegExp('[\\?&]v=([^&#]*)').exec(this.href);
        if (videoId && videoId[1]) {
            return 'http://youtube.com/embed/'+videoId[1]+'?rel=0&wmode=transparent';
        }
    }});

    $('.enviar').click(function() {  

		var nome = $("#nome").val();
		var assunto = $("#assunto").html();
		var mail = $("#mail").val();
		var tel = $("#tel").val();
		var radio = $("#radio").val();
		var msg = $("#msg").val();
		var acao = "contatoAssinar";
		var url = $("#url").val()+'funcoes/contatoAssinar.php';

		// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
		$.post(url, {
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
						$("#nome").val("");
						$("#assunto").val("");
						$("#mail").val("");
						$("#tel").val("");
						$("#radio").val("");
						$("#msg").val("");
						$("#formulario-assine").hide();
					}else{
						alert('Erro no envio do email, entre em contato por telefone');
					}	
					
		});
 	});

    var $sidebar   = $("#formulario-assine"),
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
</script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
<script type="text/javascript" src="<?php echo URL;?>js/scripts.js"></script>
<script type="text/javascript" src="<?php echo URL;?>js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript">
    $(".cont-audio").accordion({
        header: "h2"
    });
</script>
</body>
</html>
