<?php
    
	//función que llama al controlador y su respectiva acción, que son pasados como parámetros
	function call($controller, $action){
        print($controller);
		//importa el controlador desde la carpeta Controllers
		require_once('Controllers/' . $controller . '_Controller.php');
		//crea el controlador
		switch($controller){
			case 'User':
				$controller= new UserController();
				break; 

		}
		//llama a la acción del controlador
		$controller->{$_SESSION["action"] }();
	}

	//array con los controladores y sus respectivas acciones
	$controllers= array(
						'User'=>['index','validarUsuario']
						);
	//verifica que el controlador enviado desde index.php esté dentro del arreglo controllers
	if (array_key_exists($controller, $controllers)) {
		//verifica que el arreglo controllers con la clave que es la variable controller del index exista la acción
		if (in_array($_SESSION["action"], $controllers[$controller])) {
			//llama  la función call y le pasa el controlador a llamar y la acción (método) que está dentro del controlador
			call($controller, $_SESSION["action"]);
		}else{
			call('User', 'error');
		}
	}else{// le pasa el nombre del controlador y la pagina de error
		call('User', 'error');
	}
?>