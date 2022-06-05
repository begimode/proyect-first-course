<?php 

require './conexion.php';
$idUsu = $_GET["id"];

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