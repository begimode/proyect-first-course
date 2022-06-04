<?php 

session_start();
$hostdb="localhost";
$userdb = "root";
$passworddb = "";
$db = "mapas";
$idUsu = $_GET["id"];

$data=mysqli_connect($hostdb,$userdb,$passworddb,$db) or die("Error de conexion");


$sqlNew = "DELETE FROM usuarios WHERE id = '" . $idUsu . "'";
$result=mysqli_query($data,$sqlNew);

if(!$result){
    die("ERROR");
}
echo "<script>console.log('Hola')</script>";
header("location:admin.php");

mysqli_free_result($result);
mysqli_close($data);

?>