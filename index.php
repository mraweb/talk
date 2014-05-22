<?php 
include_once 'funcoes/define.php';
include_once 'funcoes/geral.php';
include_once 'classe/verUrl.php';
include_once 'classe/ManipulateData.php';
include_once 'classe/Servico.php';
include_once 'classe/Noticia.php';
$noticiaHome = new Noticia();

include_once 'classe/Depoimento.php';
$depoimentoHome = new Depoimento();

include_once 'classe/Programacao.php';
$programacaoHome = new Programacao();

include_once 'classe/VideoHome.php';
$videoHome = new VideoHome();

include_once 'classe/AudioHome.php';
$audioHome = new AudioHome();

$url = explode('/', $_GET['url']);  


if($url[0]=="noticia" && $url[1]!=""){
	$pes = new ManipulateData();
	$pes->setTable("noticia");
	$pes->setFieldId($url[1]);
	$pes->setFieldId2("titulo");	
	$pes->setAtributo("id");
	$idNoticia = $pes->getUmValorTabela();
}

if($url[0]=="imprensa" && $url[1]!=""){
	$pes = new ManipulateData();
	$pes->setTable("imprensa");
	$pes->setFieldId($url[1]);
	$pes->setFieldId2("titulo");	
	$pes->setAtributo("id");
	$idImprensa = $pes->getUmValorTabela();
}

if($url[0]=="programas" && $url[1]!=""){
	$pes = new ManipulateData();
	$pes->setTable("servico");
	$pes->setFieldId($url[1]);
	$pes->setFieldId2("nome");	
	$pes->setAtributo("id");
	$idServico = $pes->getUmValorTabela();

	//acesso direto a programacao
	$programacaoHome->setIdServico($idServico);
	$ids = $programacaoHome->getAcessoDiretoProgramacaoPorIds();

	if($ids['idCategoriaServico'] > 0 && $ids['idProgramacao'] > 0 && $url[2]==""){
	  $idCategoriaServico = $ids['idCategoriaServico'];
	  $idProgramacao = $ids['idProgramacao'];
	}
}

if($url[0]=="programas" && $idServico > 0 && $url[2]!=""){
	$pes = new ManipulateData();
	$pes->setTable("categoria_servico");
	$pes->setFieldId($url[2]);
	$pes->setFieldId2("nome");	
	$pes->setAtributo("id");
	$idCategoriaServico = $pes->getUmValorTabela();
	
	//acesso direto a programacao
	$programacaoHome->setIdServico($idServico);
	$programacaoHome->setIdCategoriaServico($idCategoriaServico);
	$ids = $programacaoHome->getAcessoDiretoProgramacaoPorIds();

	if($ids['idCategoriaServico'] > 0 && $ids['idProgramacao'] > 0 && $url[2]!=""){
	  $idCategoriaServico = $ids['idCategoriaServico'];
	  $idProgramacao = $ids['idProgramacao'];
	}
}

if($url[0]=="programas" && $idServico > 0 && $idCategoriaServico && $url[3]!=""){
	$pes = new ManipulateData();
	$pes->setTable("servico_programacao");
	$pes->setFieldId($url[3]);
	$pes->setFieldId2("nome");	
	$pes->setAtributo("id");
	$idProgramacao = $pes->getUmValorTabela();
}

if($url[1]=="entrevista" && $url[2]!=""){
	$pes = new ManipulateData();
	$pes->setTable("entrevista");
	$pes->setFieldId($url[2]);
	$pes->setFieldId2("titulo");	
	$pes->setAtributo("id");
	$idEntrevista = $pes->getUmValorTabela();
}

