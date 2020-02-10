<?php
    session_start();
?>
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
    <?php
        if($_SESSION["usuario"][0]['admin']==true){
            echo "<form method='POST' action='./crearUsuario.php'>";
            echo "   <input type='submit' value='crear usaurio'>";
            echo "</form>";
        }
    ?>
</body>
</html>