<?php
	use modulos\Menu\NovoMVC\models\incidenteModel;
	use modulos\Ajuda\ajuda\models\ajudaModel;
	use lib\DataConverter;
	use lib\DataValidator;
	use lib\View;

	/**
	* 
	* @package Menu -> NovoMVC
	* @author Luis Gustavo Santarosa Pinto
	* @version 1.0.0
	* 
	*/
	
	class novomvcController{
		
		public function listarNovomvc(){
			
			$v_novomvc = array();
			
			$b_novomvc = new novomvcModel();
				foreach ($b_novomvc->_list() as $o_novomvc){
					$o_novomvc->setCreated_at(DataConverter::dateto('', 'ptbr', 		$o_novomvc->getCreated_at()		));
					$o_novomvc->setUpdated_at(DataConverter::dateto('', 'ptbr', 		$o_novomvc->getUpdated_at()		));
					$o_novomvc->setStatus(DataConverter::status_pedido_transform(		$o_novomvc->getStatus()			));
					
					array_push($v_novomvc, $o_novomvc);
				}

			$o_view = new View('views.listar');
			$o_view->setParams(array('v_novomvc' => $v_novomvc));
			$o_view->showContents();
		}

		public function ajudaNovomvc(){

			$o_ajuda = new ajudaModel();
				$o_ajuda->loadByModulo("Admin/novomvc");

			$o_view = new View('views.ajuda');
			$o_view->setParams(array('o_ajuda' => $o_ajuda));
			$o_view->showContents();
		}

		public function ativarNovomvc(){				
			if(isset($_REQUEST['in_con'])){
				if( DataValidator::isNumeric($_REQUEST['in_con']) ){
					$o_novomvcModel = new novomvcModel();
						$o_novomvcModel->loadById($_REQUEST['in_con']);
						$o_novomvcModel->setUpdated_at(DataConverter::horaatual('eng')	);
						$o_novomvcModel->setStatus(									1	);
						$o_novomvcModel->save();
				}
			}

			$this->listarNovomvc();
		}

		public function desativarNovomvc(){				
			if(isset($_REQUEST['in_con'])){
				if( DataValidator::isNumeric($_REQUEST['in_con']) ){
					$o_novomvcModel = new novomvcModel();
						$o_novomvcModel->loadById($_REQUEST['in_con']);
						$o_novomvcModel->setUpdated_at(DataConverter::horaatual('eng')	);
						$o_novomvcModel->setStatus(								''		);
						$o_novomvcModel->save();
				}
			}

			$this->listarNovomvc();
		}

		public function alterarNovomvc(){				
			if(isset($_REQUEST['in_con'])){
				if( DataValidator::isNumeric($_REQUEST['in_con']) ){
					$o_novomvc = new novomvcModel();
						$o_novomvc->loadById($_REQUEST['in_con']);
						$o_novomvc->setCreated_at(DataConverter::dateto('', 'ptbr', 	$o_novomvc->getCreated_at()	));
						$o_novomvc->setUpdated_at(DataConverter::dateto('', 'ptbr',		$o_novomvc->getUpdated_at()	));
						$o_novomvc->setP_status(										$o_novomvc->getStatus()		);
						$o_novomvc->setStatus(DataConverter::status_pedido_transform(	$o_novomvc->getStatus()		));

					$o_view = new View('views.alterar');
					$o_view->setParams(array('o_novomvc' => $o_novomvc));
					$o_view->showContents();
				}
			}
		}

		public function visualizarNovomvc(){				 
			if(isset($_REQUEST['in_con']))
				if( DataValidator::isNumeric($_REQUEST['in_con']) )
					$o_novomvc = new novomvcModel();
						$o_novomvc->loadById($_REQUEST['in_con']);
						$o_novomvc->setCreated_at(DataConverter::dateto('', 'ptbr',	$o_novomvc->getCreated_at()	));
						$o_novomvc->setUpdated_at(DataConverter::dateto('', 'ptbr', 	$o_novomvc->getUpdated_at()	));

			$o_view = new View('views.visualizar');
			$o_view->setParams(array('o_novomvc' => $o_novomvc));
			$o_view->showContents();
		}

		public function inserirNovomvc(){				
			$o_novomvc = new novomvcModel();
			$o_novomvc->setCreated_at(DataConverter::horaatual('ptbr'));

			$o_view = new View('views.inserir');
			$o_view->setParams(array('o_novomvc' => $o_novomvc));
			$o_view->showContents();
		}

		public function saveNovomvc(){
			$o_novomvc = new novomvcModel();

			if( isset($_REQUEST['in_con']) )
				if( DataValidator::isNumeric($_REQUEST['in_con']) )
					$o_novomvc->loadById($_REQUEST['in_con']);
				
			if(count($_POST) > 0){
				$o_novomvc->setFkid_funcionario(								$_POST['fkid_funcionario']	);
				$o_novomvc->setCreated_at(DataConverter::dateto('', 'eng', 		$_POST['created_at']		));
				$o_novomvc->setUpdated_at(DataConverter::horaatual('eng')									);
				$o_novomvc->setTipo(											$_POST['tipo']				);
				$o_novomvc->setTitulo(											$_POST['titulo']			);
				$o_novomvc->setConteudo(										$_POST['conteudo']			);
				$o_novomvc->setStatus(											$_POST['status']			);	
				$o_novomvc->save();

				echo json_encode($o_novomvc);
			}	
		}
	}
?>
