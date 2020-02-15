<?php

$estado_session = session_status();

if ($estado_session == PHP_SESSION_NONE) {
    session_start();
}


class Ticket
{
	//atributos
    public $id;
    public $tipo;
    public $descripcion;
	public $fecha;
	public $technico;
    public $status;
    public $usuario;
 
	//constructor de la clase
	function __construct($id, $tipo, $descripcion, $fecha, $technico, $status, $usuario)
	{
		$this->id=$id;
		$this->tipo=$tipo;
        $this->descripcion=$descripcion;
        $this->fecha=$fecha;
        $this->technico=$technico;
        $this->status=$status;
        $this->usuario=$usuario;
    }
    
    public static function listar($usuario){
        $listaTickets=[];
		$db=Db::getConnect();
		$usuario;
        
        if($usuario=="todo"){
            $sql=$db->query("SELECT * FROM tickets");
        }else{
            $sql=$db->query("SELECT * FROM tickets WHERE users='$usuario'");
        }
		
		foreach($sql->fetchAll() as $ticket) {
			$listaTickets[]= new Ticket($ticket['id'],$ticket['type'], $ticket['description'],$ticket['date'],$ticket['technical'],$ticket['status'],$ticket['users']);
		}
		//print_r($listaUsuarios);
		if(sizeof($listaTickets)>=1){
			//Convierto el Obejto USER EN UN ARRAY
			$listaTickets = json_decode(json_encode($listaTickets),true);
		}else if(sizeof($listaTickets)==0){
			print("usuario no encontrado");
			$listaTickets=false;
        }
		//print_r($listaUsuarios);
        return $listaTickets;
    }

    public static function consultaTicket($usuario,$estado){
        $listaTickets=[];
        $db=Db::getConnect();
        
        if($usuario=="todo"){
            if($estado=="todo"){
                $listaTickets=Ticket::listar("todo");
            }else{
                $sql=$db->query("SELECT * FROM tickets WHERE status='$estado'");
                foreach($sql->fetchAll() as $ticket) {
                    $listaTickets[]= new Ticket($ticket['id'],$ticket['type'], $ticket['description'],$ticket['date'],$ticket['technical'],$ticket['status'],$ticket['users']);
                }
            }
        }else{
            if($estado=="todo"){
                $listaTickets=Ticket::listar("$usuario");
            }else{
                $sql=$db->query("SELECT * FROM tickets WHERE users='$usuario' AND status='$estado'");
                foreach($sql->fetchAll() as $ticket) {
                    $listaTickets[]= new Ticket($ticket['id'],$ticket['type'], $ticket['description'],$ticket['date'],$ticket['technical'],$ticket['status'],$ticket['users']);
                }
            }
        }

        if(sizeof($listaTickets)>=1){
			//Convierto el Obejto USER EN UN ARRAY
			$listaTickets = json_decode(json_encode($listaTickets),true);
		}else if(sizeof($listaTickets)==0){
			print("usuario no encontrado");
			$listaTickets=false;
        }
		//print_r($listaUsuarios);
        return $listaTickets;
    }

    public static function crearTicket($usuario,$tipo,$descripcion){
        $db=Db::getConnect();
        $insert=$db->prepare('INSERT INTO tickets VALUES(NULL, :tipo, :descripcion, :fecha, 0, 0, :usuario)');
        $insert->bindValue('tipo',$tipo);
        $insert->bindValue('descripcion',$descripcion);
        $insert->bindValue('fecha',date('Y-m-j'));
        $insert->bindValue('usuario',$usuario);
        $insert->execute();
    }

    public static function updateTicket($id, $tecnico, $estado){
        $db=Db::getConnect();
        $sql = "UPDATE tickets SET technical=?, status=? WHERE id=?";
        $update= $db->prepare($sql);
        $update->execute([$tecnico, $estado, $id]);
    }
    
    public static function borrarTicket($id){
        $db=Db::getConnect();
        //$sql = "UPDATE users SET name=?, password=?, admin=? WHERE id=?";
        $sql = "DELETE FROM tickets WHERE id=?";
        $update= $db->prepare($sql);
        $update->execute([$id]);
    }
}