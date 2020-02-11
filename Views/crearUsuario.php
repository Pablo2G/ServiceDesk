<?php
    session_start();
    if($_SESSION["usuario"][0]['admin']==false){
        header('Location: ../Views/loginUsuario.php');
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
    <form method="POST" action="../Controllers/User_Controller.php">
        Usuario:<input type="text" name="usuario" required><br>
        Password:<input type="text" name="password" required><br>
        administrador:
        <select name="admin">
            <option value=0>No</option>
            <option value=1>Si</option>
        </select><br>
        <input type="submit" name="fcrearusuario" value="crear">
    </form>
    <button type="submit" onclick="window.location.href='./menu.php'">Volver</button>
</body>
</html>