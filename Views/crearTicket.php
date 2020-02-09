<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
    <form method="POST" action="../Controllers/Ticket_Controller.php">
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
        <button type="submit" onclick="window.location.href='./menu.php'">Volver</button>
</body>

</html>