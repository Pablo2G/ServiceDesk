<?php
$estado_session = session_status();

if ($estado_session == PHP_SESSION_NONE) {
    session_start();
    $_SESSION["Vista"]="";
    $_SESSION["controller"]="";
    $_SESSION["action"]="";
    $_SESSION["usuario"]="";
}
$_SESSION["Vista"]="";
$_SESSION["controller"]="";
$_SESSION["action"]="";
$_SESSION["usuario"]="";
header('Location: ../../index.php');
?>