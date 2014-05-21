<?php
/**
Carrega automaticamente as classes necessárias para manipulação de imagens usando esta biblioteca;
*/

spl_autoload_register(
	function($className){
		$className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
		include($className . ".php");
	}
);
