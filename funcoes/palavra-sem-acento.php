<?php
include_once("geral.php");

$resp = criarSlug($_POST['conteudo']);

echo $resp;