<?php 
	include_once("../classe/Imprensa.php");
	
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
	
	$listagem = new Impresa();
	if($_POST["txtCampoPesquisa"]){
		$pag = "";
		$txtCampoPesquisa = $_REQUEST["txtCampoPesquisa"];
	}else{
		$pag = $_GET["pg"];
		$txtCampoPesquisa = "";
	}

	$listagem->SetNumPagina($pag);
	$listagem->setUrl("?telas=lista-de-reportagens");
	$listagem->setCampoPesquisa($txtCampoPesquisa);
	$listagem->setPalavraPesquisa($txtCampoPesquisa);
	//$listagem->setOrdenacao($ordenacao);
	//$listagem->setColuna(isset($_REQUEST["coluna"]));
?>
<div class="content">
	<p>LISTA DE REPORTAGENS</p>
    
    <div class="buscar">
    	<form action="#" id="formBusca" method="post" enctype="multipart/form-data">
            <label for="Busca">Buscar</label>
            <input type="text" name="txtCampoPesquisa" id="Busca" />
            <input type="image" src="img/btbuscar.jpg" name="Buscar" id="Buscar" class="bt-buscar" />
        </form>
    </div>
    
    <table>
    	<thead>
        	<tr>
            	<td><strong>DATA</strong></td>
                <td><strong>TÍTULO</strong></td>
                <td><strong>EDITAR</strong></td>
                <td><strong>EXCLUIR</strong></td>
            </tr>
        </thead>
        
        <tbody>
        	<?php $listagem->geraLisImprensa();?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
$(".excluirRegistro").click(function() {

	if (confirm("Deseja realmente excluir este registro?")){
		var id = $(this).attr('id');
	
		$.post('../classe/Imprensa.php', {id: id}, function(resposta) {

			if(resposta == "Apagado com Sucesso!!!"){
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