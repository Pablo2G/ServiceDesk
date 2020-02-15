<?php

$estado_session = session_status();

if ($estado_session == PHP_SESSION_NONE) {
	session_start();
}


class UserController
{
	public function __construct()
	{
	}

	public function index()
	{
	}

	public function validarUsuario()
	{
		require_once('../Models/user.php');
		return User::validarUsuario();
	}

	public function crearUsuario()
	{
		require_once('../Models/user.php');
		return User::crearUsuario($_POST['usuario'], $_POST['password'], $_POST['admin']);
	}

	public function listar()
	{
		require_once('../../Models/user.php');
		return user::listar();
	}

	public function borrarUsuario($id)
	{
		require_once('../Models/user.php');
		return user::borrarUsuario($id);
	}

	public function updateUsuario($id, $usuario, $password, $admin)
	{
		require_once('../Models/user.php');
		return User::updateUsuario($id, $usuario, $password, $admin);
	}
}

if (isset($_POST['fenv'])) {
	require_once('../db/connection.php');
	$encontrado = UserController::validarUsuario();

	if ($encontrado) {
		//Pasamos el usuario encontrado
		$_POST['encontrado'] = $encontrado;
		header('Location: ../Views/Plantilla/menu.php');
	} else {
		header('Location: ../Views/Usuario/loginUsuario.php');
	}
}

if (isset($_POST['fcrearusuario'])) {
	require_once('../db/connection.php');
	UserController::crearUsuario();
	header('Location: ../Views/Plantilla/menu.php');
}

if (isset($_POST['vusuarios'])) {
	require_once('../../db/connection.php');
	$encontrado = UserController::listar();
	if ($encontrado) {
		//Pasamos el usuario encontrado
		echo '<table border="1">';
		echo '<tr><td> ID </td>';
		echo '<td> USUARIO </td>';
		echo '<td> PASSWORD </td>';
		echo '<td> TIPO </td>';
		echo '<td> Accion </td></tr>';
		$id;
		$inicio = 1;
		foreach ($encontrado as $ticket) {
			echo '<tr>';
			foreach ($ticket as $campo) {
				echo '<td>' . $campo . '</td>';
				if ($inicio == 1) {
					$id = $campo;
				}
				$inicio = $inicio + 1;
			}
			$inicio = 1;
			echo '<td>';
			echo "<a href='../Usuario/updateUsuario.php?action=update&id=$id'><input type='button' value='Actualizar usuario'></a>";
			echo "<a href='../Usuario/borrarUsuario.php?action=delete&id=$id'><input type='button' value='Borrar usuario'></a>";
			echo '</td></tr>';
		}
		echo '</table>';
	} else {
		echo "no encontrado";
	}
	unset($_POST['vusuarios']);
}

if (isset($_GET["action"])) {
	
	if ($_GET["action"] == "delete") {
		require_once('../db/connection.php');
		$id = (int) $_GET["id"];
		$borrar=UserController::borrarUsuario($id);
		header('Location: ../Views/Plantilla/menu.php');
	
	} else if ($_GET["action"] == "update") {
		require_once('../db/connection.php');
		$id = (int) $_GET["id"];
		$usuario = $_POST["usuario"];
		$password = $_POST["password"];
		$admin = (int) $_POST["admin"];

		$update = UserController::updateUsuario($id, $usuario, $password, $admin);
		header('Location: ../Views/Plantilla/menu.php');
	} else {
		print("error");
	}
}


		/*
        public function createTicket(){
            echo 'Ticket created';
        }

        public function updateTicket(){
            echo 'Ticket updated';
        }        

        public function viewTicket(){
            echo 'Ticked view';
        }

        public function closeTicket(){
            echo 'Ticket closed';
        }

        public function comentaryTicket(){
            echo 'Ticket comentary';
        }
	}
	
	

    //obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
	if (isset($_POST['action'])) {
		$usuarioController= new UserController();
		//se añade el archivo usuario.php
		require_once('../Models/usuario.php');
		
		//se añade el archivo para la conexion
		require_once('../db/connection.php');
 
		if ($_POST['action']=='register') {
			$usuario= new Usuario(null,$_POST['alias'],$_POST['nombres'],$_POST['email']);
			$usuarioController->save($usuario);
		}elseif ($_POST['action']=='update') {
			$usuario= new Usuario($_POST['id'],$_POST['alias'],$_POST['nombres'],$_POST['email']);
			$usuarioController->update($usuario);
		}		
	}
 
	//se verifica que action esté definida
	if (isset($_GET['action'])) {
		if ($_GET['action']!='register'&$_GET['action']!='index') {
			require_once('../db/connection.php');
			$usuarioController=new UserController();
			//para eliminar
			if ($_GET['action']=='delete') {		
				$usuarioController->delete($_GET['id']);
			}elseif ($_GET['action']=='update') {//mostrar la vista update con los datos del registro actualizar
				require_once('../Models/usuario.php');				
				$usuario=Usuario::getById($_GET['id']);		
				//var_dump($usuario);
				//$usuarioController->update();
				require_once('../Views/Usuario/update.php');
			}	
		}	
	}
	*/
