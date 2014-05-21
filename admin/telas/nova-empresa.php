<?php 
if(isset($_REQUEST['idAlteracao'])){
	$idAlteracao = $_REQUEST["idAlteracao"];
}else{
	$idAlteracao = "";
}

include_once("../classe/Empresa.php");
	$listagem = new Empresa();
	if($idAlteracao){
		$listagem->setId($idAlteracao);
		$listagem->geraDadosIdEmpresa();
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
	<p>ADICIONAR NOVO CADASTRO</p>
	<form action="../classe/Empresa.php" method="post" enctype="multipart/form-data" id="form">
	    <ul class="form-cada">
	        <li>
	            <label for="fantasia">Nome Fantasia:</label>
	            <input type="text" name="fantasia" id="fantasia" class="checkDados" value="<?php echo $listagem->getFantasia();?>"/>
	        </li>

	        <li>
	            <label for="sintonia">* Sintonia:</label>
	            <input type="text" name="sintonia" id="sintonia" value="<?php echo $listagem->getSintonia();?>"/>
	        </li>

	        <li>
	            <label for="outorga">* Outorga:</label>
	            <select name="outorga" id="outorga">
	            	<option value=""></option>
	                <?php 
	                	$comboBox->outorga($listagem->getOutorgaId());
	                ?>
	            </select>
	        </li>

	        <li>
	            <label for="prefixo">* Prefixo:</label>
	            <div class="error"></div>
	            <input type="text" name="prefixo" id="prefixo" class="validate[required]" value="<?php echo $listagem->getPrefixo();?>"/>
	        </li>

	        <li>
	            <label for="razao">* Razão Social:</label>
	            <div class="error"></div>
	            <input type="text" name="razao" id="razao" value="<?php echo $listagem->getRazao();?>"/>
	        </li>

	        <li>
	            <label for="cnpj">* CNPJ:</label>
	            <div class="error"></div>
	            <input type="text" name="cnpj" id="cnpj" class="checkDados" value="<?php echo $listagem->getCnpj();?>"/>
	        </li>

	        <!--<li>
	            <label for="pais">* País:</label>
	            <div class="error"></div>
	            <select name="pais" id="pais" class="selecionaEstados">
	                <option value=""></option>
	                <?php 
	                	//$comboBox->pais($listagem->getPaisId());
	                ?>
	            </select>
	        </li>-->

	        <li>
	            <label for="estado">* Estado:</label>
	            <div class="error"></div>
	            <select name="estado" id="estado">
	                <option value=""></option>
	                <?php 
	                	$comboBox->setPaisId(50);
	                	$comboBox->estados();
	                ?>
	            </select>
	        </li>

	        <li>
	            <label for="cidade">Cidade:</label>
	            <input type="text" name="cidade" id="cidade" value="<?php echo $listagem->getCidade();?>"/>
	        </li>

	        <li>
	            <label for="tel">* Telefone:</label>
	            <div class="error"></div>
	            <input type="text" name="tel" id="tel" value="<?php echo $listagem->getTel();?>"/>
	        </li>

	        <li>
	            <label for="endereco">* Endereço Comercial:</label>
	            <div class="error"></div>
	            <input type="text" name="endereco" id="endereco" value="<?php echo $listagem->getEndereco();?>"/>
	        </li>

	        <li>
	            <label for="num">Número:</label>
	            <input type="text" name="num" id="num" value="<?php echo $listagem->getNum();?>"/>
	        </li>
	    </ul>

	    <ul class="form-cada">
	        <li>
	            <label for="bairro">Bairro:</label>
	            <input type="text" name="bairro" id="bairro" value="<?php echo $listagem->getBairro();?>"/>
	        </li>

	        <li>
	            <label for="cep">* CEP:</label>
	            <div class="error"></div>
	            <input type="text" name="cep" id="cep" value="<?php echo $listagem->getCep();?>"/>
	        </li>

	        <li>
	            <label for="diretorcomercial">* Diretor Geral:</label>
	            <div class="error"></div>
	            <input type="text" name="diretorcomercial" id="diretorcomercial" value="<?php echo $listagem->getDiretorcomercial();?>"/>
	        </li>

	        <li>
	            <label for="mailcomercial">* E-mail Geral:</label>
	            <div class="error"></div>
	            <input type="text" name="mailcomercial" id="mailcomercial" value="<?php echo $listagem->getMailcomercial();?>"/>
	        </li>

	        <li>
	            <label for="tel1">* Telefone Diretor Geral:</label>
	            <div class="error"></div>
	            <input type="text" name="tel1" id="tel1" value="<?php echo $listagem->getTelefoneDiretorGeral();?>"/>
	        </li>

	        <li>
	            <label for="diretorartistico">Diretor Artístico:</label>
	            <input type="text" name="diretorartistico" id="diretorartistico" value="<?php echo $listagem->getDiretorartistico();?>"/>
	        </li>

	        <li>
	            <label for="mailartistico">E-mail Diretor Artístico:</label>
	            <input type="text" name="mailartistico" id="mailartistico" value="<?php echo $listagem->getMailartistico();?>"/>
	        </li>

	        <li>
	            <label for="tel2">* Telefone Diretor Artístico:</label>
	            <div class="error"></div>
	            <input type="text" name="tel2" id="tel2" value="<?php echo $listagem->getTelefoneDiretorArtistico();?>"/>
	        </li>

	        <li>
	            <label for="msn">Facebook / Skype:</label>
	            <input type="text" name="msn" id="msn" value="<?php echo $listagem->getMsn();?>"/>
	        </li>

	        <li>
	            <label for="site">Site da Rádio:</label>
	            <input type="text" name="site" id="site" value="<?php echo $listagem->getSite();?>"/>
	        </li>

	        <li>
	            <label for="nome">* Nome contato:</label>
	            <div class="error"></div>
	            <input type="text" name="nome" id="nome" value="<?php echo $listagem->getNomeContato();?>"/>
	        </li>
	    </ul>

	    <ul class="form-cada">
	        <li>
	            <label for="servico">Já possui algum serviço parecido com a Talk Rádio, qual?</label>
	            <textarea name="servico" id="servico" rows="5" cols="50"><?php echo $listagem->getServico();?></textarea>
	        </li>

	        <li>
	            <label for="onde">* Onde nos Conheceu:</label>
	            <div class="error"></div>
	            <input type="text" name="onde" id="onde" class="validate[required]" value="<?php echo $listagem->getOnde();?>"/>
	        </li>

	        <li>
	            <label for="necessidade">Qual a sua necessidade atual:</label>
	            <textarea name="necessidade" id="necessidade" rows="5" cols="50"><?php echo $listagem->getNecessidade();?></textarea>
	        </li>

	        <li>
	            <label for="obs">Observações:</label>
	            <textarea name="obs" id="obs" rows="5" cols="50"><?php echo $listagem->getObs();?></textarea>
	        </li>

	        <li>
	            <label for="situacao">* Situação:</label>
	            <div class="error"></div>
	            <select name="situacao" id="situacao">
	            	<?php 
	                	$comboBox->status($listagem->getStatusId());
	                ?>
	            </select>
	        </li>

	        <li>
	            <input type="image" src="img/btadicionar.jpg" name="Adicionar" class="bt-adicionar" />
	            <input name="idAlteracao" id="idAlteracao" type="hidden" value="<?php echo $idAlteracao;?>"/>
	            <input name="estadoId" id="estadoId" type="hidden" value="<?php echo $listagem->getEstadoId();?>"/>
	            
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
	
		var sintonia = $("#sintonia").val();
		if (sintonia == ""){
			alert("preencha o campo Sintonia");
			$('#sintonia').focus(); 
			return (false);
		}

		var outorga = $("#outorga").val();
		if (outorga == ""){
			alert("selecione uma Outorga");
			$('#outorga').focus(); 
			return (false);
		}

		var prefixo = $("#prefixo").val();
		if (prefixo == ""){
			alert("preencha o campo Prefixo");
			$('#prefixo').focus(); 
			return (false);
		}

		var razao = $("#razao").val();
		if (razao == ""){
			alert("preencha o campo Razão Social");
			$('#razao').focus(); 
			return (false);
		}

		var cnpj = $("#cnpj").val();
		if (cnpj == ""){
			alert("preencha o campo CNPJ");
			$('#cnpj').focus(); 
			return (false);
		}

		var pais = $("#pais").val();
		if (pais == ""){
			alert("selecione um Pais");
			$('#pais').focus(); 
			return (false);
		}

		var estado = $("#estado").val();
		if (estado == ""){
			alert("selecione um Estado");
			$('#estado').focus(); 
			return (false);
		}

		var tel = $("#tel").val();
		if (tel == ""){
			alert("preencha o campo Telefone");
			$('#tel').focus(); 
			return (false);
		}

		var endereco = $("#endereco").val();
		if (endereco == ""){
			alert("preencha o campo Endereço Comercial");
			$('#endereco').focus(); 
			return (false);
		}

		var cep = $("#cep").val();
		if (cep == ""){
			alert("preencha o campo Cep");
			$('#cep').focus(); 
			return (false);
		}

		var diretorcomercial = $("#diretorcomercial").val();
		if (diretorcomercial == ""){
			alert("preencha o campo Diretor Comercial");
			$('#diretorcomercial').focus(); 
			return (false);
		}

		var mailcomercial = $("#mailcomercial").val();
		if (mailcomercial == ""){
			alert("preencha o campo E-mail Comercial");
			$('#mailcomercial').focus(); 
			return (false);
		}

		var mailcomercial = $("#mailcomercial").val();
		if (mailcomercial == ""){
			alert("preencha o campo E-mail Comercial");
			$('#mailcomercial').focus(); 
			return (false);
		}

		var nome = $("#nome").val();
		if (nome == ""){
			alert("preencha o campo Nome contato");
			$('#nome').focus(); 
			return (false);
		}

		var onde = $("#onde").val();
		if (onde == ""){
			alert("preencha o campo Onde nos Conheceu");
			$('#onde').focus(); 
			return (false);
		}

		var situacao = $("#situacao").val();
		if (situacao == ""){
			alert("selecione uma Situacao");
			$('#situacao').focus(); 
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

	$(".selecionaEstados").change(function() {
  	  	var valor = $('#pais').val();
  	  	var acao = "montaEstados";
		$('#estado').html("<option value='0'>Carregando...</option>");
		setTimeout(function(){
			$('#estado').load("../classe/ComboBox.php",{id:valor, acao:acao})
		}, 2000);
	});

	$(".checkDados").change(function() {
		var name = $(this).attr('name');
		var value = $('#'+name).val();

		var idCheck = null;
		if($('#idAlteracao').val() > 0)
			idCheck = $('#idAlteracao').val();
		
		var acao = "checkDados";
		
		$.post('../classe/Empresa.php', {acao: acao, name: name, value: value, idCheck: idCheck}, function(resposta) {
			if(resposta == 1){
				alert(name+" com "+value+" já existe! Infome outro");
				$('#'+name).focus();
			}
		});
		
	});

	$(document).ready(function(){
		var valor = 50;
		var estadoId = $('#estadoId').val();
  	  	var acao = "montaEstados";
		$('#estado').html("<option value='0'>Carregando...</option>");
		setTimeout(function(){
			$('#estado').load("../classe/ComboBox.php",{id:valor, acao:acao, estadoId: estadoId})
		}, 2000);
	});
</script>
