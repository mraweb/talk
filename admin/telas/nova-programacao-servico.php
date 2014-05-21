<?php
include_once("../funcoes/define.php");
if(isset($_REQUEST['idAlteracao'])){
	$idAlteracao = $_REQUEST["idAlteracao"];
}else{
	$idAlteracao = "";
}

include_once("../classe/Programacao.php");
	$listagem = new Programacao();
	if($idAlteracao){
		$listagem->setId($idAlteracao);
		$listagem->geraDadosIdProgramacao();
	}

if(isset($_REQUEST['msn'])){
	$msn = $_REQUEST["msn"];
	echo'
	<script type="text/javascript">
		alert("'.base64_decode($msn).'");
	</script>
	';
}

include_once("../classe/ComboBox.php");
$comboBox = new ComboBox();
?>
<div class="content">
	<p>ADICIONAR NOVA PROGRAMAÇÃO</p>
    
    <form action="../classe/Programacao.php" method="post" enctype="multipart/form-data" id="form">
        <ul class="form1">
        
        	<li>
                <label for="data">* Status:</label>
                <select name="status" id="status">
                    <option value="A" <?php if($listagem->getStatus()=="A"){ echo 'selected="selected"';}?>>Ativo</option>
                    <option value="I" <?php if($listagem->getStatus()=="I"){ echo 'selected="selected"';}?>>Inativo</option>
                </select>
            </li>
        
        	<li>
	            <label for="tipoProgramacao">* Tipo Programação:</label>
	            <select name="tipoProgramacao" id="tipoProgramacao">
	            	<option value=""></option>
	            	<option value="D" <?php if($listagem->getTipoProgramacao()=="D"){ echo 'selected="selected"';}?>>Programação Diária</option>
                    <option value="S" <?php if($listagem->getTipoProgramacao()=="S"){ echo 'selected="selected"';}?>>Programação Semanal</option>
	            </select>
	        </li>
	        
        	<li>
	            <label for="servico">* Serviço:</label>
	            <select name="servico" id="servico" class="selecionaCategoria">
	            	<option value=""></option>
	                <?php 
	                	$comboBox->servicos($listagem->getServicoId());
	                ?>
	            </select>
	        </li>
	        
	        <li>
	            <label for="categoria">* Categoria:</label>
	            <select name="categoria" id="categoria">
	            	<option value="">--Primeiro selecione o serviço--</option>
	            </select>
	        </li>
	        
	        <li>
	            <label for="nome">* Nome da Programação:</label>
	            <input type="text" name="nome" id="nome" value="<?php echo $listagem->getNomeProgramacao();?>"/>
            </li>

            <li>
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao"><?php echo $listagem->getDescricao();?></textarea>
            </li>
            
            <li>
	            <label for="seg">Segmentação:</label>
	            <input type="text" name="segmentacao" id="segmentacao" value="<?php echo $listagem->getSegmentacao();?>"/>
            </li>

            <li>
	            <label for="hora">Indicação de Horário:</label>
	            <input type="text" name="indicacaodehorario" id="indicacaodehorario" value="<?php echo $listagem->getIndicacaodehorario();?>"/>
            </li>

          	<li>
            	<label for="exec">Execuções Diárias:</label>
            	<input type="text" name="execucoesdiarias" id="execucoesdiarias" value="<?php echo $listagem->getExecucoesdiarias();?>"/>
           	</li>

           	<li>
            	<label for="tempo">Tempo:</label>
            	<input type="text" name="tempo" id="tempo" value="<?php echo $listagem->getTempo();?>"/>
           	</li>

            <li>
            	<label for="grade">Distribuição na Grade:</label>
            	<input type="text" name="distribuicaonagrade" id="distribuicaonagrade" value="<?php echo $listagem->getDistribuicaonagrade();?>"/>
            </li>

            <li>
           		<label for="intervalo">Indicativo de Intervalo:</label>
            	<input type="text" name="indicativodeintervalo" id="indicativodeintervalo" value="<?php echo $listagem->getIndicativodeintervalo();?>"/>
          	</li>

   			<li>
            	<label for="apresenta">Apresentação:</label>
             	<input type="text" name="apresentacao" id="apresentacao" value="<?php echo $listagem->getApresentacao();?>"/>
         	</li>
         	
        	<li>
            	<label for="audio1">Aúdio 1:</label>
            	<input type="text" name="audio1" id="audio1" value="<?php echo $listagem->getAudio1();?>"/>
          	</li>
			
			<li>
      			<label for="audio1">Aúdio 2:</label>
      			<input type="text" name="audio2" id="audio2" value="<?php echo $listagem->getAudio2();?>"/>
          	</li>

       		<li>
            	<label for="audio1">Aúdio 3:</label>
         		<input type="text" name="audio3" id="audio3" value="<?php echo $listagem->getAudio3();?>"/>
          	</li>

          	<li>
         		<label for="audio1">Aúdio 4:</label>
       			<input type="text" name="audio4" id="audio4" value="<?php echo $listagem->getAudio4();?>"/>
       			</li>

        	<li>
         		<label for="audio1">Aúdio 5:</label>
        		<input type="text" name="audio5" id="audio5" value="<?php echo $listagem->getAudio5();?>"/>
     		</li>         	
            
            <li>
                <input type="image" src="img/btadicionar.jpg" name="Adicionar" class="bt-adicionar" id="alinha" />
                <input name="idAlteracao" id="idAlteracao" type="hidden" value="<?php echo $idAlteracao;?>"/>
                <input name="idCategoria" id="idCategoria" type="hidden" value="<?php echo $listagem->getCategoriaServicoId();?>"/>
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

		var status = $("#status").val();
		if (status == ""){
			alert("selecione uma das opções do status");
			$('#status').focus(); 
			return (false);
		}

		var tipoProgramacao = $("#tipoProgramacao").val();
		if (tipoProgramacao == ""){
			alert("selecione uma das opções do tipo programação");
			$('#tipoProgramacao').focus(); 
			return (false);
		}

		var servico = $("#servico").val();
		if (servico == ""){
			alert("selecione uma das opções de serviço");
			$('#servico').focus(); 
			return (false);
		}

		var categoria = $("#categoria").val();
		if (categoria == ""){
			alert("selecione uma das opções de categoria");
			$('#categoria').focus(); 
			return (false);
		}

		var nome = $("#nome").val();
		if (nome == ""){
			alert("preencha o campo nome da programação");
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
		
		$.post('../classe/Equipe.php', {acao: acao, name: name, value: value, idCheck: idCheck}, function(resposta) {
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
			$.post('../classe/Equipe.php', {
				idImagem: id,
				acao: acao
				}, function(resposta) { 
					$('.imagem-cadastrada').hide();
				}); 
		}

	});

	$(".selecionaCategoria").change(function() {
  	  	var valor = $('#servico').val();
  	  	var acao = "montaCategoriaServico";
		$('#categoria').html("<option value='0'>Carregando...</option>");
		setTimeout(function(){
			$('#categoria').load("../classe/ComboBox.php",{id:valor, acao:acao})
		}, 2000);
	});

	$(document).ready(function(){
		var idServico = $('#servico').val();
		var idCategoria = $('#idCategoria').val();
  	  	var acao = "montaCategoriaServico";
		$('#categoria').html("<option value='0'>Carregando...</option>");
		setTimeout(function(){
			$('#categoria').load("../classe/ComboBox.php",{id:idServico, acao:acao, idCategoria: idCategoria})
		}, 2000);
	});
</script>