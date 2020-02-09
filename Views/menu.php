<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="./verTicket.php">
        <input type="submit" name="vticket" value="ver ticket">
    </form>
    <form method="POST" action="./crearTicket.php">
        <input type="submit" name="cticket" value="crear ticket">
    </form>
    <form method="POST" action="../Controllers/Ticket_Controller.php">
        <input type="submit" value="crear usaurio">
    </form>
</body>
</html>