<?php 
include_once("classe/Servico.php");
$servicos = new Servico();
?>
<div class="teste">
<div class="programa" id="talkradio">
    <div class="top-prog">
        <img src="img/talkradio.png" alt="Talkrádio" width="118" height="79" class="left" />
		<?php 
		//recupero os dados do servico, pelo id
			$servicos->setId(1);
			$servicos->geraDadosIdServico();
    	?>
        <ul class="detalhes">
            <li><span>Segmentação: </span> <?php echo $servicos->getSegmentacao();?></li>
            <li><span>Distribuição na grade: </span> <?php echo $servicos->getDistribuicaonagrade();?></li>
            <li><span>Indicação de horário: </span> <?php echo $servicos->getIndicacaodehorario();?></li>
            <li><span>Indicativo de intervalo: </span> <?php echo $servicos->getIndicativodeintervalo();?></li>
            <li><span>Execuções diárias: </span> <?php echo $servicos->getExecucoesdiarias();?></li>
            <li><span>Apresentação: </span> <?php echo $servicos->getApresentacao();?></li>
            <li><span>Tempo: </span> <?php echo $servicos->getTempo();?></li>
        </ul>
    </div><!-- FIANL TOP PROG -->

    <ul class="tabs1 menu-prog">
        <?php 
	    	$servicos->setId(1);
	    	$servicos->setItem(1);
	    	$servicos->getMenuProg();
    	?>
    </ul>

    <div class="conteudo-prog">
		<?php 
        	//monta a div tab_content
		    $servicos->setId(1);
		    $servicos->setItem(1);
		    $servicos->getMenuProg2();
	    ?>

        <section class="bottom-prog">
            <div class="logo-prog">
                <img src="img/talkradio.png" alt="Talkrádio" width="118" height="79" class="left" />

                <h3><?php echo $servicos->getNome();?></h3>

                <p><?php echo nl2br($servicos->getDescricao());?></p>
            </div>

            <div class="midias-prog">
                <h3>Compartilhe</h3>

                <ul class="midias-prog-ul">
                    <!--<li><a href="https://twitter.com/grupotalkradio" rel="external" title="Twitter" class="bt-twitter hidetxt">Twitter</a></li>-->
                    <li><a href="https://www.facebook.com/redetalkradio" rel="external" title="Facebook" class="bt-face hidetxt">Facebook</a></li>
                </ul>
            </div>
        </section>
    </div><!-- FINAL CONTEUDO-PROG -->
    <a href="#" id="close"><img src="img/fechar.jpg" alt="Fechar" width="12" height="15"></a>
</div>

<div class="programa" id="radiofonico">
    <div class="top-prog">
        <img src="img/conteudoradiofonico1.png" alt="Conteúdo Radiofônico" width="88" height="86" class="left" />

        <?php 
		//recupero os dados do servico, pelo id
			$servicos->setId(2);
			$servicos->geraDadosIdServico();
    	?>
        <ul class="detalhes">
            <li><span>Segmentação: </span> <?php echo $servicos->getSegmentacao();?></li>
            <li><span>Distribuição na grade: </span> <?php echo $servicos->getDistribuicaonagrade();?></li>
            <li><span>Indicação de horário: </span> <?php echo $servicos->getIndicacaodehorario();?></li>
            <li><span>Indicativo de intervalo: </span> <?php echo $servicos->getIndicativodeintervalo();?></li>
            <li><span>Execuções diárias: </span> <?php echo $servicos->getExecucoesdiarias();?></li>
            <li><span>Apresentação: </span> <?php echo $servicos->getApresentacao();?></li>
            <li><span>Tempo: </span> <?php echo $servicos->getTempo();?></li>
        </ul>
    </div><!-- FIANL TOP PROG -->

    <ul class="tabs2 menu-prog">
    	<?php 
    		$servicos->setId(2);
    		$servicos->setItem(2);
			$servicos->getMenuProg();
    	?>
    </ul>

    <div class="conteudo-prog">
        <?php 
        	//monta a div tab_content
		    $servicos->setId(2);
		    $servicos->setItem(2);
		    $servicos->getMenuProg2();
	    ?>


        <section class="bottom-prog">
            <div class="logo-prog">
                <img src="img/conteudoradiofonico1.png" alt="Conteúdo Radiofônico" width="88" height="86" class="left" />

                <h3><?php echo $servicos->getNome();?></h3>

                <p><?php echo nl2br($servicos->getDescricao());?></p>
          	</div>

            <div class="midias-prog">
                <h3>Compartilhe</h3>

                <ul class="midias-prog-ul">
                    <!--<li><a href="https://twitter.com/grupotalkradio" rel="external" title="Twitter" class="bt-twitter hidetxt">Twitter</a></li>-->
                    <li><a href="https://www.facebook.com/redetalkradio" rel="external" title="Facebook" class="bt-face hidetxt">Facebook</a></li>
                </ul>
            </div>
        </section>
    </div><!-- FINAL CONTEUDO-PROG -->
    <a href="#" id="close1"><img src="img/fechar.jpg" alt="Fechar" width="12" height="15"></a>
