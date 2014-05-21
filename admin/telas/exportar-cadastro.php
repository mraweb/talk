<?php
header ('Content-type: text/html; charset=UTF-8');
require('../../classe/ExportarExcel.php');
require('../../classe/Cliente.php');

$clientes = new Cliente();
$htmlClientes = $clientes->getClientesExport();



$html = "
	<table border='0'>
		<tr>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Rádio</th>
			<th>UF</th>
			<th>Cidade</th>
			<th>Telefone</th>
		</tr>
	";
	$html .= $htmlClientes;
$html .= "</table>";

//Chamando o método
ExportarExcel::toXLS($html,"clientes-cadastro.xls");
?>