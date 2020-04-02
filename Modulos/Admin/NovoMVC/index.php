<?php

use lib\Application;

/**
* 
* @package Exemplo simples com MVC
* @author Luis Gustavo Santarosa Pinto
* @version 1.0.0
* 
*/
//configurando o PHP para mostrar os erros na tela
ini_set('display_errors', 1);
 
//configurando o PHP para reportar todo e qualquer erro
error_reporting(E_ALL);

require_once 'config.php';

require_once HTDOCS.DS.'autoloader.php';

$o_Application = new Application();
$o_Application->dispatch();
?>