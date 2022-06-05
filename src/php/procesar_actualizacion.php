<?php 

require './conexion.php';

$newUser = $_POST["new_usuario"];
$newEmail = $_POST["new_email"];
$idUsu = $_GET["id"];


echo "<script>console.log(".$idUsu.")</script>";
$data=mysqli_connect($hostdb,$userdb,$passworddb,$db) or die("Error de conexion");

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    // $sqlNew = "UPDATE usuarios SET nombre = " . $newUser .", email = " . $newEmail . " WHERE id= " . $idUsu . "";

    $sqlNew = "UPDATE `usuarios` SET nombre = '".$newUser."', email = '".$newEmail."' WHERE id= '" . $idUsu . "'";
    $result=mysqli_query($data,$sqlNew);

    if(!$result){
        die("ERROR");
    }

    header("location:admin.php");
}

mysqli_free_result($result);
mysqli_close($data);
?>