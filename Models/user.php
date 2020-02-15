<?php
//Passmos los valores por sesiones

    $estado_session = session_status();

    if ($estado_session == PHP_SESSION_NONE) {
        session_start();
    }


class User
{
	//atributos
	public $id;
	public $nombre;
	public $password;
	public $admin;

	//constructor de la clase
	function __construct($id, $nombre, $password, $admin)
	{
		$this->id = $id;
		$this->nombre = $nombre;
		$this->password = $password;
		$this->admin = $admin;
	}

	public static function validarUsuario()
	{
		$listaUsuarios = [];
		$db = Db::getConnect();
		$sesion = $_POST["fuser"];
		//print($sesion);
		$sql = $db->query("SELECT * FROM users WHERE name='$sesion'");

		foreach ($sql->fetchAll() as $usuario) {
			$listaUsuarios[] = new User($usuario['id'], $usuario['name'], $usuario['password'], $usuario['admin']);
		}
		//print_r($listaUsuarios);
		if (sizeof($listaUsuarios) == 1) {
			//Convierto el Obejto USER EN UN ARRAY
			$listaUsuarios = json_decode(json_encode($listaUsuarios), true);

			if ($listaUsuarios[0]['nombre'] == $_POST["fuser"] && $listaUsuarios[0]['password'] == $_POST["fpass"]) {
				$_SESSION["usuario"] = $listaUsuarios;
			} else {
				$listaUsuarios = false;
			}
		} else if (sizeof($listaUsuarios) == 0) {
			print("usuario no encontrado");
			$listaUsuarios = false;
		} else {
			print("error mas de un usuario igual");
			$listaUsuarios = false;
		}
		//print_r($listaUsuarios);
		return $listaUsuarios;
	}

	public static function crearUsuario($usuario, $password, $admin)
	{
		$db = Db::getConnect();

		$sql = $db->query("SELECT * FROM users WHERE name='$usuario'");

		$listaUsuarios[] = $sql->fetchAll();
		if (empty($listaUsuarios[0])) {
			//El usuario no existe lo podemos crear
			$insert = $db->prepare('INSERT INTO users VALUES(NULL,:name, :password, :admin)');
			$insert->bindValue('name', $usuario);
			$insert->bindValue('password', $password);
			$insert->bindValue('admin', $admin);
			$insert->execute();
		} else {
			//El usuario ya existe NO LO PODEMOS crear
			print('usuario ya existe no creado');
		}
	}

	public static function listar()
	{
		$listaUsuarios = [];
		$db = Db::getConnect();
		$sql = $db->query('SELECT * FROM users');
		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($sql->fetchAll() as $usuario) {
			$listaUsuarios[] = new User($usuario['id'], $usuario['name'], $usuario['password'], $usuario['admin']);
		}
		return $listaUsuarios;
	}

	public static function updateUsuario($id, $nombre, $password, $admin)
	{
		$db = Db::getConnect();
		$sql = "UPDATE users SET name=?, password=?, admin=? WHERE id=?";
		$update = $db->prepare($sql);
		$update->execute([$nombre, $password, $admin, $id]);
	}

	public static function borrarUsuario($id)
	{
		$db = Db::getConnect();
		$sql = "DELETE FROM users WHERE id=?";
		$update = $db->prepare($sql);
		$update->execute([$id]);
	}
}
