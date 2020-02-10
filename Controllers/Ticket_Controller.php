<?php
  session_start();
class TicketController
{
    public function __construct()
    {
    }


    public function listar($usuario)
    {
        require_once('../Models/ticket.php');
        return Ticket::listar($usuario);
    }

    public function crearTicket($usuario,$tipo,$descripcion){
        require_once('../Models/ticket.php');
        return Ticket::crearTicket($usuario,$tipo,$descripcion);
    }
}

if (isset($_POST['vticket'])) {
    $usuario=$_SESSION["usuario"][0]['nombre'];
    require_once('../db/connection.php');
    $encontrado = TicketController::listar($usuario);

    if ($encontrado) {
        //Pasamos el usuario encontrado
        echo '<table border="1">';
        foreach ($encontrado as $ticket) {
            echo '<tr>';
            foreach ($ticket as $campo) {
                echo '<td>' . $campo . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "no encontrado";
    }
    unset($_POST['vticket']);
}

if(isset($_POST['descripcion'])){
    print_r($_SESSION["usuario"]);
    $usuario=$_SESSION["usuario"][0]['nombre'];
    print($usuario);
    $tipo=$_POST['tipo'];
    $descripcion=$_POST['descripcion'];

    require_once('../db/connection.php');
    $creado = TicketController::crearTicket($usuario,$tipo,$descripcion);
    header('Location: ../Views/menu.php');
}
