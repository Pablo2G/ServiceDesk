<?php

$estado_session = session_status();

if ($estado_session == PHP_SESSION_NONE) {
    session_start();
}


class TicketController
{
    public function __construct()
    {
    }


    public function listar($usuario)
    {
        require_once('../../Models/ticket.php');
        return Ticket::listar($usuario);
    }

    public function crearTicket($usuario, $tipo, $descripcion)
    {
        require_once('../Models/ticket.php');
        return Ticket::crearTicket($usuario, $tipo, $descripcion);
    }

    public function updateTicket($id, $tecnico, $estado)
    {
        require_once('../Models/ticket.php');
        return Ticket::updateTicket($id, $tecnico, $estado);
    }

    public function borrarTicket($id)
    {
        require_once('../Models/ticket.php');
        return Ticket::borrarTicket($id);
    }

    public function consultaTicket($usuario, $estado)
    {
        require_once('../Models/ticket.php');
        return Ticket::consultaTicket($usuario, $estado);
    }

    //Funcion creada para imprimir los ticket en caso de no se devuelva false
    public function imprimirTicket($vectorTicket)
    {
        //La funcion que lo implementa devulve false o un ticket
        if ($vectorTicket) {
            //Pasamos el usuario encontrado
            echo '<table border="1">';
            echo '<tr><td> ID </td>';
            echo '<td> TIPO </td>';
            echo '<td> DESCRIPCION </td>';
            echo '<td> FECHA </td>';
            echo '<td> TECNICO </td>';
            echo '<td> ESTADO </td>';
            echo '<td> CREADO POR </td>';
            //Imprimir solo si es administrador
            if ($_SESSION["usuario"][0]['admin'] == 1) {
                echo '<td> ACCION </td>';
            }
            echo '</tr>';
            $id = "";
            $inicio = 1;
            foreach ($vectorTicket as $ticket) {
                echo '<tr>';
                foreach ($ticket as $campo) {
                    if ($inicio != 6) {
                        echo '<td>' . $campo . '</td>';
                        if ($inicio == 1) {
                            $id = $campo;
                        }
                    } else {
                        if ($campo == 0) {
                            echo '<td> OK </td>';
                        } else if ($campo == 1) {
                            echo '<td> PENDIENTE </td>';
                        }
                    }
                    $inicio = $inicio + 1;
                }
                $inicio = 1;
                //Imprimir solo si es administrador
                if ($_SESSION["usuario"][0]['admin'] == 1) {
                    echo '<td>';
                    echo "<a href='../Ticket/updateTicket.php?action=update&id=$id'><input type='button' value='Actualizar Ticket'></a>";
                    echo "<a href='../Ticket/borrarTicket.php?action=delete&id=$id'><input type='button' value='Borrar Ticket'></a>";
                    echo '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "no encontrado";
        }
    }
}

//Control para ir a index si no sesion iniciada
if ($_SESSION["usuario"][0]['nombre'] == "") {
    header('Location: ../Views/Usuario/cerrarSesion.php');
}

//Ver Ticker Usuario
if (isset($_POST['vticket'])) {
    $usuario = $_SESSION["usuario"][0]['nombre'];
    require_once('../../db/connection.php');
    $encontrado = TicketController::listar($usuario);
    TicketController::imprimirTicket($encontrado);

    unset($_POST['vticket']);
}

//Crear Ticket
if (isset($_POST['descripcion'])) {
    print_r($_SESSION["usuario"]);
    $usuario = $_SESSION["usuario"][0]['nombre'];
    print($usuario);
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];

    require_once('../db/connection.php');
    $creado = TicketController::crearTicket($usuario, $tipo, $descripcion);
    header('Location: ../Views/Plantilla/menu.php');
}

//Borrar-Actualizar Ticket
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        require_once('../db/connection.php');
        $id = (int) $_GET["id"];
        $borrar = TicketController::borrarTicket($id);
        header('Location: ../Views/Plantilla/menu.php');
    } else if ($_GET["action"] == "update") {
        require_once('../db/connection.php');
        $id = (int) $_GET["id"];
        $tecnico = $_POST["tecnico"];
        $estado = $_POST["estado"];

        $update = ticketController::updateticket($id, $tecnico, $estado);
        header('Location: ../Views/Plantilla/menu.php');
    } else {
        print("error");
    }
}

//Consulta de datos para Admin
if (isset($_POST["fconsulta"])) {
    require_once('../db/connection.php');
    $usuario = $_POST["tecnico"];
    $estado = $_POST["estado"];
    $encontrado = TicketController::consultaTicket($usuario, $estado);
    TicketController::imprimirTicket($encontrado);
}
