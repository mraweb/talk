<?php 
include_once 'classe/Noticia.php';

$noticia = new Noticia();
$noticia->setId($idNoticia);
$noticia->geraDadosIdNoticia();
//busca proxima noticia
$noticia->setTypeNavegacao("pro");
$proximaNoticia = $noticia->retornaProxNoticia();
//busca noticia anterior
$noticia->setTypeNavegacao("ant");
$anteriorNoticia = $noticia->retornaProxNoticia();
//busca imagem noticia
$imgGde = str_replace("thumb", "imagem", $noticia->getImagem());
$caminhoImagem = URL.'upload/imagem/'.$imgGde;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title><?php echo $noticia->getTitulo();?> | Talk Radio - Soluções em Radiofusão</title>
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/style.css">
<!--[if ie]>
	<script type="text/javascript" src="<?php echo URL;?>js/html5-ie.js"></script>
<![endif]-->
<?php include "analytics.php"; ?>
<?php include "inc/monitor.php"; ?>
</head>
<body itemscope itemtype="http://schema.org/WebPage">

<div class="bg-int">
    <?php include "inc/header.php"; ?>
    
    <div role="main">
        <section id="content">
        	<div itemprop="breadcrumb" id="bread">
                <a href="<?php echo URL;?>" class="link">Home</a> &raquo;
                <a href="<?php echo URL;?>noticias" class="link">Notícias</a> &raquo;
                <strong><?php echo $noticia->getTitulo();?></strong>
            </div>

            <p class="bt-voltar"><a href="javascript:history.back(-1);" title="Voltar" class="hidetxt">Voltar</a></p>
			<?php 
				if($noticia->getImagem()){
					echo'<img src="'.$caminhoImagem.'" alt="'.$noticia->getTitulo().'" width="277" height="191" class="img-left" />';
				}
			?>
    		
            <h1 class="titulo h1-noti"><span><?php echo $noticia->getTitulo();?></span></h1>

            <section class="midias">
                <div class="fb-like" data-width="450" data-layout="button_count" data-show-faces="false" data-send="true"></div>

                <div class="esp-top">
                	<script type="text/javascript">
						!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
					</script>
                    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="pt" data-via="">Tweetar</a>
               	</div>
            </section>
            
            <p class='conteudo'><?php echo nl2br($noticia->getDescricao());?></p>
            <div class='banners-noticia'>
                <?php foreach($noticia->getBanners() as $banner):?>
                    <a href='<?php echo $banner['link']?>' title='Abrir este link'>
                        <img src='<?php echo $banner['imagem']?>' />
                    </a>
                <?php endforeach?>
            </div>
            
            <ul class="navega">
            	
                <?php 
                	if($anteriorNoticia){
                 		$linkAnterior = URL.'noticia/'.criarSlug($anteriorNoticia);
                 		echo'<li class="left"><a href="'.$linkAnterior.'" title="'.$anteriorNoticia.'" class="bt-anterior hidetxt">Notícia Anterior</a></li>';
                 	}
                 	if($proximaNoticia){
                 		$linkProxima = URL.'noticia/'.criarSlug($proximaNoticia);
                 		echo'<li class="right"><a href="'.$linkProxima.'" title="'.$proximaNoticia.'" class="bt-proximo hidetxt">Próxima Notícia</a></li>';
                 	}
                ?>
                
            </ul>
        </section><!-- FINAL CONTENT --> 
    </div> 
</div>

<?php include "inc/footer.php"; ?>
<script type="text/javascript" src="<?php echo URL;?>js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>js/scripts.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
</body>
</html>
