<?php 
	include_once("../classe/Parceiro.php");
	include_once("../funcoes/define.php");
	
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
	
	$listagem = new Parceiro();
	if($_POST["txtCampoPesquisa"]){
		$pag = "";
		$txtCampoPesquisa = $_REQUEST["txtCampoPesquisa"];
	}else{
		$pag = $_GET["pg"];
		$txtCampoPesquisa = "";
	}

	$listagem->SetNumPagina($pag);
	$listagem->setUrl("?telas=lista-de-parceiros");
	$listagem->setCampoPesquisa($txtCampoPesquisa);
	$listagem->setPalavraPesquisa($txtCampoPesquisa);
	//$listagem->setOrdenacao($ordenacao);
	//$listagem->setColuna(isset($_REQUEST["coluna"]));
?>
<div class="content">
	<p>LISTA DE PARCEIROS</p>
    
    <?php $listagem->geraLisParceiro();?>   
    
</div>
<script type="text/javascript">
$(".excluirRegistro").click(function() {

	if (confirm("Deseja realmente excluir este registro?")){
		var id = $(this).attr('id');

		$.post('../classe/Parceiro.php', {id: id}, function(resposta) {

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
</script>