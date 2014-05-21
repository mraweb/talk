<?php
include_once("../funcoes/define.php");
if(isset($_REQUEST['idAlteracao'])){
	$idAlteracao = $_REQUEST["idAlteracao"];
}else{
	$idAlteracao = "";
}

include_once("../classe/CategoriaServico.php");
	$listagem = new CategoriaServico();
	if($idAlteracao){
		$listagem->setId($idAlteracao);
		$listagem->geraDadosIdCategoriaServico();
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
	<p>ADICIONAR NOVA CATEGORIA SERVIÇO</p>
    
    <form action="../classe/CategoriaServico.php" method="post" enctype="multipart/form-data" id="form">
        <ul class="form1">
        	<li>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="checkDados" value="<?php echo $listagem->getNome();?>" />
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

		var nome = $("#nome").val();
		if (nome == ""){
			alert("preencha o nome");
			$('#nome').focus(); 
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