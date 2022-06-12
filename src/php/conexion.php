<?php 

$hostdb="localhost";
$userdb = "root";
$passworddb = "";
$db = "gti-proyecto-primero";
// $db = "mapas";

$data=mysqli_connect($hostdb,$userdb,$passworddb,$db) or die("Error de conexion");

// Chequear la conexión
if (!$data) {
    die("Error: " . mysqli_connect_error());
}


?>