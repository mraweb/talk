<?php 
include_once 'classe/Noticia.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title>Notícias | Talk Radio - Soluções em Radiofusão</title>
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/style.css">
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
            <h1 class="titulo"><span>Notícias</span></h1>

            <p>Soluções em conteúdos para empresas preocupadas em atender bem os seus clientes e reduzir seus custos, conheça alguns cases de sucesso.</p>

			<?php 
            	$pag = $url[2];
				$url = URL.'noticias';
				
            	$noticia = new Noticia();
				$noticia->setUrl($url);
				$noticia->SetNumPagina($pag);
            	$noticia->getListAllNoticia();
            	
            	if($noticia->totalRegistros() > 3){
            		
            		echo'<ul class="paginacao">';
            			$noticia->geraPaginacaoSite();
            		echo'</ul>';

            	}
            ?>
        </section><!-- FINAL CONTENT --> 
    </div> 
</div>

<?php include "inc/footer.php"; ?>
<script type="text/javascript" src="<?php echo URL;?>js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>js/scripts.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
</body>
</html>
