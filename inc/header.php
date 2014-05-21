<header role="banner">
        <?php if ($url[0] == ""){ ?>
        <h1><a href="<?php echo URL;?>" title="Talk Radio - Programas de Radio" class="hidetxt">Talk Radio - Programas de Radio</a></h1>
		<?php }else{ ?>
        <p class="logo"><a href="<?php echo URL;?>" title="Talk Rádio - Soluções em Radiofusão"><img src="<?php echo URL;?>img/talkradio.png" alt="Talk Rádio - Soluções em Radiofusão" width="150" height="104" /></a></p>
        <?php } ?>

        <ul class="midias-topo">
            <li><a href="https://plus.google.com/117460492983009430994" title="Google +" class="bt-goo hidetxt" rel="external">Google+</a></li>

            <li class="esp-li"><a href="https://twitter.com/grupotalkradio" rel="external" title="Twitter" class="bt-twitter hidetxt">Twitter</a></li>

            <li><a href="https://www.facebook.com/redetalkradio" rel="external" title="Facebook" class="bt-face hidetxt">Facebook</a></li>
            
            <li><a href="<?php echo URL;?>blog" title="Blog TalkRadio" class="bt-blog hidetxt">Blog TalkRadio</a></li>
        </ul>

        <!--<p class="chat"><a href="#" title="Atendimento Online" class="hidetxt">Atendimento Online</a></p>-->
        <div id="lpButDivID-1372986881120" class="chat"></div>

        
        <nav role="navigation">
            <ul>
                <li><a href="<?php echo URL;?>" title="Home" class="bt-home <?php if($url[0] == ""){echo 'ativo1';} ?>">Home</a></li>

                <li><a href="<?php echo URL;?>quem-somos" title="Quem Somos" class="bt-quem <?php if($url[0] == "quem-somos"){echo 'ativo2';} ?>">Quem Somos</a></li>

                <li><a href="<?php echo URL;?>rede" title="Rede" class="bt-rede <?php if($url[0] == "rede"){echo 'ativo3';} ?>">Rede</a></li>

                <li><a href="<?php echo URL;?>programas" title="Programas" class="bt-serv <?php if($url[0] == "programas"){echo 'ativo6';} ?>">Programas</a></li>

                <li class="li-maior"><a href="<?php echo URL;?>depoimentos" title="Depoimentos" class="bt-depo <?php if($url[0] == "depoimentos"){echo 'ativo5';} ?>">Depoimentos</a></li>

                <li><a href="<?php echo URL;?>parceiros" title="Parceiros" class="bt-parc <?php if($url[0] == "parceiros"){echo 'ativo4';} ?>">Parceiros</a></li>

                <li><a href="<?php echo URL;?>noticias" title="Notícias" class="bt-noti <?php if($url[0] == "noticias" or $url == "noticia-detalhe"){echo 'ativo7';} ?>">Notícias</a></li>

                <li><a href="<?php echo URL;?>imprensa" title="Imprensa" class="bt-impr <?php if($url[0] == "imprensa" or $url == "imprensa-detalhe"){echo 'ativo8';} ?>">Imprensa</a></li>

                <li><a href="<?php echo URL;?>cadastro" title="Cadastro" class="bt-cada <?php if($url[0] == "cadastro"){echo 'ativo9';} ?>">Cadastro</a></li>
                
                <li class="sem-pdg-right"><a href="<?php echo URL;?>contato" title="Contato" class="bt-cont <?php if($url[0] == "contato"){echo 'ativo10';} ?>">Contato</a></li>
            </ul>
        </nav>
    </header><!-- FINAL HEADER -->