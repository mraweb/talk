<?php 
if(isset($_REQUEST['telas']))
	$telas = $_REQUEST['telas'];
else
	$telas = "";
?>
<header>
	<div class="topo">
        <div class="logo">
            <img src="img/logo-admin.jpg" class="img-left" />
            
            <p><?php echo $_SESSION["nomeAdministrador"];?></p>
            
            <a href="../classe/Login.php?txtLocal=logOff" title="Sair" class="hidetxt btsair">Sair</a>
        </div>
        
        <ul id="navMenu">
        	<li>
            	<a href="javascript:void(0);" title="Usuários" <?php if($telas=='novo-usuario' || $telas=='lista-de-usuarios'){ echo'class="ativo"';}?>>Usuários</a>
                <ul class="sub-nav">
                	<li><a href="?telas=novo-usuario">Novo Usuário</a></li>
                    <li><a href="?telas=lista-de-usuarios">Lista de Usuários</a></li>
                </ul>
           	</li>
            
        	<li>
            	<a href="javascript:void(0);" title="Equipe" <?php if($telas=='novo-colaborador' || $telas=='lista-de-colaboradores'){ echo'class="ativo"';}?>>Equipe</a>
                <ul class="sub-nav">
                	<li><a href="?telas=novo-colaborador">Novo colaborador</a></li>
                    <li><a href="?telas=lista-de-colaboradores">Lista de Colaboradores</a></li>
                </ul>
           	</li>
<!--  
            <li>
                <a href="javascript:void(0);" title="Rede">Rede</a>
                <ul class="sub-nav">
                    <li><a href="novo-colaborador.php">Novo colaborador</a></li>
                    <li><a href="lista-de-colaboradores.php">Lista de Colaboradores</a></li>
                </ul>
            </li>
-->
            <li>
                <a href="javascript:void(0);" title="Parceiros" <?php if($telas=='novo-parceiro' || $telas=='lista-de-parceiros'){ echo'class="ativo"';}?>>Parceiros</a>
                <ul class="sub-nav">
                    <li><a href="?telas=novo-parceiro">Novo Parceiro</a></li>
                    <li><a href="?telas=lista-de-parceiros">Lista de Parceiros</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" title="Depoimentos" <?php if($telas=='novo-depoimento' || $telas=='lista-de-depoimentos'){ echo'class="ativo"';}?>>Depoimentos</a>
                <ul class="sub-nav">
                    <li><a href="?telas=novo-depoimento">Novo Depoimento</a></li>
                    <li><a href="?telas=lista-de-depoimentos">Lista de Depoimentos</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" title="Serviços">Serviços</a>
                <ul class="sub-nav">
                    <li><a href="novo-evento.php">Novo serviços</a></li>
                    <li><a href="lista-de-evento.php">Lista de serviços</a></li>
                </ul>
            </li>
            
            <li>
            	<a href="javascript:void(0);" title="Notícias" <?php if($telas=='nova-noticia' || $telas=='lista-de-noticias'){ echo'class="ativo"';}?>>Notícias</a>
                <ul class="sub-nav">
                	<li><a href="?telas=nova-noticia">Nova Notícia</a></li>
                    <li><a href="?telas=lista-de-noticias">Lista de Notícias</a></li>
                </ul>
           	</li>

            <li>
                <a href="javascript:void(0);" title="Imprensa" <?php if($telas=='nova-reportagem' || $telas=='lista-de-reportagens'){ echo'class="ativo"';}?>>Imprensa</a>
                <ul class="sub-nav">
                    <li><a href="?telas=nova-reportagem">Nova Reportagens</a></li>
                    <li><a href="?telas=lista-de-reportagens">Lista de Reportagens</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" title="Cadastro" <?php if($telas=='nova-empresa' || $telas=='lista-de-empresas'){ echo'class="ativo"';}?>>Cadastro</a>
                <ul class="sub-nav">
                    <li><a href="?telas=nova-empresa">Nova Rádio</a></li>
                    <li><a href="?telas=lista-de-empresas">Rádios Cadastradas</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>