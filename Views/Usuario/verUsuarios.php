<?php
$estado_session = session_status();
if ($estado_session == PHP_SESSION_NONE) {
    session_start();
}

require_once('../../Controllers/User_Controller.php');
?>
<button type="submit" onclick="window.location.href='../Plantilla/menu.php'">Volver</button>