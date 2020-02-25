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

//Control para ir a index si no sesion iniciada
if($_SESSION["usuario"][0]['nombre']==""){
    header('Location: ../Views/Usuario/cerrarSesion.php');
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
	/*//Conectamos a la Base de Datos*/
	require_once('../db/connection.php');
	$db = Db::getConnect();
	
	$id = $_GET["id"];
	
	if ($_GET["action"] == "delete") {
		$borrar=UserController::borrarUsuario($id);
		//Volvemos al menu
		header('Location: ../Views/Plantilla/menu.php');
	} else if ($_GET["action"] == "update") {
		$usuario = $_POST["usuario"];
		$password = $_POST["password"];
		$admin = (int) $_POST["admin"];
		
		//Si el usuario tiene tickets los actualizamos tanto que sea admin y los de usuario
		//Controlo si deja de ser admin pasen a sin asignar
		/*print_r($ticketUsuario);
		if($ticketUsuario!=""){
			//Ticket en la parte de admin
			$sql = "UPDATE tickets SET technical=? WHERE technical=?";
			$stmt = $db->prepare($sql);
			if($admin==1){
				//En los ticket que es admin les cambiamos el nombre
				$stmt->execute([$usuario][$consulUsuario['name']]);
			}else{
				//En los que no es admin los dejo sin asignar
				$stmt->execute(["0"][$consulUsuario['name']]);
			}
			//Ticket en la parte de usuario
			$sql = "UPDATE tickets SET users=? WHERE users=?";
			$stmt = $db->prepare($sql);
			$stmt->execute([$usuario][$consulUsuario['name']]);
		}*/

		$update = UserController::updateUsuario($id, $usuario, $password, $admin);
		//header('Location: ../Views/Plantilla/menu.php');
	} else {
		print("error");
	}
}