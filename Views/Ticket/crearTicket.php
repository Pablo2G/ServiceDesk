<?php
$estado_session = session_status();

if ($estado_session == PHP_SESSION_NONE) {
    session_start();
}
?>

<form method="POST" action="../../Controllers/Ticket_Controller.php">
    Tipo de incidencia <br>
    <select name="tipo" required>
        <option value="Equipos">Equipos
        <option value="Sistema Operativo">Sistema Opertivo
        <option value="Software">Software
        <option value="Otro">Otro
    </select><br>
    Descripcion<br>
    <textarea name="descripcion" required></textarea><br>
    <input type="submit" name="cTicket" value="Nuevo Ticket">
</form>
<button type="submit" onclick="window.location.href='../Plantilla/menu.php'">Volver</button>