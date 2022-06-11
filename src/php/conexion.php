<?php 

session_start();
$hostdb="localhost";
$userdb = "root";
$passworddb = "";
$db = "mapas";

$data=mysqli_connect($hostdb,$userdb,$passworddb,$db) or die("Error de conexion");



?>