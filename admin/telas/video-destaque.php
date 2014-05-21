<?php
include_once("../funcoes/define.php");
if(isset($_REQUEST['idAlteracao'])){
	$idAlteracao = $_REQUEST["idAlteracao"];
}else{
	$idAlteracao = "";
}

include_once("../classe/Parceiro.php");
	$listagem = new Parceiro();
	if($idAlteracao){
		$listagem->setId($idAlteracao);
		$listagem->geraDadosIdParceiro();
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
	<p>ADICIONAR NOVO VÍDEO DESTAQUE</p>
    
    <form action="../classe/Parceiro.php" method="post" id="form">
        <ul class="form1">
        	<li>
                <label for="nome">URL do Vídeo:</label>
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

    <div class="video-cadastrado">
    	<iframe width="400" height="225" src="//www.youtube.com/embed/qK4nDgJvkmk"></iframe>
    </div>
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

	$(".checkDados").change(function() {
		var name = $(this).attr('name');
		var value = $('#'+name).val();

		var idCheck = null;
		if($('#idAlteracao').val() > 0)
			idCheck = $('#idAlteracao').val();
		
		var acao = "checkDados";
		
		$.post('../classe/Parceiro.php', {acao: acao, name: name, value: value, idCheck: idCheck}, function(resposta) {
			if(resposta == 1){
				alert(name+" com "+value+" já existe! Infome outro");
				$('#'+name).focus();
			}
		});
		
	});



	$(".bt-excluir").click(function() {

		if (confirm("Tem certeza que deseja excluir a imagem?")) {  

			// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
			var id = $('#idAlteracao').val();
			var acao = "excluirArquivo";

			// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
			$.post('../classe/Parceiro.php', {
				idImagem: id,
				acao: acao
				}, function(resposta) { 
					$('.imagem-cadastrada').hide();
				}); 
		}

	});
</script>