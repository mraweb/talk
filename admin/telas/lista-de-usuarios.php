<?php 
	include_once("../classe/Administrador.php");
	
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
	
	$listagem = new Administrador();
	if($_POST["txtCampoPesquisa"]){
		$pag = "";
		$txtCampoPesquisa = $_REQUEST["txtCampoPesquisa"];
	}else{
		$pag = $_GET["pg"];
		$txtCampoPesquisa = "";
	}

	$listagem->SetNumPagina($pag);
	$listagem->setUrl("?telas=lista-de-usuarios");
	$listagem->setCampoPesquisa($txtCampoPesquisa);
	$listagem->setPalavraPesquisa($txtCampoPesquisa);
	$listagem->setOrdenacao($ordenacao);
	$listagem->setColuna(isset($_REQUEST["coluna"]));
?>
<div class="content">
	<p>LISTA DE USUÁRIOS</p>
    
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
        	<?php $listagem->geraLisAdministrador();?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
$(".excluirRegistro").click(function() {

	if (confirm("Deseja realmente excluir este registro?")){
		var id = $(this).attr('id');
	
		$.post('../classe/Administrador.php', {id: id}, function(resposta) {
				if (resposta == "Apagado com Sucesso!!!") {
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