<?php
    class UserController
    {
        public function __construct(){}
        
		public function index(){
			
		}
		
		public function validarUsuario(){
			require_once('../Models/user.php');
			return User::validarUsuario();
		}
		
	}

	if(isset($_POST['fenv'])){
		require_once('../db/connection.php');
		$encontrado=UserController::validarUsuario();
		
		if($encontrado){
			//Pasamos el usuario encontrado
			$_POST['encontrado']=$encontrado;
			header('Location: ../Views/menu.php');
		}else{
			header('Location: ../Views/loginUsuario.php');
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
?>