</div>

<div class="programa" id="talkinbox">
    <div class="top-prog">
        <img src="img/talkinbox1.png" alt="Talkinbox" width="118" height="78" class="left" />

        <?php 
		//recupero os dados do servico, pelo id
			$servicos->setId(3);
			$servicos->geraDadosIdServico();
    	?>
        <ul class="detalhes">
            <li><span>Segmentação: </span> <?php echo $servicos->getSegmentacao();?></li>
            <li><span>Distribuição na grade: </span> <?php echo $servicos->getDistribuicaonagrade();?></li>
            <li><span>Indicação de horário: </span> <?php echo $servicos->getIndicacaodehorario();?></li>
            <li><span>Indicativo de intervalo: </span> <?php echo $servicos->getIndicativodeintervalo();?></li>
            <li><span>Execuções diárias: </span> <?php echo $servicos->getExecucoesdiarias();?></li>
            <li><span>Apresentação: </span> <?php echo $servicos->getApresentacao();?></li>
            <li><span>Tempo: </span> <?php echo $servicos->getTempo();?></li>
        </ul>
    </div><!-- FIANL TOP PROG -->

    <ul class="tabs3 menu-prog">
        <?php 
    		$servicos->setId(3);
    		$servicos->setItem(3);
			$servicos->getMenuProg();
    	?>
    </ul>

    <div class="conteudo-prog">
        <?php 
        	//monta a div tab_content
		    $servicos->setId(3);
		    $servicos->setItem(3);
		    $servicos->getMenuProg2();
	    ?>

        <section class="bottom-prog">
            <div class="logo-prog">
                <img src="img/talkinbox1.png" alt="Talkinbox" width="118" height="78" class="left" />

                <h3><?php echo $servicos->getNome();?></h3>

                <p><?php echo nl2br($servicos->getDescricao());?></p>
          	</div>

            <div class="midias-prog">
                <h3>Compartilhe</h3>

                <ul class="midias-prog-ul">
                    <!--<li><a href="https://twitter.com/grupotalkradio" rel="external" title="Twitter" class="bt-twitter hidetxt">Twitter</a></li>-->
                    <li><a href="https://www.facebook.com/redetalkradio" rel="external" title="Facebook" class="bt-face hidetxt">Facebook</a></li>
                </ul>
            </div>
        </section>
    </div><!-- FINAL CONTEUDO-PROG -->
    <a href="#" id="close2"><img src="img/fechar.jpg" alt="Fechar" width="12" height="15"></a>
</div>

<div class="programa" id="talkshow">
    <div class="top-prog">
        <img src="img/talkshow1.png" alt="Talkshow" width="118" height="71" class="left" />

        <?php 
		//recupero os dados do servico, pelo id
			$servicos->setId(4);
			$servicos->geraDadosIdServico();
    	?>
        <ul class="detalhes">
            <li><span>Segmentação: </span> <?php echo $servicos->getSegmentacao();?></li>
            <li><span>Distribuição na grade: </span> <?php echo $servicos->getDistribuicaonagrade();?></li>
            <li><span>Indicação de horário: </span> <?php echo $servicos->getIndicacaodehorario();?></li>
            <li><span>Indicativo de intervalo: </span> <?php echo $servicos->getIndicativodeintervalo();?></li>
            <li><span>Execuções diárias: </span> <?php echo $servicos->getExecucoesdiarias();?></li>
            <li><span>Apresentação: </span> <?php echo $servicos->getApresentacao();?></li>
            <li><span>Tempo: </span> <?php echo $servicos->getTempo();?></li>
        </ul>
    </div><!-- FIANL TOP PROG -->

    <ul class="tabs4 menu-prog">
        <?php 
    		$servicos->setId(4);
    		$servicos->setItem(4);
			$servicos->getMenuProg();
    	?>
    </ul>

    <div class="conteudo-prog">
        <?php 
        	//monta a div tab_content
		    $servicos->setId(4);
		    $servicos->setItem(4);
		    $servicos->getMenuProg2();
	    ?>

        <section class="bottom-prog">
            <div class="logo-prog">
                <img src="img/talkshow1.png" alt="Talkshow" width="118" height="71" class="left" />

               <h3><?php echo $servicos->getNome();?></h3>

                <p><?php echo nl2br($servicos->getDescricao());?></p>
            </div>

            <div class="midias-prog">
                <h3>Compartilhe</h3>

                <ul class="midias-prog-ul">
                    <!--<li><a href="https://twitter.com/grupotalkradio" rel="external" title="Twitter" class="bt-twitter hidetxt">Twitter</a></li>-->
                    <li><a href="https://www.facebook.com/redetalkradio" rel="external" title="Facebook" class="bt-face hidetxt">Facebook</a></li>
                </ul>
            </div>
        </section>
    </div><!-- FINAL CONTEUDO-PROG -->
    <a href="#" id="close3"><img src="img/fechar.jpg" alt="Fechar" width="12" height="15"></a>
