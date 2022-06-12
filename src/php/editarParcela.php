<?php 

require './conexion.php';

$newLat = $_POST["latNew"];
$newLng = $_POST["lngNew"];
$latOld = $_GET["lat"];
$lngOld = $_GET["lng"];
$idUsu = $_GET["id"];

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $sqlNew = "UPDATE `vista_parcelas_con_vertices` SET lat = '". floatval($newLat) ."', lng = '".floatval($newLng)  ."' WHERE lng= '". floatval($latOld) ."' AND lat= '". floatval($lngOld) ."'";
    $result=mysqli_query($data,$sqlNew);

    if(!$result){
        die("ERROR");
    }


    echo $result;
    // if (!mysqli_query($data, $result)) {
    //     print_r(mysqli_error($data));
    // }

    // header("location:actualizar.php?id=".$idUsu);

    // mysqli_free_result($result);
    // mysqli_close($data);
    // $result->close();
    $mysqli->close();
}

?>