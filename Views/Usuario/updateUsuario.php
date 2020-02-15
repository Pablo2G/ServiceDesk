<?php
$estado_session = session_status();

if ($estado_session == PHP_SESSION_NONE) {
    session_start();
}
?>
<form method="POST" action="../../Controllers/User_Controller.php?action=update&id=<?php print($_GET["id"]); ?>">
    Usuario:<input type="text" name="usuario" required><br>
    Password:<input type="text" name="password" required><br>
    administrador:
    <select name="admin">
        <option value=0>No</option>
        <option value=1>Si</option>
    </select><br>
    <input type="submit" name="fupdate" value="Uptade">
</form>
<button type="submit" onclick="window.location.href='../Plantilla/menu.php'">Volver</button>