</div>

<div class="programa" id="supertemas">
    <div class="top-prog">
        <img src="img/supertemas1.png" alt="Super Temas" width="118" height="71" class="left" />

        <?php 
		//recupero os dados do servico, pelo id
			$servicos->setId(5);
			$servicos->geraDadosIdServico();
    	?>
        <ul class="detalhes">
            <li><span>Segmentação: </span> <?php echo $servicos->getSegmentacao();?></li>
            <li><span>Distribuição na grade: </span> <?php echo $servicos->getDistribuicaonagrade();?></li>
            <li><span>Indicação de horário: </span> <?php echo $servicos->getIndicacaodehorario();?></li>
            <li><span>Indicativo de intervalo: </span> <?php echo $servicos->getIndicativodeintervalo();?></li>
            <li><span>Execuções diárias: </span> <?php echo $servicos->getExecucoesdiarias();?></li>
            <li><span>Apresentação: </span> <?php echo $servicos->getApresentacao();?></li>
            <li><span>Tempo: </span> <?php echo $servicos->getTempo();?></li>
        </ul>
    </div><!-- FIANL TOP PROG -->

    <ul class="tabs5 menu-prog">
        <?php 
    		$servicos->setId(5);
    		$servicos->setItem(5);
			$servicos->getMenuProg();
    	?>
    </ul>

    <div class="conteudo-prog">
        <?php 
        	//monta a div tab_content
		    $servicos->setId(5);
		    $servicos->setItem(5);
		    $servicos->getMenuProg2();
	    ?>

        <section class="bottom-prog">
            <div class="logo-prog">
                <img src="img/supertemas1.png" alt="Super Temas" width="118" height="71" class="left" />

                <h3><?php echo $servicos->getNome();?></h3>

                <p><?php echo nl2br($servicos->getDescricao());?></p>
            </div>

            <div class="midias-prog">
                <h3>Compartilhe</h3>

                <ul class="midias-prog-ul">
                    <!--<li><a href="https://twitter.com/grupotalkradio" rel="external" title="Twitter" class="bt-twitter hidetxt">Twitter</a></li>-->
                    <li><a href="https://www.facebook.com/redetalkradio" rel="external" title="Facebook" class="bt-face hidetxt">Facebook</a></li>
                </ul>
            </div>
        </section>
    </div><!-- FINAL CONTEUDO-PROG -->
    <a href="#" id="close4"><img src="img/fechar.jpg" alt="Fechar" width="12" height="15"></a>
</div>

<div class="programa" id="redehumor">
    <div class="top-prog">
        <img src="img/rededehumor1.png" alt="Rede de Humor" width="118" height="76" class="left" />

        <?php 
		//recupero os dados do servico, pelo id
			$servicos->setId(6);
			$servicos->geraDadosIdServico();
    	?>
        <ul class="detalhes">
            <li><span>Segmentação: </span> <?php echo $servicos->getSegmentacao();?></li>
            <li><span>Distribuição na grade: </span> <?php echo $servicos->getDistribuicaonagrade();?></li>
            <li><span>Indicação de horário: </span> <?php echo $servicos->getIndicacaodehorario();?></li>
            <li><span>Indicativo de intervalo: </span> <?php echo $servicos->getIndicativodeintervalo();?></li>
            <li><span>Execuções diárias: </span> <?php echo $servicos->getExecucoesdiarias();?></li>
            <li><span>Apresentação: </span> <?php echo $servicos->getApresentacao();?></li>
            <li><span>Tempo: </span> <?php echo $servicos->getTempo();?></li>
        </ul>
    </div><!-- FIANL TOP PROG -->

    <ul class="tabs6 menu-prog">
        <?php 
    		$servicos->setId(6);
    		$servicos->setItem(6);
			$servicos->getMenuProg();
    	?>
    </ul>

    <div class="conteudo-prog">
        <?php 
        	//monta a div tab_content
		    $servicos->setId(6);
		    $servicos->setItem(6);
		    $servicos->getMenuProg2();
	    ?>

        <section class="bottom-prog">
            <div class="logo-prog">
                <img src="img/rededehumor1.png" alt="Rede de Humor" width="118" height="76" class="left" />

                <h3><?php echo $servicos->getNome();?></h3>

                <p><?php echo nl2br($servicos->getDescricao());?></p>
            </div>

            <div class="midias-prog">
                <h3>Compartilhe</h3>

                <ul class="midias-prog-ul">
                    <!--<li><a href="https://twitter.com/grupotalkradio" rel="external" title="Twitter" class="bt-twitter hidetxt">Twitter</a></li>-->
                    <li><a href="https://www.facebook.com/redetalkradio" rel="external" title="Facebook" class="bt-face hidetxt">Facebook</a></li>
                </ul>
            </div>
        </section>
    </div><!-- FINAL CONTEUDO-PROG -->
    <a href="#" id="close5"><img src="img/fechar.jpg" alt="Fechar" width="12" height="15"></a>
