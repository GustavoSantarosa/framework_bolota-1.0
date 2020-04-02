<?php

/*
|--------------------------------------------------------------------------
| Data Layer
|--------------------------------------------------------------------------
|
| Aqui existem as configurações com o banco de dados.
|
*/
define("DATA_PRODUCAO", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "datalayer_example",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_PERSISTENT => true
    ]
]);

define("DATA_HOMOLOGACAO", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "datalayer_example",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_PERSISTENT => true
    ]
]);

/*
|--------------------------------------------------------------------------
| Pastas
|--------------------------------------------------------------------------
|
| Aqui é padronizado as pastas.
|
*/

define('HTDOCS', dirname(dirname(__DIR__), 2));

/*
|--------------------------------------------------------------------------
| Outros
|--------------------------------------------------------------------------
|
| Aqui existem outros defines.
|
*/

define('DS', DIRECTORY_SEPARATOR);
?>