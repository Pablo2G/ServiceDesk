<?php
$estado_session = session_status();

if ($estado_session == PHP_SESSION_NONE) {
    session_start();
}
?>

<h1>Esta seguro que desea de borrar el usuario</h1>
<h1>Todos los tiquets del usuario seran borrados</h1>
<form method="POST" action="../../Controllers/User_Controller.php?action=delete&id=<?php print($_GET["id"]); ?>">
    <input type="submit" name="fborrar" value="Borrar">
</form>
<button type="submit" onclick="window.location.href='../Plantilla/menu.php'">Volver</button>