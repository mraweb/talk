<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title>Quem Somos | Talk Radio - Programas de  Radio</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
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
        <section id="content" class="pdg-top">
            <aside>
                <nav role="navigation">
                    <ul class="tabs">
                        <li><a href="#quem-somos" title="O Grupo Talk Rádio" class="hover1">O Grupo Talk Rádio</a></li>
                        <li><a href="#nossas-diretrizes" title="Nossas Diretrizes" class="hover2">Nossas Diretrizes</a></li>
                        <li><a href="#nossa-sede" title="Nossa Sede" class="hover3">Nossa Sede</a></li>
                        <li><a href="#equipe" title="Equipe" class="hover4">Equipe</a></li>
                    </ul>
                </nav>
            </aside>

            <section class="tab_content" id="quem-somos">
                <h1 class="titulo"><span>Quem</span> Somos</h1>

                <p>O Grupo Talk Radio é uma empresa de comunicação que opera em todo o território nacional.  Fundada por Alessandro Caliu  em 18 de outubro de 2004, o grupo é modelo na produção e distribuição de conteúdos radiofônicos no país. Atualmente conta escritório no Paraná e em São Paulo.</p>
                
                <p>O Grupo Talk Radio é um conjunto de conteúdos radiofônicos e serviços que se inspiram na produção com alto padrão valorizando o nome da
                estação de rádio. Criamos programas para radios exclusivos e de estilos variados para atender a todos os tipos de ouvintes, sejam jovens ou adultos.
</p>
                
                <p>Com uma equipe formada de profissionais reconhecidos no mercado com uma grande vivência no meio, o Grupo Talk Radio investe constante e
                permanente na busca incessante de fórmulas criativas e modernas para que você possa ter uma rádio que faz a diferença em sua área de abrangência,
                levando ao ar uma programação preferida pela maioria dos ouvintes  e a melhor alternativa de investimento para os seus clientes, ou seja, uma rádio
              boa para se ouvir e ótima para se investir.</p>
                
                <p>O Grupo Talk Radio é especializado na criação de premiados programas para radios e produtos para diferentes formatos de emissoras.</p>
                
                <strong>"Não importa onde sua rádio está, se você tiver Talk Radio, você  vai obter sucesso em sua rádio!"</strong>
                
                <p>Trabalhamos com as estações de rádio. Se suas necessidades são grandes ou pequenas, nós podemos ajudar a encontrar um pacote existente ou 	
projetar algo para atender às suas necessidades.</p>
                
                <p>Sabemos que os orçamentos de programação com qualidade são difíceis de conseguir nos dias atuais. Convidamos você a aprender mais sobre o Grupo Talk Radio, e nosso compromisso de longa duração para a produção de material e 	
                serviços da mais alta qualidade. No Grupo Talk Radio você sempre terá o melhor, porque nós nos preocupamos com a sua marca.</p>
            </section><!-- FINAL QUEM SOMOS -->

			<section class="tab_content" id="nossas-diretrizes">
                <h2 class="titulo"><span>Nossa</span> Visão</h2>

                <p>Produzir e distribuir programas para radios com excelência em qualidade para proporcionar aos nossos clientes a valorização de sua marca e garantir a liderança em seu mercado de atuação.</p>
                
                <h2 class="titulo"><span>Nossa</span> Missão</h2>

                <p>Ser a produtora de conteúdo de sua estação de rádio.</p>
                
                <h2 class="titulo"><span>Nossos</span> Valores</h2>

                <p>Facilitar a comunicação, inovar, ter ética e transparência em suas relações, integridade na condução de suas atividades, liberdade em todas
as suas formas, oposição a qualquer tipo de preconceito seja ele racial, moral, religioso ou político, satisfação pessoal e profissional de todos os seus
colaboradores, comprometimento com a expressão, benefícios oferecidos superiores as opções de mercado, divulgação e promoção de conteúdos
culturais, artísticos, educativos e informativos, responsabilidade para com os ouvintes e demais usuários de nossos produtos e serviços.</p>

				<p class="bold">Estas visões definem o Grupo Talk Rádio para com o seu público.</p>
            </section><!-- FINAL NOSSAS DIRETRIZES -->
	
			<section class="tab_content" id="nossa-sede">
				<h2 class="titulo"><span>Nossa</span> Sede</h2>
                
                <p>Com 3 estúdios, sendo 1 estúdio de produção com 2 cabines de gravação e 6 ilhas, 1 estúdio musical para a produção fonográfica e 1 estúdio para programas AO-VIVO. As novas instalações da Rede Talk Radio foram construidas para atender de forma rápida todos os nossos clientes.</p>

				<img src="img/nossa-sede.jpg" alt="Nossa Sede" width="770" height="190" />
			</section><!-- FINAL NOSSA SEDE -->
			
            <section class="tab_content" id="equipe">
            	<h2 class="titulo"><span>Equipe</span></h2>
                <h3>Profissionais trabalhando por sua Rádio</h3>
                
                <section id="alessandro-caliu" class="tab_content-equipe">
                	<img src="img/equipe/alessandro-caliu.png" alt="Alessandro Caliu" width="120" height="120" class="left" />
                    
                    <div>
                    	<h3>Alessandro Caliu</h3>
                        
                        <p>Radialista por paixão, trabalhou em diversas emissoras como Jovem Pan, Transamérica, Radio Globo entre outras. Formado em Comunicação Social pela faculdade CESUMAR - Centro Universitário de Maringá com especializaçao na área publicitária, em Administração de Empresas pela UNOESTE de Presidente Prudente e pós-graduado em Gestão Estratégica pelas Universidades Maringá. Caliu é o diretor geral do Grupo Talk Radio.</p>
                    </div>
                </section>
                <?php 
                	include_once 'classe/Equipe.php';
                	$equipe = new Equipe();
                	$equipe->setType("detalhes");
                	$equipe->listAllEquipe();
                ?>

                <ul class="tabs-equipe">
                	<li><a href="#alessandro-caliu" title="Alessandro Caliu"><img src="img/equipe/alessandro-caliu.png" alt="Alexandre Caliu" width="96" height="96" /></a></li>
					<?php 
	                	include_once 'classe/Equipe.php';
	                	$equipe = new Equipe();
	                	$equipe->setType("li");
	                	$equipe->listAllEquipe();
                	?>
                </ul>
            </section><!-- FINAL EQUIPE --> 
        </section><!-- FINAL CONTENT --> 
    </div> 
</div>

<?php include "inc/footer.php"; ?>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
</body>
</html>