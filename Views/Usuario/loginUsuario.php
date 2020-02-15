<?php
$estado_session = session_status();

if ($estado_session == PHP_SESSION_NONE) {
    session_start();
}
?>

<form method="POST" action="../../Controllers/User_Controller.php">
    Usuario: <input type="text" name="fuser"><br>
    Password: <input type="password" name="fpass"><br>
    <input type="submit" name="fenv" value="Enviar">
</form>