</div>

<div class="programa" id="musical">
    <div class="top-prog">
        <img src="img/marcamusical1.png" alt="Marca Musical" width="118" height="89" class="left" />

        <?php 
		//recupero os dados do servico, pelo id
			$servicos->setId(7);
			$servicos->geraDadosIdServico();
    	?>
        <ul class="detalhes">
            <li><span>Segmentação: </span> <?php echo $servicos->getSegmentacao();?></li>
            <li><span>Distribuição na grade: </span> <?php echo $servicos->getDistribuicaonagrade();?></li>
            <li><span>Indicação de horário: </span> <?php echo $servicos->getIndicacaodehorario();?></li>
            <li><span>Indicativo de intervalo: </span> <?php echo $servicos->getIndicativodeintervalo();?></li>
            <li><span>Execuções diárias: </span> <?php echo $servicos->getExecucoesdiarias();?></li>
            <li><span>Apresentação: </span> <?php echo $servicos->getApresentacao();?></li>
            <li><span>Tempo: </span> <?php echo $servicos->getTempo();?></li>
        </ul>
    </div><!-- FIANL TOP PROG -->

    <ul class="tabs7 menu-prog">
        <?php 
    		$servicos->setId(7);
    		$servicos->setItem(7);
			$servicos->getMenuProg();
    	?>
    </ul>

    <div class="conteudo-prog">
        <div class="tab_content7" id="hits7">
            <div class="scroll-pane">
                <?php 
                    $servicos->setId(7);
                    $servicos->setHrefSubCategoria('hits');
                    $servicos->getMenuProgCategoria();
                ?>
            </div>
        </div>

        <div class="tab_content7" id="popdance7">
            <div class="scroll-pane">
                <?php 
                    $servicos->setId(7);
                    $servicos->setHrefSubCategoria('popdance');
                    $servicos->getMenuProgCategoria();
                ?>
            </div>
        </div>
        
        <div class="tab_content7" id="programetes7">
            <div class="scroll-pane">
                <?php 
                    $servicos->setId(7);
                    $servicos->setHrefSubCategoria('programetes');
                    $servicos->getMenuProgCategoria();
                ?>
            </div>
        </div>
        
        <div class="tab_content7" id="sertanejos7">
            <div class="scroll-pane">
                <?php 
                    $servicos->setId(7);
                    $servicos->setHrefSubCategoria('sertanejos');
                    $servicos->getMenuProgCategoria();
                ?>
            </div>
        </div>
        
        <div class="tab_content7" id="temas7">
            <div class="scroll-pane">
                <?php 
                    $servicos->setId(7);
                    $servicos->setHrefSubCategoria('temas');
                    $servicos->getMenuProgCategoria();
                ?>
             </div>
        </div>
        
        <div class="tab_content7" id="humor7">
            <div class="scroll-pane">
                <?php 
                    $servicos->setId(7);
                    $servicos->setHrefSubCategoria('humor');
                    $servicos->getMenuProgCategoria();
                ?>
             </div>
        </div>
        
        <div class="tab_content7" id="jornalismo7">
            <div class="scroll-pane">
                <?php 
                    $servicos->setId(7);
                    $servicos->setHrefSubCategoria('jornalismo');
                    $servicos->getMenuProgCategoria();
                ?>
             </div>
        </div>

        <section class="bottom-prog">
            <div class="logo-prog">
                <img src="img/marcamusical1.png" alt="Marca Musical" width="118" height="89" class="left" />

                <h3><?php echo $servicos->getNome();?></h3>

                <p><?php echo nl2br($servicos->getDescricao());?></p>
            </div>

            <div class="midias-prog">
                <h3>Compartilhe</h3>

                <ul class="midias-prog-ul">
                    <!--<li><a href="https://twitter.com/grupotalkradio" rel="external" title="Twitter" class="bt-twitter hidetxt">Twitter</a></li>-->
                    <li><a href="https://www.facebook.com/redetalkradio" rel="external" title="Facebook" class="bt-face hidetxt">Facebook</a></li>
                </ul>
            </div>
        </section>
    </div><!-- FINAL CONTEUDO-PROG -->
    <a href="#" id="close6"><img src="img/fechar.jpg" alt="Fechar" width="12" height="15"></a>
</div>

</div>
