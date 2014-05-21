<div class="content">
	<p>SERVIÇOS</p>
     <?php 
    	include_once("../classe/Servico.php");
    	$servico = new Servico();
    	$servico->listServicosAdmin();
    ?>
</div>