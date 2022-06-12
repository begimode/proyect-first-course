<?php 

require './conexion.php';

$newLat = $_POST["latNew"];
$newLng = $_POST["lngNew"];
$latOld = $_GET["lat"];
$lngOld = $_GET["lng"];
$idUsu = $_GET["id"];

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $sqlNew = "UPDATE vista_parcelas_con_vertices SET lat = '". $newLat ."', lng = '". $newLng ."' WHERE lng= '". $latOld ."' AND lat= '". $lngOld ."'";

    $result=mysqli_query($data,$sqlNew);

    // echo nl2br("newLat");
    // echo $newLat;
    // echo nl2br("newLng");
    // echo $newLng;
    // echo nl2br("newnombreParcelaLat");
    // echo $latOld;
    // echo nl2br("lngOld");
    // echo $lngOld;

    if(!$result){
        die("ERROR");
    }

    // header("location:actualizar.php?id=".$idUsu);
}

mysqli_free_result($result);
mysqli_close($data);

?>