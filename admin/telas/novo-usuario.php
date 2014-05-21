<?php
if(isset($_REQUEST['idAlteracao'])){
	$idAlteracao = $_REQUEST["idAlteracao"];
}else{
	$idAlteracao = "";
}



include_once("../classe/Administrador.php");
	$listagem = new Administrador();
	if($idAlteracao){
		$listagem->setId($idAlteracao);
		$listagem->geraDadosIdAdministrador();
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
	<p>ADICIONAR NOVO USUÁRIO</p>
    
   <form action="../classe/Administrador.php" method="post" enctype="multipart/form-data" id="form">
        <ul class="form1">
            <li>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $listagem->getNomeAlteracao();?>"/>
            </li>
            
            <li>
                <label for="mail">E-mail:</label>
                <input type="text" name="email" id="email" value="<?php echo $listagem->getEmailAlteracao();?>"/>
            </li>
            
            <li>
                <label for="pass">Senha:</label>
                <input type="password" name="senha" id="senha" />
            </li>
            
            <li>
                <input type="image" src="img/btcadastrar.jpg" name="Cadastrar" class="bt-cadastrar" />
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
</div>

<script type="text/javascript">
	function checkForm(){
	
		var nome = $("#nome").val();
		if (nome == ""){
			alert("preencha o campo nome");
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

		var idAlteracao = $("#idAlteracao").val();
		if(idAlteracao == ""){
			var senha = $("#senha").val();
			if (senha == ""){
				alert("preencha o campo senha");
				$('#senha').focus(); 
				return (false);
			}
		}
	return true;
	}

	
	$(".bt-cadastrar").click(function() {
		if(checkForm()){
			$("#form").submit();
		}else{
			return false;
		}
		
	});
</script>