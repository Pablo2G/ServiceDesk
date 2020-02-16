<?php
$estado_session = session_status();

if ($estado_session == PHP_SESSION_NONE) {
    session_start();
}
//Control para ir a index si no sesion iniciada
if ($_SESSION["usuario"][0]['nombre'] == "") {
    header('Location: ../Views/Usuario/cerrarSesion.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="../Ticket/verTicket.php">
        <input type="submit" name="vticket" value="ver ticket">
    </form>
    <form method="POST" action="../Ticket/crearTicket.php">
        <input type="submit" name="cticket" value="crear ticket">
    </form>
    <?php
    if ($_SESSION["usuario"][0]['admin'] == true) {
        echo "<form method='POST' action='../Ticket/adminTicket.php'>";
        echo "   <input type='submit' name='adminTicket' value='Admin Ticket'>";
        echo "</form>";
        echo "<form method='POST' action='../Usuario/crearUsuario.php'>";
        echo "   <input type='submit' value='crear usaurio'>";
        echo "</form>";
        echo "<form method='POST' action='../Usuario/verUsuarios.php'>";
        echo "   <input type='submit' name='vusuarios' value='ver usuarios'>";
        echo "</form>";
    }
    ?>
    <form method="POST" action="../Usuario/cerrarSesion.php">
        <input type="submit" name="cSesion" value="Cerrar Sesion">
    </form>
</body>

</html>