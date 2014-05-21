<?php
if(isset($_REQUEST['id'])){
	$idAlteracao = $_REQUEST["id"];
}else{
	$idAlteracao = "";
}


include_once("../funcoes/define.php");
include_once("../classe/Servico.php");
include_once("../classe/ComboBox.php");


$listagem = new Servico();
if($idAlteracao){
	$listagem->setId($idAlteracao);
	$listagem->geraDadosIdServico();
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
	<form action="../classe/Servico.php" method="post" enctype="multipart/form-data" id="form">
	
	<?php 
		if(!$_REQUEST['id']){
			echo '<p>Adicionar novo serviço sem áudio:</p>';
		}else{
			echo '<p>Serviço sem áudio: '.$listagem->getNome().'</p>';
		}
	?>

        <ul class="form1">

            <li>
                <label for="data">Status:</label>
                <select name="status" id="status">
                    <option value="A" <?php if($listagem->getStatus()=="A"){ echo 'selected="selected"';}?>>Ativo</option>
                    <option value="I" <?php if($listagem->getStatus()=="I"){ echo 'selected="selected"';}?>>Inativo</option>
                </select>
            </li>
            
            <li>
                <label for="nome">* Título:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $listagem->getNome();?>"/>
            </li>

            <li>
                <label for="descricao">Descrição da página serviços:</label>
                <textarea name="descricao" id="descricao" maxlength='100'><?php echo $listagem->getDescricao();?></textarea>
                <br /><span id="chars">100</span> limite de caracter.
            </li>
            
            <li>
                <label for="arquivo">Imagem:</label>
                <input type="file" name="arquivo" id="arquivo" />
            </li>

            <li>
                <label for="video">Vídeo (URL):</label>
                <input type="text" name="video" id="video" value="<?php echo $listagem->getVideo();?>"/>
            </li>

        </ul>
        
        <?php 
	    if($listagem->getLogo()){
	    	$caminhoImagem = URL.'upload/arquivos/'.$listagem->getLogo();
	    ?>
	    <div class="imagem-cadastrada">
	    	<span>
	        	<img src="<?php echo $caminhoImagem;?>" width="196" height="86" />
	            <div>
	                <a href="javascript:void(0);" class="hidetxt bt-excluir-logo left">Excluir</a>
	            </div>
	        </span>
	    </div>
	    <?php 
	    }
	    ?>

        <ul class="editor">            
            <li>
                <label for="descricao">Descrição:</label>

            	<textarea cols="80" id="editor1" name="descricaointerna" rows="10"><?php echo $listagem->getDescricaoInterna();?></textarea>		
            </li>

        </ul>

            <ul class="form1">
                <li>
                    <input type="hidden" name="audio" value="SEM" />
                    <input type="image" src="img/btpublicar.jpg" name="Publicar" class="bt-adicionar" />
                    
                    <?php 
                    	if(!$_REQUEST['id']){
                    		echo '<input type="hidden" name="acao" value="addServico" />';
                    	}else{
                    		echo '<input type="hidden" name="audio" value="SEM" />';
                    		echo '<input type="hidden" name="arquivo_anterior" value="'.$listagem->getLogo().'" />';
                    		echo '<input type="hidden" name="acao" value="editServico" />';
                    		echo '<input name="idAlteracao" id="idAlteracao" type="hidden" value="'.$_REQUEST['id'].'"/>';
                    	}
                    ?>
                    
                </li>
            </ul>

</form>
</div>

<script type="text/javascript" src="js/jquery-1.7.min.js"></script>

<script type="text/javascript">//<![CDATA[
      CKEDITOR.replace('editor1',{
        filebrowserBrowseUrl : '/ckeditor/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        }
    );
//]]></script>

<script type="text/javascript">

    //validar form--------------------------------------------------------------
    function checkForm(){

		var nome = $("#nome").val();
		if (nome == ""){
			alert("preencha o campo nome");
			$('#nome').focus(); 
			return (false);
		}

		return true;

	}
	
    $("#form").submit( function () {
    	if(checkForm()){
			$("#form").submit();
		}else{
			return false;
		}
	});
    //limit de caracter---------------------------------------------------------
    (function($) {
        $.fn.extend( {
            limiter: function(limit, elem) {
                $(this).on("keyup focus", function() {
                    setCount(this, elem);
                });
                function setCount(src, elem) {
                    var chars = src.value.length;
                    if (chars > limit) {
                        src.value = src.value.substr(0, limit);
                        chars = limit;
                    }
                    elem.html( limit - chars );
                }
                setCount($(this)[0], elem);
            }
        });
    })(jQuery);

    var elem = $("#chars");
    $("#descricao").limiter(100, elem);

    //excluir logo ---------------------------------------------------------------
    $(".bt-excluir-logo").click(function() {

		if (confirm("Tem certeza que deseja excluir a imagem?")) {  

			// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
			var id = $('#idAlteracao').val();
			var acao = "excluir-logo";

			// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
			$.post('../classe/Servico.php', {
				idImagem: id,
				acao: acao
				}, function(resposta) { 
					$('.imagem-cadastrada').hide();
				}); 
		}

	});
</script>
