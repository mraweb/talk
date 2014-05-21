<?php
if(isset($_REQUEST['idAlteracao'])){
	$idAlteracao = $_REQUEST["idAlteracao"];
}else{
	$idAlteracao = "";
	$checkd = "checkd";
}



include_once("../classe/Imprensa.php");
include_once("../funcoes/define.php");
	$listagem = new Impresa();
	if($idAlteracao){
		$listagem->setId($idAlteracao);
		$listagem->geraDadosIdImprensa();
		
		if($listagem->getDestaque())
			$checkd = $listagem->getDestaque();
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
	<p>ADICIONAR NOVA REPORTAGEM</p>
    
    <form action="../classe/Imprensa.php" method="post" id="formNoticia" method="post" enctype="multipart/form-data">
        <ul class="form1">
            <li>
                <label for="data">Data:</label>
                <input name="dataEvento" type="text" id="data_1" class="mask-data" size="50" value="<?php if($idAlteracao){echo $listagem->getDataEvento();}else{ echo date('d/m/Y'); } ?>">
            </li>
            
            <li>
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" value="<?php echo $listagem->getTitulo();?>" />
            </li>
            
            <li>
                <label for="arquivo">Imagem:</label>
                <input type="file" name="arquivo" id="botao_enviar_arquivo" />
            </li>
            
            <li>
                <label for="arquivo">Galeria Fotos:</label>
                <input type="file" name="arquivo_galeria" id="botao_enviar_arquivo_galeria"  />
                <div id="loading"></div>
            </li>
            
            <li>
                <label for="descricao">Descrição:</label>
                <textarea cols="80" id="editor1" name="descricao" rows="10"><?php echo $listagem->getDescricao();?></textarea>
            </li>
            
            <li>
                <input type="image" src="img/btadicionar.jpg" name="Adicionar" class="bt-adicionar" />
                <input type="hidden" id="nomeArquivoTemp" name="nomeArquivoTemp" value="">
                <input name="idAlteracao" id="idAlteracao" type="hidden" value="<?php echo $idAlteracao;?>"/>
                <input name="getImagem" id="getImagem" type="hidden" value="<?php echo $listagem->getImagem();?>"/>
                <?php
				  if(!isset($_GET["acao"])){
			  		echo '<input type="hidden" name="cadastrar" id="cadastrar" value="cadastrar">';
				  }else{
			  		echo '<input type="hidden" name="alterar" id="alterar" value="alterar" />';
				  }
			  	?>
            </li>
        </ul>
    
	    <!-- fotos destaque -->
	    <div class="imagem-cadastrada">
	    	<span>
	    	<div id="conteudoImagemTemp"></div>   
	            <div id="excluirImagemTemp">
	                <div id="botaoExcluirTemp"></div>
	                <!-- <input type="radio" name="destaque-imagem" value="" class="left" /> -->
	            </div>
	        </span>
	    </div>
	    
	    <!-- galeria imagens -->
	    <ul class="galeria" id="galeria">
			<!-- imagens temp -->
			<?php 
			if($idAlteracao){
				$listagem->setId($idAlteracao);
				$listagem->geraImagensImprensa();
			}
			?>
	    </ul>
    </form>
</div>

<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );

	$(document).ready(function(){
		$('#excluirImagemTemp').hide();

		//carrega imagem no update
		var getImagem = $('#getImagem').val();
		if(getImagem){
			//$('#nomeArquivoTemp').val(getImagem);
	
		    var conteudo_imagem = '<img src="../upload/thumb/'+getImagem+'" />'; 
		    $('#conteudoImagemTemp').html(conteudo_imagem);
	
		    var idAlteracao = $('#idAlteracao').val(); 
		    var botaoExcluir = '<a href="javascript:void(0);" id="'+getImagem+'|'+idAlteracao+'" onclick="excluirImagemUpdate(this);" class="hidetxt bt-excluir left">Excluir</a>';
		    $('#excluirImagemTemp').html(botaoExcluir);
		    $('#excluirImagemTemp').show();
		}
		
	});

	function checkForm(){

		var titulo = $("#titulo").val();
		if (titulo == ""){
			alert("preencha o campo título");
			$('#titulo').focus(); 
			return (false);
		}

	return true;

	}

	$(".bt-adicionar").click(function() {
		if(checkForm()){
			$("#formNoticia").submit();
		}else{
			return false;
		}
		
	});

	$(function(){

		var tipoArquivo = "imagem";
		var acaoUpload = "imagem";

		//-------------------------------------------------------------------------
		new AjaxUpload($('#botao_enviar_arquivo'), //botao que var permitir o usuário escolher o arquivo
		    {
			action: '../funcoes/uploadMultiplos.php', //nome do script que vai tratar a requisição enviando o arquivo
			name: 'arquivo', //nome do campo de arquivo do form que vai ser enviado, no php vai o arquivo vai ser acessado como $_FILES['arquivo']
			//esta funcao do onSubmit é chamada antes do arquivo ser enviado então é possível fazer verificações e validações.
			onSubmit: function(arquivo, extensao){ //arquivo é o nome do arquivo e extensao sua extensao
					$('#conteudoImagemTemp').html("<img src='img/loading.gif' />");
					
					if (! (extensao && /^(jpg|jpeg)$/.test(extensao))){
					    //neste if acima estamos fazendo uma verificao para enviar somente imagens
					    //mas o ideal é fazer esta verificação no servidor também				    
	                    $('#conteudoImagemTemp').html('Somente imagens JPG podem ser enviadas.');
	                    return false; //se retornar false o upload nao é feito
					}

			},
			//esta funcao od onComplete é chamada depois que o upload é feito
			onComplete: function(arquivo, resposta){ //arquivo é o nome do arquivo enviado, resposta é a resposta do servidor

				//se reposta for igual a sucesso é só exibir a imagem usando o nome dela.
				if(resposta != "error" && resposta != "tamanho incorreto"){
					
					$('#nomeArquivoTemp').val(resposta);

				    var conteudo_imagem = '<img src="../uploadTemp/thumb/'+ resposta + '" />'; 
				    $('#conteudoImagemTemp').html(conteudo_imagem);

				    var d = new Date();
		 		    var n = d.getMilliseconds();
		 		    
				    var botaoExcluirTemp = '<a href="javascript:void(0);" id="'+resposta+'|'+n+'" onclick="excluirImagemTemp(this);" class="hidetxt bt-excluir left">Excluir</a>';
				    $('#excluirImagemTemp').html(botaoExcluirTemp);
				    $('#excluirImagemTemp').show();
				    
				}else if(resposta == "tamanho incorreto"){
					$('#conteudoImagemTemp').html('O tamanho do arquivo é inferior a altura de 172px e largura de 172px');
				} else{
					$('#conteudoImagemTemp').html('Erro ao enviar ' + arquivo);
				}
			},
			//usando este parametro data você pode enivar outros valores além do arquivo para o servidor
			//neste exemplo você acessaria estes valores no PHP usando o array global $_POST
			data: {
			    valor1 : tipoArquivo,
			    valor2 : acaoUpload,
			    tamanhoMax: 600,
			    tamanhoMin: 300
			}
		});

		//-------galeria de imagens----------------------------------------------------

		new AjaxUpload($('#botao_enviar_arquivo_galeria'), //botao que var permitir o usuário escolher o arquivo
			    {
				action: '../funcoes/uploadMultiplos.php', //nome do script que vai tratar a requisição enviando o arquivo
				name: 'arquivo_galeria', //nome do campo de arquivo do form que vai ser enviado, no php vai o arquivo vai ser acessado como $_FILES['arquivo']
				//esta funcao do onSubmit é chamada antes do arquivo ser enviado então é possível fazer verificações e validações.
				onSubmit: function(arquivo, extensao){ //arquivo é o nome do arquivo e extensao sua extensao

						$('#loading').html("<img src='img/loading.gif' />");
						
						if (! (extensao && /^(jpg|jpeg)$/.test(extensao))){
						    //neste if acima estamos fazendo uma verificao para enviar somente imagens
						    //mas o ideal é fazer esta verificação no servidor também				    
		                    $('#loading').html("");
		                    alert('Somente imagens JPG podem ser enviadas.');
		                    return false; //se retornar false o upload nao é feito
						}
					
				},
				//esta funcao od onComplete é chamada depois que o upload é feito
				onComplete: function(arquivo, resposta){ //arquivo é o nome do arquivo enviado, resposta é a resposta do servidor

					//se reposta for igual a sucesso é só exibir a imagem usando o nome dela.
					if(resposta != "error" && resposta != "tamanho incorreto"){

					    var conteudo_imagem = '<img src="../uploadTemp/thumb/'+ resposta + '" />'; 
					    
					    var d = new Date();
			 		    var n = d.getMilliseconds();
			 		    
					    $("#galeria").append('<li id="li_'+n+'"><img src="../uploadTemp/thumb/'+resposta+'" width="55" height="50" /><a href="javascript:void(0);"><img src="img/btexcluir.png" width="55" height="17" id="'+resposta+'|'+n+'" onclick="excluirImagemTempGaleria(this);"></a><input type="hidden" name="nomeImagemTemp[]" value="'+resposta+'"></li>');

					    $('#loading').html("");
					}else if(resposta == "tamanho incorreto"){
						alert('O tamanho do arquivo é inferior a altura de 172px e largura de 172px');
					} else{
						alert('Erro ao enviar ' + arquivo);
					}
				},
				//usando este parametro data você pode enivar outros valores além do arquivo para o servidor
				//neste exemplo você acessaria estes valores no PHP usando o array global $_POST
				data: {
				    valor1 : "imagem",
				    valor2 : "imagem",
				    tamanhoMax: 600,
				    tamanhoMin: 106
				}
			});

	});

	function excluirImagemTemp(e){

		if (confirm("Tem certeza que deseja excluir o registo?")) {  

			// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
			var conteudo = e.getAttribute("id");
			var parte = conteudo.split("|");
			var file = parte[0];
			var id = parte[1];
			var acao = "excluirImagemTemp";

			// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
			$.post('../classe/Imprensa.php', {
				arquivoTemp: file,
				acao: acao
				}, function(resposta) { 
					$('#conteudoImagemTemp').html("");
					$('#excluirImagemTemp').html("");
			}); 
	
		}

	}

	function excluirImagemUpdate(e){

		if (confirm("Tem certeza que deseja excluir o registo?")) {  

			// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
			var conteudo = e.getAttribute("id");
			var parte = conteudo.split("|");
			var file = parte[0];
			var id = parte[1];
			var acao = "excluirImagemUpdate";

			// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
			$.post('../classe/Imprensa.php', {
				arquivoTemp: file,
				acao: acao
				}, function(resposta) { 
					$('#conteudoImagemTemp').html("");
					$('#excluirImagemTemp').html("");
			}); 
	
		}

	} 

	function excluirImagemTempGaleria(e){

		if (confirm("Tem certeza que deseja excluir o registo?")) {  

			// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
			var conteudo = e.getAttribute("id");
			var parte = conteudo.split("|");
			var file = parte[0];
			var id = parte[1];
			var acao = "excluirImagemTemp";

			// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
			$.post('../classe/Imprensa.php', {
				arquivoTemp: file,
				acao: acao
				}, function(resposta) { 
					$('#li_'+id).hide();
			}); 
	
		}

	}

	$(".excluirImagemGaleria").click(function () {
		var idItemExclusao = $(this).attr('id');
		var idAlteracao = $('#idAlteracao').val();
		var acao = "excluirImagemGaleria";
		if (confirm("Deseja realmente excluir este registro?")){

			// Fazemos a requisão ajax com o arquivo php e enviamos os valores de cada campo através do método POST
			$.post('../classe/Imprensa.php', {
				idImagem: idItemExclusao,
				acao: acao 
				}, function(resposta) {
					$('#li_'+idItemExclusao).hide();				
			}); 
		}else{
			return false;  
		}
    });
</script>