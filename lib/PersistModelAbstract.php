<?php

namespace lib;
use \PDO;

/**
 * Classe Abstrata responsável por centralizar a conexão
 * com o banco de dados
 * 
 * @package Exemplo simples com MVC
 * @author DigitalDev
 * @version 0.1.1
 *  
 * Diretório Pai - lib
 * Arquivo - PersistModelAbstract.php
 */
abstract class PersistModelAbstract
{
    /**
    * Variável responsável por guardar dados da conexão do banco
    * @var resource
    */
    protected $pdo;
      
    function __construct()
    {
        try{
            $this->pdo = new PDO(
                DATA_PRODUCAO["driver"] . ":host=" . DATA_PRODUCAO["host"] . ";dbname=" . DATA_PRODUCAO["dbname"] . ";port=" . DATA_PRODUCAO["port"],
                DATA_PRODUCAO["username"],
                DATA_PRODUCAO["passwd"],
                DATA_PRODUCAO["options"]
            );
        }catch(PDOException $e){
            echo $e;
        }
    }
}
?>