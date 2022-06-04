<?php 

$hostdb="localhost";
$userdb = "root";
$passworddb = "";
$db = "mapas";

              $data=mysqli_connect($hostdb,$userdb,$passworddb,$db) or die("Error de conexion");

            //   if($_SERVER["REQUEST_METHOD"]=="POST")
            //   {
                  
                  $username_new=$_POST["nombre"];
                  $id_new = $_POST["id"];
                  $email_new=$_POST["email"];
                  $rol_new=$_POST["rol"];
                  $parcelas_new=$_POST["parcelas"];

                  echo "<script>conole.log('Despues de definir variables')</script>";
                  $sql = "INSERT INTO `usuarios`(`id` ,`nombre`, `password`, `email`, `rol`) VALUES ('" . $id_new . "',' " . $username_new . "', '1234','" . $email_new . "','" . $rol_new . "')";

                  echo "<script>conole.log('Despues de la consulta a bd')</script>";

                  $result=mysqli_query($data,$sql);

                  echo "<script>conole.log('Despues de eviar la consulta')</script>";


                  if(!$result){
                      echo "ERROR";
                      die("Error de conexion");
                  }

            //   }
                mysqli_close($data);
                echo "<script>conole.log('Cerramos la sesion con la bd')</script>";

                header("location:admin.php");
    ?>