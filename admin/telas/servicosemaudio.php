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
	
	<p><?php echo $listagem->getNome();?></p>

        <ul class="form1">

            <li>
                <label for="data">Status:</label>
                <select name="status" id="status">
                    <option value="A" <?php if($listagem->getStatus()=="A"){ echo 'selected="selected"';}?>>Ativo</option>
                    <option value="I" <?php if($listagem->getStatus()=="I"){ echo 'selected="selected"';}?>>Inativo</option>
                </select>
            </li>
            
            <li>
                <label for="arquivo">Título:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $listagem->getNome();?>"/>
            </li>

            <li>
                <label for="descricao">Descrição da página serviços:</label>
                <textarea name="descricao" id="descricao"><?php echo $listagem->getDescricao();?></textarea>
            </li>
        </ul>

        <ul class="editor">            
            <li>
                <label for="descricao">Descrição:</label>

            	<textarea cols="80" id="editor1" name="descricaosem" rows="10"><?php echo $listagem->getDescricaoInterna();?></textarea>		
            </li>

        </ul>

            <ul class="form1">
                <li>
                    <input type="hidden" name="alterarservicosemaudo" id="alterarservicosemaudo" value="alterarservicosemaudo" />
                    <input type="image" src="img/btpublicar.jpg" name="Publicar" class="bt-adicionar" />
                    <input name="idAlteracao" id="idAlteracao" type="hidden" value="<?php echo $_REQUEST['id'];?>"/>
                </li>
            </ul>

</form>
</div>

<script type="text/javascript" src="js/jquery-1.7.min.js"></script>

<script type="text/javascript">//<![CDATA[
      CKEDITOR.replace('descricao_dicas',{
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
    CKEDITOR.replace( 'editor1' );
</script>