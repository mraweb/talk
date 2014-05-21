<?php 
include_once("classe/Servico.php");
$servico = new Servico();
$servico->setId($idServico);
$servico->geraDadosIdServico();
$totalMenuCategoria = $servico->getTotalMenuServicoCategoria();

$servicoLogo = URL.'upload/arquivos/'.$servico->getLogo();
// $size = explode('|', SizeImage($servicoLogo));

include_once("classe/CategoriaServico.php");
$servicoCategoria = new CategoriaServico();
$servicoCategoria->setId($idCategoriaServico);
$servicoCategoria->geraDadosIdCategoriaServico();

include_once("classe/Programacao.php");
$programacao = new Programacao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title><?php echo $servicoCategoria->getNome();?> | Talk Radio - Soluções em Radiofusão</title>
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/style.css">
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
                        <strong><?php echo $servicoCategoria->getNome();?></strong>
                    </div>

                    <p class="bt-voltar1"><a href="javascript:history.back(-1);" title="Voltar" class="hidetxt">Voltar</a></p>

                    <div class="logo-descr">
                        <img src="<?php echo $servicoLogo;?>" alt="<?php echo $servico->getNome();?>" width="120" height="83" class="left" />
                        
                        <span>
                            <h1 class="tit-logo"><?php echo $servico->getNome();?></h1>
                            <div class="fb-like" data-width="450" data-layout="button_count" data-show-faces="false" data-send="true"></div>

                            <p><?php echo nl2br($servico->getDescricaoInterna());?></p>
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
                    </div><!-- FINAL CONT-SUBMENU -->
                </section><!-- FINAL CONT-PROGRAMA -->
            </div><!-- FINAL CONT-SERV -->
        </section><!-- FINAL CONTENT --> 
    </div> 
</div>

<?php include "inc/footer.php"; ?>

<script type="text/javascript" src="<?php echo URL;?>js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
<script type="text/javascript" src="<?php echo URL;?>js/scripts.js"></script>

</body>
</html>