<?php 
include_once 'classe/Imprensa.php';

$imprensa = new Impresa();
$imprensa->setId($idImprensa);
$imprensa->geraDadosIdImprensa();
$caminhoImagem = URL.'upload/thumb/'.$imprensa->getImagem();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title><?php echo $imprensa->getTitulo();?> | Talk Radio - Soluções em Radiofusão</title>
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/colorbox.css">
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
                <a href="<?php echo URL;?>imprensa" class="link">Imprensa</a> &raquo;
                <strong><?php echo $imprensa->getTitulo();?></strong>
            </div>

            <p class="bt-voltar"><a href="javascript:history.back(-1);" title="Voltar" class="hidetxt">Voltar</a></p>
			<?php 
				if($imprensa->getImagem()){
					echo'<img src="'.$caminhoImagem.'" alt="Imprensa Detalhe" width="107" height="145" class="img-left" />';
				}
			?>
    		
            
            <h1 class="titulo h1-noti"><span><?php echo $imprensa->getTitulo();?></span></h1>

            <section class="midias">
                <div class="fb-like" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
                <!--<div>
                	<script type="text/javascript">
						!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
					</script>
                    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="pt" data-via="">Tweetar</a>
               	</div>-->
            </section>
            
            <p><?php echo nl2br($imprensa->getDescricao());?></p>
            
            <h2 class="h2-impr">Galeria de Fotos</h2>

            <ul class="galeria">
            	<?php 
            		$imprensa->setId($idImprensa);
            		$imprensa->getGaleriaImagensDetalhe();
            	?>
            </ul>
        </section><!-- FINAL CONTENT --> 
    </div> 
</div>

<?php include "inc/footer.php"; ?>
<script type="text/javascript" src="<?php echo URL;?>js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>js/jquery.colorbox.js"></script>
<script type="text/javascript">
// lightbox
$(document).ready(function(){
    $(".galeria a").colorbox({rel:'galeria a'});
});
</script>
<script type="text/javascript" src="<?php echo URL;?>js/scripts.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
</body>
</html>
