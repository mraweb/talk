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
        </ul>

        <ul class="form1">            
            <li>
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao"><?php echo $listagem->getDescricao();?></textarea>
            </li>

        </ul>

        <div id="abreSegmento">
            <ul class="form1">
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
            </ul>    

            <ul class="form1">
                <li class="mrg-top">Adicionar Categoria</li>

                <li>
                    <label for="nomecat">Nome Categoria:</label>
                    <input type="text" name="nomecategoria" id="nomecategoria" value="<?php //echo $listagem->getNomeCategoria();?>"/>
                    <input type="hidden" id="idcategoria" value="">
                </li>

                <li>
                    <label for="audio1">Aúdio 1:</label>
                    <input type="hidden" name="audio" id="audio" value="<?php echo $listagem->getAudio();?>"/>
                    <input type="text" name="audio1" id="audio1" value="<?php //echo $listagem->getAudio1();?>"/>
                </li>

                <li>
                    <label for="audio1">Aúdio 2:</label>
                    <input type="text" name="audio2" id="audio2" value="<?php //echo $listagem->getAudio2();?>"/>
                </li>

                <li>
                    <label for="audio1">Aúdio 3:</label>
                    <input type="text" name="audio3" id="audio3" value="<?php //echo $listagem->getAudio3();?>"/>
                </li>

                <li>
                    <label for="audio1">Aúdio 4:</label>
                    <input type="text" name="audio4" id="audio4" value="<?php //echo $listagem->getAudio4();?>"/>
                </li>

                <li>
                    <label for="audio1">Aúdio 5:</label>
                    <input type="text" name="audio5" id="audio5" value="<?php //echo $listagem->getAudio5();?>"/>
                </li>

                <li>
                    <label for="sub-cat">Sub-Categoria:</label>
                    <select name="sub-cat" id="servicoSubCategoria">
                    	<option value="">Selecione</option>
                    	<?php 
                    		$combobox = new ComboBox();
                    		$combobox->servicoSubCategoria();
                    	?>
                    </select>
                </li>
            </ul>
        </div>

            <ul class="form1">
                <li>
                    <!-- <input type="image" src="img/btaddmais.jpg" name="Adicionar" id="adicionar" class="bt-adicionar" />  -->
                    <input type="image" src="img/btpublicar.jpg" name="Publicar" class="bt-adicionar addServico" />
                </li>
            </ul>


    <table id="tabela">
        <thead>
            <tr>
                <td><strong>CATEGORIA</strong></td>
                <td><strong>SUBCATEGORIA</strong></td>
                <td><strong>EDITAR</strong></td>
                <td><strong>EXCLUIR</strong></td>
            </tr>
        </thead>
        
        <tbody>
        	<?php 
        		$listagem->setId($idAlteracao);
        		$listagem->geraLisServico();
        	?>
        </tbody>
    </table>
    <?php 
    if($listagem->getLogo()){
    	$caminhoImagem = URL.'img/'.$listagem->getLogo();
    ?>
    <div class="imagem-cadastrada">
        <span>
            <img src="<?php echo $caminhoImagem;?>" />
        </span>
    </div>
    <?php 
    }
    ?>
</div>
<input type="hidden" id="idServico" value="<?php echo $_REQUEST['id'];?>">
<input type="hidden" id="audio" value="<?php echo $listagem->getAudio();?>">
<script type="text/javascript" src="js/jquery-1.7.min.js"></script>
<script type="text/javascript">
	var idServico = $('#idServico').val();

    if(idServico > 7){
    	$("#abreSegmento").hide();
    	$("#tabela").hide();
    	$("#adicionar").hide();
    	$("#btsegmentacao").hide();
    }

    $(".addServico").click(function() {
    	var idSubCategoria = $('#servicoSubCategoria').val();
    	var idcategoria = $('#idcategoria').val();

    	// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
		var id = $('#idServico').val();
		var acao = "addServico";
		//$idAlteracao = $_POST["idAlteracao"];					
		var nome = $('#nome').val();
		var status = $('#status').val();
		var descricao = $('#descricao').val();
		var audio = $('#audio').val();
		var segmentacao = $('#segmentacao').val();
		var indicacaodehorario = $('#indicacaodehorario').val();
		var execucoesdiarias = $('#execucoesdiarias').val();
		var tempo = $('#tempo').val();
		var distribuicaonagrade = $('#distribuicaonagrade').val();
		var indicativodeintervalo = $('#indicativodeintervalo').val();
		var apresentacao = $('#apresentacao').val();
		var nomecategoria = $('#nomecategoria').val();
		var audio1 = $('#audio1').val();
		var audio2 = $('#audio2').val();
		var audio3 = $('#audio3').val();
		var audio4 = $('#audio4').val();
		var audio5 = $('#audio5').val();

		

		// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
		$.post('../classe/Servico.php', {
			acao: acao,
			idAlteracao: id,
			nome: nome,
			status: status,
			descricao: descricao,
			audio: audio,
			segmentacao: segmentacao,
			indicacaodehorario: indicacaodehorario,
			execucoesdiarias: execucoesdiarias,
			tempo: tempo,
			distribuicaonagrade: distribuicaonagrade,
			indicativodeintervalo: indicativodeintervalo,
			apresentacao: apresentacao,
			idSubCategoria: idSubCategoria,
			nomecategoria: nomecategoria,
			audio1: audio1,
			audio2: audio2,
			audio3: audio3,
			audio4: audio4,
			audio5: audio5,
			idCategoria: idcategoria			
			}, function(resposta) { 
				if(resposta == 1){
					alert("Atualizado com Sucesso!!!");
					window.location.reload();
				}else{
					alert("error na alteração");
				}
			}); 
	});


    $(".bt-excluir").click(function() {

		if (confirm("Tem certeza que deseja excluir a imagem?")) {  

			// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
			var id = $('#idServico').val();
			var acao = "excluirArquivo";

			// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
			$.post('../classe/Servico.php', {
				idImagem: id,
				acao: acao
				}, function(resposta) { 
					$('.imagem-cadastrada').hide();
				}); 
		}

	});

    $(".excluirRegistro").click(function() {

    	if (confirm("Deseja realmente excluir este registro?")){
    		var id = $(this).attr('id');
    		var acao = "excluirRegistro";

    		$.post('../classe/Servico.php', {acao: acao, id: id}, function(resposta) {

    			if(resposta == 1){
    				alert("Registro excluido com sucesso!");
    				window.location.reload();
    			}else {
    				alert(resposta);
    				return false;
    			}				
    			
    		});
    	}else{
    		return false;  
    	}

    });

    $(".alterarRegistro").click(function() {

    	var id = $(this).attr('id');
    	var acao = "alterarRegistro";

    	$.post('../classe/Servico.php', {acao: acao, id: id}, function(resposta) {

    		var dados = resposta.split("|");

    		$('#idcategoria').val(dados[0]);
    		$('#nomecategoria').val(dados[2]);
    		$('#audio1').val(dados[3]);
    		$('#audio2').val(dados[4]);
    		$('#audio3').val(dados[5]);
    		$('#audio4').val(dados[6]);
    		$('#audio5').val(dados[7]);	

    		$("select option[value='"+dados[1]+"']").attr("selected","selected");	
    			
    	});
    });
</script>
