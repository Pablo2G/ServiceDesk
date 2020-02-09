<?php

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
		$sesion=$usuario;
		
		$sql=$db->query("SELECT * FROM tickets WHERE users='$sesion'");
		
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

    public static function crearTicket($usuario,$tipo,$descripcion){
        $db=Db::getConnect();
        $db=Db::getConnect();
        $insert=$db->prepare('INSERT INTO tickets VALUES(NULL, :tipo, :descripcion, :fecha, 1, 1, :usuario)');
        $insert->bindValue('tipo',$tipo);
        $insert->bindValue('descripcion',$descripcion);
        $insert->bindValue('fecha',date('j-m-Y'));
        $insert->bindValue('usuario',$usuario);
        $insert->execute();
    }
}