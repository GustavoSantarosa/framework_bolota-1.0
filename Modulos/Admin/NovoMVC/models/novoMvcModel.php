<?php
	
	namespace modulos\Menu\NovoMVC\models;
	use lib\PersistModelAbstract;
	use \PDO;

	/**
	* 
	* @package Menu -> NovoMVC
	* @author  Luis Gustavo Santarosa Pinto
	* @version 1.0.0
	* 
	*/

	class novomvcModel extends PersistModelAbstract{

		private $id;
		private $created_at;
		private $updated_at;
		private $titulo;
		private $conteudo;
		private $status;
		private $p_status;

		function __construct(){
			parent::__construct();

			$this->createTableNovomvc();
		}
		
		public function getId(){
			return $this->id;
		}
	
		public function setId($id){
			$this->id=$id;
			return $this;
		}
	
		public function getCreated_at(){
			return $this->created_at;
		}
	
		public function setCreated_at($created_at){
			$this->created_at=$created_at;
			return $this;
		}
	
		public function getUpdated_at(){
			return $this->updated_at;
		}
	
		public function setUpdated_at($updated_at){
			$this->updated_at=$updated_at;
			return $this;
		}

		public function getTitulo(){
			return $this->titulo;
		}
	
		public function setTitulo($titulo){
			$this->titulo=$titulo;
			return $this;
		}

		public function getConteudo(){
			return $this->conteudo;
		}
	
		public function setConteudo($conteudo){
			$this->conteudo=$conteudo;
			return $this;
		}

		public function getStatus(){
			return $this->status;
		}
	
		public function setStatus($status){
			$this->status=$status;
			return $this;
		}

		public function getP_status(){
			return $this->p_status;
		}
	
		public function setP_status($p_status){
			$this->p_status=$p_status;
			return $this;
		}
		
		/**
		* Retorna um array contendo as novomvc
		* @param string $conteudo_receita
		* @return Array
		*/
		public function _list(){

			$query = $this->pdo->prepare("SELECT 
				ID,
				CREATED_AT,
				UPDATED_AT,
				TITULO,
				CONTEUDO,
				STATUS
			FROM novomvc;");

			$v_novomvc = array();
			try
			{
				$query->execute();
				while($o_ret = $query->fetch (PDO::FETCH_OBJ)){
					$o_novomvc = new novomvcModel();
						$o_novomvc->setId(							$o_ret->ID					);
						$o_novomvc->setCreated_at(					$o_ret->CREATED_AT			);
						$o_novomvc->setUpdated_at(					$o_ret->UPDATED_AT			);
						$o_novomvc->setTitulo(						$o_ret->TITULO				);
						$o_novomvc->setConteudo(					$o_ret->CONTEUDO			);
						$o_novomvc->setStatus(						$o_ret->STATUS				);

					array_push($v_novomvc, $o_novomvc);
				}
			}
			catch (PDOException $erro) 
			{
				$v_novomvc['erro'][] = $erro;
			}

			return $v_novomvc;
		}

		/**
		* Retorna um array contendo as novomvc
		* @param string $conteudo_receita
		* @return Array
		*/
		public function _listAsStatus(){

			$query = $this->pdo->prepare("SELECT 
				ID,				
				CONTEUDO
			FROM novomvc
			WHERE STATUS=1;");

			$v_novomvc = array();
			try
			{
				$query->execute();
				while($o_ret = $query->fetch (PDO::FETCH_OBJ)){
					$o_novomvc = new novomvcModel();
					$o_novomvc->setId(						$o_ret->ID			);
					$o_novomvc->setConteudo(				$o_ret->CONTEUDO	);
	
					array_push($v_novomvc, $o_novomvc);
				}
			}
			catch (PDOException $erro) 
			{
				$v_novomvc['erro'][] = $erro;
			}

			return $v_novomvc;
		}

		/**
		* Retorna os dados de um contato referente
		* a um determinado Id
		* @param integer $in_id
		* @return novomvcModel
		*/
		public function loadById($id){
			$query = $this->pdo->prepare("SELECT * FROM novomvc WHERE ID = :ID;");
			$query->bindValue(":ID", $id);

			$v_Novomvc = array();
			try
			{
				$query->execute();
				$o_ret = $query->fetch (PDO::FETCH_OBJ);
				$this->setId(					$o_ret->ID					);
				$this->setCreated_at(			$o_ret->CREATED_AT			);
				$this->setUpdated_at(			$o_ret->UPDATED_AT			);          
				$this->setTitulo(				$o_ret->TITULO				);          
				$this->setConteudo(				$o_ret->CONTEUDO			);                 
				$this->setStatus(				$o_ret->STATUS				);          
				return $this;    
			}	
			catch (PDOException $erro) 
			{
				return $v_novomvc['erro'][] = $erro;
			}

			
		}

		/**
		* Salva dados contidos na instancia da classe
		* na tabela de contato. Se o ID for passado,
		* um UPDATE será executado, caso contrário, um
		* INSERT será executado
		* @throws PDOException
		* @return integer
		*/
		public function save(){
			if(is_null($this->id)){
				$query = $this->pdo->prepare("INSERT INTO novomvc (
						CREATED_AT, 
						UPDATED_AT,
						TITULO,
						CONTEUDO,
						STATUS)
					VALUES (
						:CREATED_AT, 
						:UPDATED_AT,
						:TITULO,
						:CONTEUDO,
						:STATUS);");
					
				$query->bindValue(":CREATED_AT", 		$this->created_at		);
				$query->bindValue(":UPDATED_AT", 		$this->updated_at		);
				$query->bindValue(":TITULO", 			$this->titulo			);
				$query->bindValue(":CONTEUDO", 			$this->conteudo			);
				$query->bindValue(":STATUS", 			$this->status			);
			}
			else{
				$query = $this->pdo->prepare("UPDATE novomvc SET 
						UPDATED_AT			= :UPDATED_AT,
						TITULO				= :TITULO,
						CONTEUDO			= :CONTEUDO,
						STATUS				= :STATUS
					WHERE ID = :ID;");
					
				$query->bindValue(":UPDATED_AT", 		$this->updated_at		);
				$query->bindValue(":TITULO", 			$this->titulo			);
				$query->bindValue(":CONTEUDO", 			$this->conteudo			);
				$query->bindValue(":STATUS", 			$this->status			);
				$query->bindValue(":ID", 				$this->id				);
			}
			try
			{
				if($query->execute() > 0){
					if(is_null($this->id)){
						$this->setId($this->pdo->lastInsertId());
						return $this->id;
					}
					return $this->id;
				}
			}
			catch (PDOException $e)
			{
				throw $e;
			}
			return false;               
		}

		/**
		* Cria tabela para armazernar os dados de novomvc, caso
		* ela ainda não exista.
		* @throws PDOException
		*/
		private function createTableNovomvc(){
			$query = "CREATE TABLE IF NOT EXISTS novomvc
						(
							ID									INT(40) 		NOT NULL AUTO_INCREMENT,
							CREATED_AT	 						DATETIME		NOT NULL,
							UPDATED_AT				 			DATETIME 		NOT NULL,
							TITULO	 							VARCHAR(100) 	NOT NULL,
							CONTEUDO 							VARCHAR(4000) 	NOT NULL,
							STATUS								VARCHAR(2)		NOT NULL,
							PRIMARY KEY(ID)
						) ENGINE = InnoDB;";
			try{
				$this->pdo->exec($query);
			}
			catch(PDOException $e){
				throw $e;
			}   
		}
	}
?>