if($url[0]==""){
?>
<!DOCTYPE html><!-- COMENTARIO TESTE GIT -->
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

<title>Programas de Radio - Talk Radio - Programetes para Radios</title>

<link rel="canonical" href="http://www.talksat.com.br" />

<meta name="description" content="A melhor produtora de conteúdos, programas e programetes para rádios do Brasil. Programas de radio, Programetes para radios, streaming, jingle, vinhetas, gravação comercial, humor."/>

<meta name="keywords" content="conteudo-para-radio, conteudo para rádio, programas de radio, programação para rádios, programas prontos de rádio, conteudo-para-radios,programas-de-radio,programetes para radios, conteudo, conteudos, rede-de-radios, super-rede,Talk-Radio, gravacao, band, banda, humor, radio-marcas, mix-fm, jovem-pan, transamerica, artistas, vinhetas, musica, nativa, cifras, site, tema, som, melodia, baixar, tv, emissora-de-radio, talk-radio, musica, jingles, vinhetas, radiofonico, producao, produtor, locutor, voz, artistas, radios, temas, radio, emissora, am, fm, comunitaria,educativa,radiodifusao, onda, sonora, radio-digital, amirt, aerj, aesp, aerp, midia, agencia, playlist, multiplay, accessweb, automacao, transmissor,  amplitude-modulada, frequencia-modulada, gravacao-comercial, trilha, trilhas, grave, modulo, streaming, hts, pop, popular, ecletica, mpb, rock, dance, dj, sertanejo, noticia, informacao, entretenimento, caliu, alessandro-caliu, acessoria, artistico, produtora-de-audio, conteudo-radiofonico, streaming,jingle, vinheta, site-administravel,programas, radio" />

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/colorbox.css" />
<link rel="stylesheet" type="text/css" href="css/colors.css" />
<link rel="stylesheet" type="text/css" href="css/standards.css" />
<link rel="stylesheet" type="text/css" href="css/structure.css" />
<!--[if ie]>
	<script type="text/javascript" src="js/html5-ie.js"></script>
<![endif]-->
<?php include "analytics.php"; ?>
<?php include "inc/monitor.php"; ?>
</head>
<body itemscope itemtype="http://schema.org/WebPage">

<div class="bg-home">
    <?php include "inc/header.php"; ?>
    
    <div role="main">
        <section id="content">
            <div id="slide-home">
                <div class="video-destaque">
	        		<?php $videoHome->getDestaqueVideosHome();?>
	        	</div>
	        	
	            <div class="audios-destaque">
	            	<h2>Programas em Destaque</h2>
			        
			        <ul>
			        	<?php $audioHome->getListAllAudioHome(); ?>
			        	
			        	<!-- <li>
			        		<h3>GameBall - O Jogo</h3>

				        	<a href="http://soundcloud.com/perderopeso/musicas-para-malhar-e-perder-peso" class="sc-player borda">My dub track</a>
				        </li>
				        
				        <li>
				        	<h3>GameBall - O Jogo</h3>

				        	<a href="http://soundcloud.com/matas/matas-petrikas-live-at-gravity-club-30-05-2008" class="sc-player borda">My dub track</a>
				        </li>
				        
				        <li>
				        	<h3>GameBall - O Jogo</h3>

				        	<a href="http://soundcloud.com/matas/on-the-bridge" class="sc-player borda">Secure track</a>
				        </li> -->
			        </ul>
	        	</div>
            </div><!-- FINAL SLIDE HOME -->

            <section class="servicos">
                <h2>Veja mais Vídeos</h2>

                <ul class="jcarousel-skin-servicos padrao">
                	<?php $videoHome->getListAllVideosHome();?>
                </ul>
            </section><!-- FINAL SERVICOS -->

            <section class="noticias">
                <h2 class="h2-home"><span>Notícias</span> Fique Antenado</h2>

                <p>A <strong>Talk Rádio</strong> está sempre atualizada, veja nossas últimas notícias.</p>

                <?php 
                	$noticiaHome->getListNoticiaHome();
                ?>

                <p class="veja"><a href="<?php echo URL;?>noticias" title="Veja todas as Notícias">Veja todas as Notícias &raquo;</a></p>
            </section><!-- FINAL NOTICIAS -->

            <section class="depoimentos">
                <h2 class="h2-home"><span>Depoimentos</span></h2>

                <p>Vejam o que nossos parceiros dizem sobre nosso <em>conteúdo, programas, nossas vinhetas para radio</em>:</p>

                <?php 
                	$depoimentoHome->getListDepoimentoHome();
                ?>

                <p class="veja"><a href="<?php echo URL;?>depoimentos" title="Veja todos os Depoimentos">Veja todos os Depoimentos &raquo;</a></p>
            </section><!-- FINAL DEPOIMENTOS -->
        </section><!-- FINAL CONTENT --> 
    </div> 
</div>

<?php include "inc/footer.php"; ?>

<!-- <div class="fimdeano">
    <img src="img/depoimento.jpg" height="667" width="517" alt="Depoimento Edmilson Pereira - Diretor Geral de Jornalismo (Rede FM)" />

    <a href="#"></a>
</div>m

<div id="mask1"></div> -->

<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/slides.min.jquery.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox.js"></script>
<script type="text/javascript">
	$('.youtube').colorbox({iframe: true, width: 640, height: 390, href:function(){
        var videoId = new RegExp('[\\?&]v=([^&#]*)').exec(this.href);
        if (videoId && videoId[1]) {
            return 'http://youtube.com/embed/'+videoId[1]+'?rel=0&wmode=transparent';
        }
    }});
</script>
<script type="text/javascript" src="js/soundcloud.player.api.js"></script>
<script type="text/javascript" src="js/sc-player.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
<script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>
<?php 
}else{
	$url = new verURL();
	$url->trocarURL($_GET['url'],$idImprensa,$idNoticia,$idServico,$idCategoriaServico,$idProgramacao,$idEntrevista);
}
?>