<?php 
	include_once("../classe/Cliente.php");
	
	/* inicio da ordenacao */
	if(isset($_REQUEST["ordenar"]))
		$ordenar = $_REQUEST["ordenar"];
	else
		$ordenar = "";

	if(!$ordenar){

		$ordenacao = "desc";
		$tipoOrdenacao = "Decrescente";
	}else{
		$ordenacao = "";
		$tipoOrdenacao = "Crescente";
	}
	/* fim da ordenacao */
	
	$listagem = new Cliente();
	if($_POST["txtCampoPesquisa"]){
		$pag = "";
		$txtCampoPesquisa = $_REQUEST["txtCampoPesquisa"];
	}else{
		$pag = $_GET["pg"];
		$txtCampoPesquisa = "";
	}

	$listagem->SetNumPagina($pag);
	$listagem->setUrl("?telas=lista-de-cadastro");
	$listagem->setCampoPesquisa($txtCampoPesquisa);
	$listagem->setPalavraPesquisa($txtCampoPesquisa);
	//$listagem->setOrdenacao($ordenacao);
	//$listagem->setColuna(isset($_REQUEST["coluna"]));
	
	$listagem->getStatusModal();
	if($listagem->getModalCadastro()=='ativo'){
		$statusAtivo = 'checked';
		$statusInativo = '';
	}else if($listagem->getModalCadastro()=='inativo'){
		$statusAtivo = '';
		$statusInativo = 'checked';
	}
?>
<div class="content">
	<p>LISTA DE CADASTRO - SERVIÇOS</p>

	<ul class="ativo-inativo">
		<li>
			<input type="radio" name="ativo-inativo" id="ativo" value="ativo" class="ativo_inativo"  <?php echo $statusAtivo;?>>
			<label for="ativo">Ativo</label>
		</li>

		<li>
			<input type="radio" name="ativo-inativo" id="inativo" value="inativo" class="ativo_inativo" <?php echo $statusInativo;?>>
			<label for="inativo">Inativo</label>
		</li>
	</ul>
<a href="telas/exportar-cadastro.php">baixar excel</a>
    <div class="buscar">
        <form action="#" id="formBusca" method="post" enctype="multipart/form-data">
            <label for="Busca">Buscar</label>
            <input type="text" name="txtCampoPesquisa" id="Busca" placeholder="Busca pelo nome" />
            <input type="image" src="img/btbuscar.jpg" name="Buscar" id="Buscar" class="bt-buscar" />
        </form>
    </div>
    
    <table>
    	<thead>
        	<tr>
            	<td><strong>NOME</strong></td>
                <td><strong>E-MAIL</strong></td>
                <td><strong>EDITAR</strong></td>
                <td><strong>EXCLUIR</strong></td>
            </tr>
        </thead>
        
        <tbody>
        	<?php $listagem->geraLisCliente();?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
$(".excluirRegistro").click(function() {

	if (confirm("Deseja realmente excluir este registro?")){
		var id = $(this).attr('id');

		$.post('../classe/Cliente.php', {id: id}, function(resposta) {

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

$(".ativo_inativo").click(function() {

	var value =  $(this).attr("id");

	var acao = "statusModalCadastro";
	
	$.post('../classe/Cliente.php', {acao: acao, value: value}, function(resposta) {
		
		if(resposta == 1){
			alert('Status do modal alterado');
		}
	});
	
});
</script>