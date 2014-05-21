<?php
include_once("../funcoes/define.php");
include_once("../classe/ComboBox.php");
$comboBox = new ComboBox();

if(isset($_REQUEST['idAlteracao'])){
	$idAlteracao = $_REQUEST["idAlteracao"];
}else{
	$idAlteracao = "";
}

include_once("../classe/Cliente.php");
	$listagem = new Cliente();
	if($idAlteracao){
		$listagem->setId($idAlteracao);
		$listagem->geraDadosIdCliente();
	}

if(isset($_REQUEST['msn'])){
	$msn = $_REQUEST["msn"];
	echo'
	<script type="text/javascript">
		alert("'.base64_decode($msn).'");
	</script>
	';
}
?>
<div class="content">
	<p>ATUALIZAR CADASTRO</p>
    
    <form action="../classe/Cliente.php" method="post" enctype="multipart/form-data" id="form">
        <ul class="form1">
        	<li>
                <label for="email">E-mail:</label>
                <input type="text" name="mailcadastro" id="mailcadastro" class="" value="<?php echo $listagem->getEmail();?>"/>
            </li>

        	<li>
                <label for="nome">Nome:</label>
                <input type="text" name="nomecadastro" id="nomecadastro" class="" value="<?php echo $listagem->getNome();?>" />
            </li>

            <li>
                <label for="radio">Rádio:</label>
                <input type="text" name="radiocadastro" id="radiocadastro" class="" value="<?php echo $listagem->getRadio();?>" />
            </li>

            <li>
                <label for="cidade">Cidade:</label>
                <input type="text" name="cidade" id="cidade" class="" value="<?php echo $listagem->getCidade();?>" />
            </li>

            <li>
            	<label for="cidade">Estado:</label>
                <select name="estado" id="estado" class="validate[required]">
                	<option value="">Selecione</option>
                    <?php 
	                	$comboBox->setPaisId(50);
	                	$comboBox->setEstadoId($listagem->getEstadoId());
	                	$comboBox->estados();
	                ?>
                </select>
            </li>

            <li>
                <label for="telefone">Telefone:</label>
                <input type="text" name="telcadastro" id="telcadastro" class="" value="<?php echo $listagem->getTelefone();?>" />
            </li>

            <li>
                <label for="obs">Observação:</label>
                <textarea name="obs" id="obs"><?php echo $listagem->getObs();?></textarea>
            </li>
            
            <li>
                <input type="image" src="img/btadicionar.jpg" name="Adicionar" class="bt-adicionar" id="alinha" />
                <input name="idAlteracao" id="idAlteracao" type="hidden" value="<?php echo $idAlteracao;?>"/>
                <?php
				  if(!isset($_GET["acao"])){
			  		echo '<input type="hidden" name="cadastrar" id="cadastrar" value="cadastrar">';
				  }else{
			  		echo '<input type="hidden" name="alterar" id="alterar" value="alterar" />';
				  }
			  	?>
            </li>
        </ul>
    </form>
</div>
<script type="text/javascript">

	function checkForm(){

		var email = $("#mailcadastro").val();
		if (email == ""){
			alert("e-mail não pode estar em branco");
			$('#mailcadastro').focus(); 
			return (false);
		}
		if (email != ""){
			var value = $("#mailcadastro").val();		
			er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
	  		if(!er.exec(value)) {
	  			alert("e-mail informado esta incorreto");
				$('#mailcadastro').focus();
				return false;
			}
		}

		var nome = $("#nomecadastro").val();
		if (nome == ""){
			alert("preencha o nome");
			$('#nomecadastro').focus(); 
			return (false);
		}

	return true;

	}

	$(".bt-adicionar").click(function() {
		if(checkForm()){
			$("#form").submit();
		}else{
			return false;
		}		
	});



</script>