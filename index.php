<?php 
	// la variable controller guarda el nombre del controlador y action guarda la acción por ejemplo registrar 
	//si la variable controller y action son pasadas por la url desde layout.php entran en el if
    require_once('sesion.php');
    //Para mostar menu por defecto!!!!
    if ($_SESSION['controller']=="" && $_SESSION['action']=="") {
		$_SESSION['controller']='User';
		$_SESSION['action']="index";
	}
	//carga la vista layout.php
	require_once('Views/layout.php');
?>