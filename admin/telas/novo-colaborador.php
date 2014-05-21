<?php
include_once("../funcoes/define.php");
if(isset($_REQUEST['idAlteracao'])){
	$idAlteracao = $_REQUEST["idAlteracao"];
}else{
	$idAlteracao = "";
}

include_once("../classe/Equipe.php");
	$listagem = new Equipe();
	if($idAlteracao){
		$listagem->setId($idAlteracao);
		$listagem->geraDadosIdEquipe();
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
	<p>ADICIONAR NOVO COLABORADOR</p>
    
    <form action="../classe/Equipe.php" method="post" enctype="multipart/form-data" id="form">
        <ul class="form1">
        	<li>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="checkDados" value="<?php echo $listagem->getNome();?>" />
            </li>
            
            <li>
                <label for="email">E-mail:</label>
                <input type="text" name="email" id="email" class="checkDados" value="<?php echo $listagem->getEmail();?>"/>
            </li>

            <li>
                <label for="arquivo">Imagem:</label>
                <input type="file" name="arquivo" id="arquivo" />
            </li>

            <li>
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao"><?php echo $listagem->getDescricao();?></textarea>
            </li>
            
            <li>
                <input type="image" src="img/btadicionar.jpg" name="Adicionar" class="bt-adicionar" id="alinha" />
                <input name="idAlteracao" id="idAlteracao" type="hidden" value="<?php echo $idAlteracao;?>"/>
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
    <?php 
    if($listagem->getImagem()){
    	$caminhoImagem = URL.'upload/arquivos/'.$listagem->getImagem();
    ?>
    <div class="imagem-cadastrada">
    	<span>
        	<img src="<?php echo $caminhoImagem;?>" width="200" height="123" />
            <div>
                <a href="javascript:void(0);" class="hidetxt bt-excluir left">Excluir</a>
            </div>
        </span>
    </div>
    <?php 
    }
    ?>
</div>
<script type="text/javascript">

	function checkForm(){

		var nome = $("#nome").val();
		if (nome == ""){
			alert("preencha o nome");
			$('#nome').focus(); 
			return (false);
		}

		var email = $("#email").val();
		if (email == ""){
			alert("e-mail não pode estar em branco");
			$('#email').focus(); 
			return (false);
		}
		if (email != ""){
			var value = $("#email").val();		
			er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
	  		if(!er.exec(value)) {
	  			alert("e-mail informado esta incorreto");
				$('#email').focus();
				return false;
			}
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
</script>