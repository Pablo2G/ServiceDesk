<?php
    $estado_session = session_status();

    if ($estado_session == PHP_SESSION_NONE) {
        session_start();
    }
    ?>

<h1>Esta seguro que desea de borrar el ticket</h1>
<form method="POST" action="../../Controllers/Ticket_Controller.php?action=delete&id=<?php print($_GET["id"]);?>">
        <input type="submit" name="fborrar" value="Borrar">
    </form>
<button type="submit" onclick="window.location.href='../Plantilla/menu.php'">Volver</button>