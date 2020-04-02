<?php 

namespace lib;

class DataConverter{
	/**
    * Retorna a hora atual
    * @param mixed $tipo
    * @return string
    */
	static function horaatual($tipo){		
		date_default_timezone_set('America/Sao_Paulo');
		if($tipo=="ptbr")
		{
			$date = date('d/m/Y H:i:s');
		}
		
		else if($tipo=="eng")
		{
			$date = date('Y-m-d H:i:s');
		}

		return $date;
	}

	static function convertmoeda($get_valor) {
		$source = array('.', ',');
		$replace = array('', '.');
		$valor = str_replace($source, $replace, $get_valor); 
		return $valor; 
	}

	//definir tipos de horario;
	//Tipo: fulltime/zerotime;
	//Time: Horario;
	static function time($tipo, $time){	
		//fulltime
		if($tipo=="fulltime"){	
			$time = '23:59:59';
		}
		//zerotime
		else if($tipo=="zerotime"){	
			$time = '00:00:00';
		}
		return $time;
	}

	//Mudar data padrão de pais;
	//Time: funtion time()/emptytime;
	//Pattern: PTBR/ENG;
	//Date: data;
	static function dateto($time, $pattern, $date){
		
		if($pattern=='ptbr'){
			
			if($date=='' || $date== '0000-00-00 00:00:00'){
				if($time!='emptytime'){
					$date = '00/00/0000 00:00:00';
				}
				else{
					$date = '00/00/0000';
				}
			}
			else{
				
				list ($ano,$mes,$dia) = explode('-', $date);
				list ($dia, $hora) = explode(' ', $dia);
				if($time!='' && $time!='emptytime'){
					$hora = time($time, $hora);
				}
				$date = $dia.'-'.$mes.'-'.$ano.' '.$hora;
				if($time!='emptytime'){
					$date = date('d/m/Y H:i:s', strtotime($date));
				}
				else{
					$date = date('d/m/Y', strtotime($date));
				}
			}
		}

		else if($pattern=='eng'){
			if($date=='' || $date== '00/00/0000 00:00:00'){
				if($time!='emptytime'){
					$date = '0000-00-00 00:00:00';
				}
				else{
					$date = '0000-00-00';
				}
			}
			else{
				list ($dia,$mes,$ano) = explode('/', $date);
				list ($ano, $hora) = explode(' ', $ano);
				if($time!='' && $time!='emptytime'){
					$hora = time($time, $hora);
				}
				$date = $ano.'-'.$mes.'-'.$dia.' '.$hora;
				
				if($time!='emptytime'){
					$date = date('Y-m-d H:i:s', strtotime($date));
				}
				else{
					$date = date('Y-m-d', strtotime($date));
				}
			}
		}

		return $date;
	}

	//Transformar id para nome;
	//IDFUEL: id_fuel;
	static function fueltransform($idfuel){
		if($idfuel == 1){$idfuel="Gasolina";} 
		else if($idfuel == 2){$idfuel="Alcool";}
		else if($idfuel == 3){$idfuel="Diesel";}
		else if($idfuel == 4){$idfuel="Gás";}
		else if($idfuel == 5){$idfuel="Gasolina/Alcool";}
		else{$idfuel='Sem Registro';}

		return $idfuel;
	}

	//Transformar varial que contem on em uma bola verde e em branco uma bola vermelha;
	//DADOS: on/'';
	static function ball_transform($dados){
		if($dados == 1){$dados="<i class='fa fa-circle text-success'></i>";} 
		else if($dados == ''){$dados="<i class='fa fa-circle text-danger'></i>";}
		
		return $dados;
	}

	//Transformar variavel que contem on em uma bola verde e em branco uma bola vermelha;
	//DADOS: on/'';
	static function obsoleto_transform($dados, $data_produto_obsoleto_config){
		if(($dados != 0) && ($dados > $data_produto_obsoleto_config)){$dados="<span class='label label-danger'>$dados Dias</span>";}
		else{$dados="<span class='label label-success'>$dados Dias</span>";}
		
		return $dados;
	}

	//Transformar variavel que contem o numero em um dos status abaixo.
	//DADOS: numero;
	static function status_pedido_transform($dados){
		if($dados == 0){$dados = "<span class='label label-warning'>Pendente</span>";} 
		else if($dados == 1){$dados = "<span class='label label-success'>	Autorizado	<small>/a</small></span>";}
		else if($dados == 2){$dados = "<span class='label label-info'>		Utilizado	<small>/a</small></span>";}
		else if($dados == 3){$dados = "<span class='label label-danger'>	Cancelado	<small>/a</small></span>";}
		else if($dados == 4){$dados = "<span class='label label-danger'>	Negado		<small>/a</small></span>";}
		else if($dados == 5){$dados = "<span class='label label-info'>		Aberto		<small>/a</small></span>";}
		else if($dados == 6){$dados = "<span class='label label-warning'>	Fechado		<small>/a</small></span>";}
		else if($dados == 6){$dados = "<span class='label label-success'>	Faturado	<small>/a</small></span>";}
		else if($dados == 7){$dados = "<span class='label label-danger'>	Perdido			  			 </span>";}
		else if($dados == 8){$dados = "<span class='label label-warning'>	Executando					 </span>";}
		else if($dados == 9){$dados = "<span class='label label-success'>	Finalizado	<small>/a</small></span>";}
		else if($dados == 10){$dados = "<span class='label label-success'>	Realizado	<small>/a</small></span>";}
		else if($dados == 11){$dados = "<span class='label label-success'>	Concluido	<small>/a</small></span>";}
		else if($dados == 12){$dados = "<span class='label label-warning'>	Pendente	    			 </span>";}
		else if($dados == 13){$dados = "<span class='label label-info'>		Teste						 </span>";}
		else if($dados == 14){$dados = "<span class='label label-warning'>	Analise						 </span>";}
		
		return $dados;
	}

	//Transformar variavel que contem on em uma bola verde e em branco uma bola vermelha;
	//vizualizado: 1/0;
	//descricao que ficara em negrito
	static function vizualizado_transform($vizualizado, $descricao){
		if($vizualizado == 0){$dados="<i class='fa fa-eye-slash'></i> <b>$descricao</b>";} 
		else {$dados=$descricao;}
		
		return $dados;
	}

	//Muda o valor de EN(.00) para PTBR(,00);
	//Valor
	static function transform_valor($valor){
		$dados = number_format($valor, 2, ',', ' ');
		
		return $dados;
	}

	//checa se existe valor;
	//Valor
	static function number_valor($valor){
		if($valor){
			$dados = $valor;
		}else{
			$dados = 0;
		}
		
		return $dados;
	}



}

?>