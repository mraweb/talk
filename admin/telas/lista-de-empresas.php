<?php 
	include_once("../classe/Empresa.php");
	
	if(isset($_REQUEST['msn'])){
	$msn = $_REQUEST["msn"];
	echo'
	<script type="text/javascript">
		alert("'.base64_decode($msn).'");
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
	
	$listagem = new Empresa();
	if($_POST["txtCampoPesquisa"]){
		$pag = "";
		$txtCampoPesquisa = $_REQUEST["txtCampoPesquisa"];
	}else{
		$pag = $_GET["pg"];
		$txtCampoPesquisa = "";
	}

	$listagem->SetNumPagina($pag);
	$listagem->setUrl("?telas=lista-de-empresas");
	$listagem->setCampoPesquisa($txtCampoPesquisa);
	$listagem->setPalavraPesquisa($txtCampoPesquisa);
	$listagem->setOrdenacao($_REQUEST["statusId"]);
	$listagem->setColuna($_REQUEST["coluna"]);
?>
<div class="content">
	<p>LISTA DE RÁDIOS</p>
    
    <div class="buscar">
    	<form action="#" id="formBusca" method="post" enctype="multipart/form-data">
            <label for="Busca">Buscar</label>
            <input type="text" name="txtCampoPesquisa" id="Busca" placeholder="Nome Fantasia"/>
            <input type="image" src="img/btbuscar.jpg" name="Buscar" id="Buscar" class="bt-buscar" />
        </form>
    </div>
    
    <ul class="situacao">
    	<li><a href="?telas=lista-de-empresas&coluna=status_id&statusId=2" class="link"><img src="img/tique.png" class="left" /> Ativado</a></li>
    	<li><a href="?telas=lista-de-empresas&coluna=status_id&statusId=3" class="link"><img src="img/inativo.png" class="left" /> Inativo</a></li>
    	<li><a href="?telas=lista-de-empresas&coluna=status_id&statusId=1" class="link"><img src="img/analise.png" class="left" /> Em análise</a></li>
    </ul>
    
    <table>
    	<thead>
        	<tr>
            	<td><strong>CÓDIGO</strong></td>
                <td><strong>NOME FANTASIA</strong></td>
                <td><strong>OBSERVAÇÕES</strong></td>
                <td><strong>EDITAR</strong></td>
                <td><strong>EXCLUIR</strong></td>
                <td><strong>SITUAÇÃO</strong></td>
            </tr>
        </thead>
        
        <tbody>
        	<?php $listagem->geraLisEmpresa();?>
        </tbody>
    </table>
    
    <?php echo $listagem->geraNumeros(); ?>
    
    
</div>
<script type="text/javascript">
$(".excluirRegistro").click(function() {

	if (confirm("Deseja realmente excluir este registro?")){
		var id = $(this).attr('id');
	
		$.post('../classe/Empresa.php', {id: id}, function(resposta) {

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

$(".ativarRegistro").click(function() {

	if (confirm("Deseja realmente ativar este registro?")){
		var id = $(this).attr('id');
		var acao = "ativarRegistro";
	
		$.post('../classe/Empresa.php', {idAtivacao: id, acao: acao}, function(resposta) {

			if(resposta == "Alterado com Sucesso!!!"){
				alert(resposta);
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