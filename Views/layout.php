<?php
    $estado_session = session_status();

    if ($estado_session == PHP_SESSION_NONE) {
        session_start();
    }
    ?>


<html>

<head>
	<title>ServiceDesk MVC </title>
		<style type="text/css">
		body{background-color: #CEECF5;
		}
		.button {
			background-color: #4CAF50;
			border: none;
			color: white;
			width: 250px;
			padding-top: 100px;
			padding-bottom: 100px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 20px;
			margin: 4px 2px;
			cursor: pointer;
			position: absolute;
			top: 50%; 
  			left: 50%;
 			transform: translate(-50%, -50%);
		}

		.buttondelete {
			background-color: #FE2E2E;
			border: none;
			color: white;
			width: 250px;
			padding-top: 100px;
			padding-bottom: 100px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 20px;
			margin: 4px 2px;
			cursor: pointer;
			top: 50%; 
  			left: 50%;
 			transform: translate(-50%, -50%);
		}
	</style>
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