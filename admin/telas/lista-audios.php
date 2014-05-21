<?php
include_once("../funcoes/define.php");
if(isset($_REQUEST['idAlteracao'])){
	$idAlteracao = $_REQUEST["idAlteracao"];
}else{
	$idAlteracao = "";
}

include_once("../classe/AudioHome.php");
	$listagem = new AudioHome();
	if($idAlteracao){
		$listagem->setId($idAlteracao);
		$listagem->geraDadosIdAudio();
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
	<p>ADICIONAR NOVO AÚDIO</p>
    
    <form action="../classe/AudioHome.php" method="post" id="form">
        <ul class="form1">
        	<li>
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" class="" value="" />
            </li>

        	<li>
                <label for="audio">URL do Aúdio:</label>
                <input type="text" name="audio" id="audio" class="" value="" />
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

    <div class="video-cadastrado">
    	<?php $listagem->getListAllVideosHomeAdmin();?>
    </div>
</div>
<script type="text/javascript">

	function checkForm(){

		var nome = $("#titulo").val();
		if (nome == ""){
			alert("preencha o título");
			$('#titulo').focus(); 
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

	$(".bt-excluir").click(function() {

		if (confirm("Tem certeza que deseja excluir a imagem?")) {  

			// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
			var id = $(this).attr("id");
			var acao = "excluirArquivo";

			// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
			$.post('../classe/AudioHome.php', {
				idAudio: id,
				acao: acao
				}, function(resposta) { 
					$('#remove_'+id).hide();
				}); 
		}

	});
</script>