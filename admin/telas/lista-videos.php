<?php
include_once("../funcoes/define.php");
if(isset($_REQUEST['idAlteracao'])){
	$idAlteracao = $_REQUEST["idAlteracao"];
}else{
	$idAlteracao = "";
}

include_once("../classe/VideoHome.php");
	$listagem = new VideoHome();
	if($idAlteracao){
		$listagem->setId($idAlteracao);
		$listagem->geraDadosIdVideoHome();
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
	<p>LISTA DE VÍDEOS</p>
    
    <form action="../classe/VideoHome.php" method="post" id="form">
        <ul class="form1">
        	<li>
                <label for="video">Nome do Vídeo:</label>
                <input type="text" name="nome_video" id="nome_video" class="checkDados" value="" />
            </li>
            
            <li>
                <label for="video">URL do Vídeo:</label>
                <input type="text" name="url" id="url" class="checkDados" value="" />
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

    <div class="lista-video">
    	<?php 
    		$listagem->getListAllVideosHomeAdmin();
    	?>
   	</div>
</div>
<script type="text/javascript">

	function checkForm(){

		var nome = $("#nome_video").val();
		if (nome == ""){
			alert("preencha o nome");
			$('#nome_video').focus(); 
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

	$(".excluirVideo").click(function() {

		if (confirm("Tem certeza que deseja excluir a imagem?")) {  

			// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
			var id = $(this).attr("id");
			var acao = "excluirArquivo";

			// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
			$.post('../classe/VideoHome.php', {
				idImagem: id,
				acao: acao
				}, function(resposta) { 
					$('#close_'+id).hide();
				}); 
		}

	});

	$(".destaqueVideo").click(function() {

		if (confirm("Tem certeza que deseja dar destaque ao vídeo?")) {  

			// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
			var id = $(this).attr("id");
			var acao = "destaqueVideo";

			// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
			$.post('../classe/VideoHome.php', {
				id: id,
				acao: acao
				}, function(resposta) { 
					
				}); 
		}

	});

</script>