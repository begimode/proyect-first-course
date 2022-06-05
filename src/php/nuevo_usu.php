<?php 

require './conexion.php';
require './tamanyo.php';

            //   if($_SERVER["REQUEST_METHOD"]=="POST")
            //   {
                  
                  $username_new=$_POST["nombre"];
              
                  $email_new=$_POST["email"];
                  $rol_new = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);
                  $parcelas_new=$_POST["parcelas"];


                  $sql = "INSERT INTO `usuarios`(`nombre`, `password`, `email`, `rol`) VALUES ('" . $username_new . "', '1234','" . $email_new . "','" . $rol_new . "')";
                  $result=mysqli_query($data,$sql);

                  if(!$result){
                      echo "ERROR";
                      die("Error de conexion");
                  }

            //   }
                mysqli_close($data);
                echo "<script>conole.log('Cerramos la sesion con la bd')</script>";

                header("location:admin.php");
    ?>