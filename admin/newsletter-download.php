<?php
require('../classe/ExportarExcel.php');
require('../classe/Newsletter.php');

$download = new Newsletter();
$html = $download->geraLisNewsletterDownload();

//Chamando o metodo
ExportarExcel::toXLS($html,"newsletter-institutochoquecultural.xls");
?>