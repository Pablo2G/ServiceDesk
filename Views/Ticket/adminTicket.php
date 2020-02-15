<?php
$estado_session = session_status();

if ($estado_session == PHP_SESSION_NONE) {
    session_start();
}
?>


<form method="POST" action="../../Controllers/Ticket_Controller.php">
    BUSCAR TIPO DE INCIDENCIA <br>
    <select name="tecnico" required>
        <option value='todo'>TODOS
        <?php
        require_once('../../db/connection.php');
        $db = Db::getConnect();
        $sql = $db->query("SELECT * FROM users");

        foreach ($sql->fetchAll() as $usuario) {
            $usu = $usuario['name'];
            echo "<option value='$usu'>$usu";
        }

        ?>
    </select><br>
    Estado<br>
    <select name="estado" required>
        <option value='todo'>Cualquiera
        <option value="0">Pendiente
        <option value="1">Solucionado
    </select>
    <br>
    <input type="submit" name="fconsulta" value="Consultar">
</form>
<button type="submit" onclick="window.location.href='../Plantilla/menu.php'">Volver</button>