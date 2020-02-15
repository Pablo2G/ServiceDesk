<?php
$estado_session = session_status();

if ($estado_session == PHP_SESSION_NONE) {
    session_start();
}
?>


<form method="POST" action="../../Controllers/Ticket_Controller.php?action=update&id=<?php print($_GET["id"]); ?>">
    Editar incidencia <br>
    <select name="tecnico" required>
        <?php
        require_once('../../db/connection.php');
        $db = Db::getConnect();
        $sql = $db->query("SELECT * FROM users WHERE admin=1");

        foreach ($sql->fetchAll() as $usuarioAdmin) {
            $usuario = $usuarioAdmin['name'];
            echo "<option value='$usuario'>$usuario";
        }

        ?>
    </select><br>
    Estado<br>
    <select name="estado" required>
        <option value="0">Pendiente
        <option value="1">Solucionado
    </select>
    <input type="submit" name="fupdate" value="Uptade">
</form>
<button type="submit" onclick="window.location.href='../Plantilla/menu.php'">Volver</button>