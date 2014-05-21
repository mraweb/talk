<?php 
	include_once("../classe/Servico.php");
	
	if(isset($_REQUEST['msn'])){
	$msn = $_REQUEST["msn"];
	echo'
	<script type="text/javascript">
		alert("Ordens alteradas com sucesso!");
	</script>
	';
}
	
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
	
	$listagem = new Servico();
	if($_POST["txtCampoPesquisa"]){
		$pag = "";
		$txtCampoPesquisa = $_REQUEST["txtCampoPesquisa"];
	}else{
		$pag = $_GET["pg"];
		$txtCampoPesquisa = "";
	}

	$listagem->SetNumPagina($pag);
	$listagem->setUrl("?telas=ordenar-servicos");
	$listagem->setCampoPesquisa($txtCampoPesquisa);
	$listagem->setPalavraPesquisa($txtCampoPesquisa);
	//$listagem->setOrdenacao($ordenacao);
	//$listagem->setColuna(isset($_REQUEST["coluna"]));
?>
<div class="content">
	<p>ORDENAR SERVIÇOS</p>
    
    <table>
    	<thead>
        	<tr>
            	<td><strong>SERVIÇO</strong></td>
            	<td><strong>TIPO ÁUDIO</strong></td>
            	<td><strong>POSIÇÃO</strong></td>
            </tr>
        </thead>
        
        <form action="../classe/Servico.php" method="post" enctype="multipart/form-data" id="form">
        <tbody>
        	<?php $listagem->ordenarServico();?>
        	<input type="submit" name="salvar" value="salvar">
        	<input type="hidden" name="acao" id="acao" value="salvarOrdemDeServico">
        </tbody>
        </form>
    </table>
</div>