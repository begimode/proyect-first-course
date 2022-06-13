<?php 

require './conexion.php';

$newLat = $_POST["latNew"];
$newLng = $_POST["lngNew"];
$latOld = $_GET["lat"];
$lngOld = $_GET["lng"];
$idUsu = $_GET["id"];

if($_SERVER["REQUEST_METHOD"]=="POST")
{
     $sqlNew = "UPDATE `vista_parcelas_con_vertices` SET `lat` = '". $newLat ."', `lng` = '". $newLng  ."' WHERE `lat`= '". $latOld ."' AND `lng`= '". $lngOld ."';";
    
    var_dump($sqlNew);
    $result=mysqli_query($data,$sqlNew);

    if(!$result){
        die("ERROR");
    }
    
    header("location:actualizar.php?id=".$idUsu);

    mysqli_close($data);
}
?>