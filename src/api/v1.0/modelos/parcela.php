<?php

die("Texto parcelas");

if(!isset($peticion)) die();

require "../includes/conexion.php";

if($peticion->metodo() === "GET"){


    $paramGet = $peticion->parametrosQuery();
    if(isset($paramGet["usuario"])){
        $sql = "SELECT * FROM `vista_propiedad_parcelas` WHERE `usuario` = " . $paramGet["usuario"]."";

        // $result = mysqli_query($conn, $sql);
        // while ($row = mysqli_fetch_assoc($result)){
        //     array_push( $salida, $row);    
        // }

        $resultado = mysqli_query($conex,$sql);
        // $array_lat_sensor[] = [];
        // $array_lng_sensor[] = [];
        while ($row = mysqli_fetch_assoc($resultado)){
            array_push( $salida, $row);
        }

        json_encode($salida);

        // json_encode($array_lng_sensor); 

        // if($resultado){
        //     while ($row = $resultado->fetch_array()){
        //         $lat_sensor =  $row['lat_sensor'] ;
        //         $lng_sensor = $row['lng_sensor'];
        //         array_push($array_lat_sensor, $lat_sensor);
        //         array_push($array_lng_sensor, $lng_sensor);
        //         json_encode($array_lat_sensor);
        //         json_encode($array_lng_sensor);
        //     }
        // }

    }
    

    $paramPath = $peticion->parametrosPath();
    if(count($paramPath) == 2 && $paramPath[1] == 'vertices') {
        $sql = "SELECT `lat` , `lng` FROM `vertices` WHERE `parcela` = " .$paramPath[0]."";
        $resultado = mysqli_query($conex,$sql);
        $array_lat_area[] = [];
        $array_lng_area[] = [];
        if($resultado){
            while ($row = $resultado->fetch_array()){

                $lat_area =  $row['lat'] ;
                $lng_area = $row['lng'];
                array_push($array_lat_area, $lat_area,$lng_area);
                json_encode($array_lat_area);
            }
        }

        echo "<script>console.log(".$array_lat_area.")</script>"
    }
}



// if($inc){
//     $consulta = "SELECT * FROM posicion,parcelas WHERE parcelas.id_area = posicion.id_area AND parcelas.id_area = 1";
//     $resultado = mysqli_query($conex,$consulta);
//     $array_lat_sensor[]=[];
//     $array_lng_sensor[] = [];
//     if($resultado){
//         while ($row = $resultado->fetch_array()){

//             $lat_sensor =  $row['lat_sensor'] ;
//             $lng_sensor = $row['lng_sensor'];
//             array_push($array_lat_sensor, $lat_sensor);
//             array_push($array_lng_sensor, $lng_sensor);
//             json_encode($array_lat_sensor);
//             json_encode($array_lng_sensor);
//         }
//     }
// }

// if($inc){
//     $consulta = "SELECT lat_area,lng_area FROM parcelas";
//     $resultado = mysqli_query($conex,$consulta);
//     $array_lat_area[]=[];
//     $array_lng_area[] = [];
//     if($resultado){
//         while ($row = $resultado->fetch_array()){

//             $lat_area =  $row['lat_area'] ;
//             $lng_area = $row['lng_area'];
//             array_push($array_lat_area, $lat_area,$lng_area);
//             json_encode($array_lat_area);
//         }
//     }
// }


?>
