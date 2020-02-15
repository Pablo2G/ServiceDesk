<?php
    $estado_session = session_status();

    if ($estado_session == PHP_SESSION_NONE) {
        session_start();
    }
    ?>


<html>

<head>
	<title>ServiceDesk MVC </title>
</head>

<body>
	<?php
	
    //require_once('sesion.php');
    //print($_SESSION["Vista"]);
    //$_SESSION["Vista"]="login";

	//Pintamos Siempre la cabecera
	//require_once('Plantilla/cabecera.php');

	switch ($_SESSION["Vista"]) {
		case "index":
			require_once('Plantilla/inicio.php');
			break;
		case "login":
			require_once('Usuario/loginUsuario.php');
			break;
	}

	//Pintamos siempre el Footer
	//require_once('Plantilla/footer.php');
	?>

	<?php require_once('./routes.php'); ?>

</body>

</html>