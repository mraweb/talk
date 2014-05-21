<?php
include_once("../classe/Noticia.php");
include_once("../funcoes/define.php");
$listagem = new Noticia();
	
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
	<p>ADICIONAR BANNERS NA NOTÍCIA</p>
    
    <form action="../classe/Noticia.php" method="post" id="formNoticia" method="post" enctype="multipart/form-data">
        <ul class="form1">

            
            <li>
                <label for="arquivo">Imagens:</label>
                <input type="file" name="arquivo_galeria" id="botao_enviar_arquivo_galeria"  />
                <div id="loading"></div>
            </li>
            
           
            
            <li>
                <input type="image" src="img/btadicionar.jpg" name="Adicionar" class="bt-adicionar" />
                <input type="hidden" id="nomeArquivoTemp" name="nomeArquivoTemp" value="">
                <input name="idAlteracao" id="idAlteracao" type="hidden" value="<?php echo $idAlteracao;?>"/>
                <input name="getImagem" id="getImagem" type="hidden" value="<?php echo $listagem->getImagem();?>"/>
                <?php
				  
			  		echo '<input type="hidden" name="banners" id="banners" value="banners" />';
				  
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
			$banners = $listagem->geraDadosBannerNoticia();
			foreach ($banners as $banner) {
				$id = $banner['id'];
				$imagem = $banner['imagem'];
				$link = $banner['link'];
								
				echo'
				  	<li id="li_'.$id.'"><img src="'.$imagem.'" width="100" height="100" /><br /><input type="text" name="banner_link['.$id.'][link]" placeholder="link" value="'.$link.'"><input type="hidden" name="banner_link['.$id.'][id]" value="'.$id.'"><a href="javascript:void(0);" id="'.$id.'" class="excluirImagemGaleria"><img src="img/btexcluir.png" width="55" height="17" ></a></li>
				';
			}
			?>
			
	    </ul>
    </form>
</div>

<script type="text/javascript">
	

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
			 		    
					    $("#galeria").append('<li id="li_'+n+'"><img src="../uploadTemp/thumb/'+resposta+'" width="100" height="100" /><br /><input type="text" name="banner['+n+'][link]" placeholder="link" value=""><a href="javascript:void(0);"><img src="img/btexcluir.png" width="55" height="17" id="'+resposta+'|'+n+'" onclick="excluirImagemTempGaleria(this);"></a><input type="hidden" name="banner['+n+'][img]" value="'+resposta+'"></li>');

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
				    tamanhoMax: 290,
				    tamanhoMin: 325
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
			$.post('../classe/Noticia.php', {
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
			$.post('../classe/Noticia.php', {
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