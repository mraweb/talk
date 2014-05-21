<?php
if(isset($_REQUEST['idAlteracao'])){
	$idAlteracao = $_REQUEST["idAlteracao"];
}else{
	$idAlteracao = "";
	$checkd = "checkd";
}

include_once("../classe/Noticia.php");
$listagem = new Noticia();
if($idAlteracao){
	$listagem->setId($idAlteracao);
	$listagem->geraDadosIdNoticia();
	
	if($listagem->getDestaque())
		$checkd = $listagem->getDestaque();
}

if(isset($_REQUEST['msn'])){
	$msn = $_REQUEST["msn"];
	// echo'
	// <script type="text/javascript">
	// 	alert("'.base64_decode($msn).'");
	// </script>
	// ';
}
?>
<div class="content">
	<p>ADICIONAR NOVA NOTÍCIA</p>
    
    <form action="../classe/Noticia.php" method="post" id="formNoticia" method="post" enctype="multipart/form-data">
        <ul class="form1">
            
            <input type="hidden" name="arquivo" id="botao_enviar_arquivo" />
            <li>
                <label for="texto-banner">Banners:</label>
                <input type="file" name="arquivo" id="add-banner" />
                <div id='aviso-banners'>No máximo 7 banners</div>
            </li>
            
            <li>
                <input type="image" src="img/btadicionar.jpg" name="Adicionar" class="bt-adicionar" />
                <input type="hidden" id="nomeArquivoTemp" name="nomeArquivoTemp" value="">
                <span id='banner-imgs'>
                	<?php foreach($listagem->geraDadosBannerNoticia() as $banner):?>
					<input type='hidden' class="input-banner link-atual" name='banner_link[<?php echo $banner['id']?>]' value='<?php echo $banner['link']?>' >
                	<?php endforeach?>
                </span>
                <input name="idAlteracao" id="idAlteracao" type="hidden" value="<?php echo $idAlteracao;?>"/>
                <input name="getImagem" id="getImagem" type="hidden" value="<?php echo $listagem->getImagem();?>"/>
                <?php
				  echo '<input type="hidden" name="banners" id="banners" value="banners" />';
			  	?>
            </li>
        </ul>
    </form>
    <div class="imagem-cadastrada noticia">
    	<span>
    		<img src="img/loading.gif" class='loading-gif img-principal'>
    		<div id="conteudoImagemTemp">
    		</div>   
            <div id="excluirImagemTemp">
                <div id="botaoExcluirTemp"></div>
            </div>
        </span>
    </div>
    <div class="banners-cadastrados ">
		<div class="thumbs">
    	<?php foreach($listagem->geraDadosBannerNoticia() as $banner){
    		?>
    		<div class="thumb-container">
    		<img src="<?php echo $banner['imagem']?>" />
    		<input type='text' class='thumb-input' placeholder='link' value='<?php echo $banner['link']?>' data-id='<?php echo $banner['id']?>'>
    		<span class="excluir-banner" id="<?php echo $banner['imagem'].'|'.$banner['id']?>">EXCLUIR</span>
    		</div>
    		<?php 
    	}?>
		</div>
    </div>
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

		var ajaxUploadOptions =  {
				accept:'image/*',
				action: '../funcoes/uploadMultiplos.php', //nome do script que vai tratar a requisição enviando o arquivo
				name: 'arquivo', //nome do campo de arquivo do form que vai ser enviado, no php vai o arquivo vai ser acessado como $_FILES['arquivo']
				//esta funcao do onSubmit é chamada antes do arquivo ser enviado então é possível fazer verificações e validações.
				onSubmit: function(arquivo, extensao){ //arquivo é o nome do arquivo e extensao sua extensao
						$('.loading-gif.img-principal').show();
						
						if (! (extensao && /^(jpg|jpeg)$/.test(extensao))){
						    //neste if acima estamos fazendo uma verificao para enviar somente imagens
						    //mas o ideal é fazer esta verificação no servidor também				    
		                    $('.loading-gif.img-principal').hide();
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
					$('.loading-gif.img-principal').hide();
				},
				//usando este parametro data você pode enivar outros valores além do arquivo para o servidor
				//neste exemplo você acessaria estes valores no PHP usando o array global $_POST
				data: {
				    valor1 : tipoArquivo,
				    valor2 : acaoUpload,
				    tamanhoMax: 400,
				    tamanhoMin: 200
				}
			};

		var ajaxUpload = function(el, options){
			new AjaxUpload(el, options);
		}

		ajaxUpload($('#botao_enviar_arquivo'),ajaxUploadOptions);

		// banners
		var $bannerContainer = $('.banners-container');
		var totalBanners = $('.thumb-container').length;
		var bannerOptions = ajaxUploadOptions;

		bannerOptions.onSubmit = function(arquivo, resposta){
			return !(totalBanners>=999);
		}

		bannerOptions.onComplete = function(arquivo, resposta){

			if(resposta != "error" && resposta != "tamanho incorreto"){

				var div = $("<div class='thumb-container' />");
				var img = $("<img src='../uploadTemp/thumb/"+ resposta + "' />");
				var link = $("<input type='text' class='thumb-input' placeholder='link'/>");
				var button = $('<span class="excluir-banner" data-tipo="temp" id="'+resposta+'">EXCLUIR</span>');

				div.append(img,link,button);

				$('.thumbs').append(div);
				$('.banners-cadastrados').show();

				$('#banner-imgs').append('<input type="hidden" class="input-banner img" value="'+resposta+'"><input type="hidden" class="input-banner link">');

				totalBanners++;
			}

			ordenarInputs();
			$('.loading-gif.img-principal').hide();

		}

		$(document).on('keyup','.thumb-input',function(){
			var index = $(this).parent('.thumb-container').index();
			var value = $(this).val();
			$('.input-banner.link').eq(index).val(value);
			$('.input-banner.link-atual').eq(index).val(value); // atualiza o links de banners já existentes
		});

		bannerOptions.data.tamanhoMax = 290;
		bannerOptions.data.tamanhoMin = 325;

		var ordenarInputs = function(){ // ordena os inputs tipo 'hidden' das imagens dos banners
			var totalInputs = $('.input-banner').length;

			for(var i = 0;i<totalInputs;i++){
				$('.input-banner.img').eq(i).attr('name','banner['+i+'][img]');
				$('.input-banner.link').eq(i).attr('name','banner['+i+'][link]');
			}

		}

		$('.banners-cadastrados').on('click','.excluir-banner',function(){

			var container = $(this).parents('.thumb-container');
			var index = container.index();

			if($(this).attr('data-tipo') == 'temp')
				excluirImagemTemp(this);
			else
				excluirImagemBanner(this);

			$('input[name^="banner['+index+']"]').remove();
			$(this).parents('.thumb-container').remove();
			ordenarInputs();
			totalBanners--;

			if(totalBanners==0)
				$('.banners-cadastrados').hide();

		});

		ajaxUpload($('#add-banner'),bannerOptions);
		// end banners

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
			$.post('../classe/Noticia.php', {
				arquivoTemp: file,
				acao: acao
				}, function(resposta) { 
					$('#conteudoImagemTemp').html("");
					$('#excluirImagemTemp').html("");
			}); 
	
		}

	}

	function excluirImagemBanner(e){

		if (confirm("Tem certeza que deseja excluir o registo?")) {  

			var conteudo = e.getAttribute("id");
			var parte = conteudo.split("|");
			var file = parte[0];
			var id = parte[1];
			var acao = "excluirImagemBanner";

			$.post('../classe/Noticia.php', 
			{
				arquivo: file,
				acao: acao,
				idBanner: id
			}, function(resposta) {


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
			$.post('../classe/Noticia.php', {
				arquivoTemp: file,
				acao: acao
				}, function(resposta) { 
					$('#conteudoImagemTemp').html("");
					$('#excluirImagemTemp').html("");
			}); 
	
		}

	} 
</script>
