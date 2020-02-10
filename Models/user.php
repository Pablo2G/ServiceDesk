<?php
//Passmos los valores por sesiones
session_start();
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
		$this->id=$id;
		$this->nombre=$nombre;
		$this->password=$password;
		$this->admin=$admin;
	}
	
	public static function validarUsuario(){
		$listaUsuarios=[];
		$db=Db::getConnect();
		$sesion=$_POST["fuser"];
		//print($sesion);
		$sql=$db->query("SELECT * FROM users WHERE name='$sesion'");
		
		foreach($sql->fetchAll() as $usuario) {
			$listaUsuarios[]= new User($usuario['id'],$usuario['name'], $usuario['password'],$usuario['admin']);
		}
		//print_r($listaUsuarios);
		if(sizeof($listaUsuarios)==1){
			//Convierto el Obejto USER EN UN ARRAY
			$listaUsuarios = json_decode(json_encode($listaUsuarios),true);
			
			if($listaUsuarios[0]['nombre']==$_POST["fuser"] || $listaUsuarios[0]['password']==$_POST["fpass"]){
				print('llega');
				$_SESSION["usuario"]=$listaUsuarios;
				print_r($_SESSION["usuario"]);
			}else{
				$listaUsuarios=false;	
			}

	


		}else if(sizeof($listaUsuarios)==0){
			print("usuario no encontrado");
			$listaUsuarios=false;
		}else{
			print("error mas de un usuario igual");
			$listaUsuarios=false;
		}
		//print_r($listaUsuarios);
		return $listaUsuarios;
	}
	
	
	
	
	/*
	//función para obtener todos los usuarios
	public static function all(){
		$listaUsuarios =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM usuarios');
 
		// carga en la $listaUsuarios cada registro desde la base de datos
		 ($sql->fforeachetchAll() as $usuario) {
			$listaUsuarios[]= new Usuario($usuario['id'],$usuario['alias'], $usuario['nombres'],$usuario['email']);
		}
		return $listaUsuarios;
	}
 
	//la función para registrar un usuario
	public static function save($usuario){
			$db=Db::getConnect();
			$insert=$db->prepare('INSERT INTO USUARIOS VALUES(NULL,:alias,:nombres, :email)');
			$insert->bindValue('alias',$usuario->alias);
			$insert->bindValue('nombres',$usuario->nombres);
			$insert->bindValue('email',$usuario->email);
			$insert->execute();
		}
 
	//la función para actualizar 
	public static function update($usuario){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE usuarios SET alias=:alias, nombres=:nombres, email=:email WHERE id=:id');
		$update->bindValue('id',$usuario->id);
		$update->bindValue('alias',$usuario->alias);
		$update->bindValue('nombres',$usuario->nombres);
		$update->bindValue('email',$usuario->email);
		$update->execute();
	}
 
	// la función para eliminar por el id
	public static function delete($id){
		$db=Db::getConnect();
		$delete=$db->prepare('DELETE FROM usuarios WHERE ID=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}
 
	//la función para obtener un usuario por el id
	public static function getById($id){
		//buscar
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM usuarios WHERE ID=:id');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto usuario
		$usuarioDb=$select->fetch();
		$usuario= new Usuario($usuarioDb['id'],$usuarioDb['alias'],$usuarioDb['nombres'],$usuarioDb['email']);
		return $usuario;
	}*/
}
?>