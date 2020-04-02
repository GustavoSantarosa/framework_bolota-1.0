<?php
	class Aautoload {
		function __construct() {
			spl_autoload_extensions('.php');
			spl_autoload_register(array($this, 'load'));
			spl_autoload_register(array($this, 'loadOld'));
			spl_autoload_register(array($this, 'loadclasses'));
		}
		
		function load($className) {
			if($className=="modulos\Admin\projetos\lib\PDO" || $className=="modulos\Admin\projetos\lib\Exception"){
				list ($l, $l, $l, $l, $path) = explode('\\', $className );
				$path="\\".$path;
			}
			
			else{
				$extension = spl_autoload_extensions();
				$path = HTDOCS.DS.$className.$extension;
				$path = str_replace('\\', DS, $path);
			}
			

			if(file_exists($path)){
				//echo "<br>".$path."<---- existe!!";
				require_once $path;
			}
			else{
				//echo "<br>".$path."<---- não existe!!";
			}
		}

		private function loadOld($className) {
			$extension = spl_autoload_extensions();
			$ds= DIRECTORY_SEPARATOR;
			$fullpath = __DIR__.$ds."class_".$className.$extension;
			$path = __DIR__.$ds.$className.$extension;

			if(file_exists($fullpath)){
				require_once $fullpath;
			}
			else if(file_exists($path)){
				require_once $path;
			}
			else{//echo "<br><b>class_", $className, "</b> --- Não carregada!!";
			}
		}

		private function loadclasses($className) {
			$extension = spl_autoload_extensions();
			$ds= DIRECTORY_SEPARATOR;
			$fullpath = __DIR__.$ds."classes".$ds."class_".$className.$extension;

			if(file_exists($fullpath)){
				require_once $fullpath;
			}
			else{//echo "<br><b>class_", $className, "</b> --- Não carregada!!";
			}
		}
	}
	$autoloader = new Aautoload();
?>