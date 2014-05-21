<?php
include_once("../funcoes/define.php");
if(isset($_REQUEST['idAlteracao'])){
	$idAlteracao = $_REQUEST["idAlteracao"];
}else{
	$idAlteracao = "";
}

include_once("../classe/Depoimento.php");
	$listagem = new Depoimento();
	if($idAlteracao){
		$listagem->setId($idAlteracao);
		$listagem->geraDadosIdDepoimento();
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
	<p>ADICIONAR NOVO DEPOIMENTO</p>
    
    <form action="../classe/Depoimento.php" method="post" enctype="multipart/form-data" id="form">
        <ul class="form1">
        	<li>
                <label for="nome">Título:</label>
                <input type="text" name="titulo" id="titulo" class="" value="<?php echo $listagem->getTitulo();?>" />
            </li>
            
            <li>
                <label for="email">Tempo Parceria:</label>
                <input type="text" name="tempo_parceria" id="tempo_parceria" class="" value="<?php echo $listagem->getTempoParceria();?>"/>
            </li>

            <li>
                <label for="arquivo">Logo:</label>
                <input type="file" name="arquivo" id="arquivo" />
            </li>

            <li>
                <label for="descricao">Descrição:</label>
                <textarea cols="80" id="editor1" name="descricao" rows="10"><?php echo $listagem->getDescricao();?></textarea>
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
    <?php 
    if($listagem->getImagem()){
    	$caminhoImagem = URL.'upload/arquivos/'.$listagem->getImagem();
    ?>
    <div class="imagem-cadastrada">
    	<span>
        	<img src="<?php echo $caminhoImagem;?>" width="200" height="123" />
            <div>
                <a href="javascript:void(0);" class="hidetxt bt-excluir left">Excluir</a>
            </div>
        </span>
    </div>
    <?php 
    }
    ?>
</div>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );

	function checkForm(){

		var titulo = $("#titulo").val();
		if (titulo == ""){
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
			var id = $('#idAlteracao').val();
			var acao = "excluirArquivo";

			// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
			$.post('../classe/Depoimento.php', {
				idImagem: id,
				acao: acao
				}, function(resposta) { 
					$('.imagem-cadastrada').hide();
				}); 
		}

	});
</script>