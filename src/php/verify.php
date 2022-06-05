<?php

require './conexion.php';


$username=$_POST["username"];
$password=$_POST["password"];

if(empty($username) || empty($password)){
    header("location: ../html/login.html");
    exit();
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $sql="SELECT * FROM usuarios WHERE nombre='".$username."' AND password='".$password."'";
    $result=mysqli_query($data,$sql);
    $row=mysqli_fetch_array($result);

    if($row["rol"]=="user"){
        // $_SESSION['authenticatedU']=true;
        $_SESSION['usuario'] = $username;
        header("location: usuario.php?username=".$username."");
    }
    elseif ($row["rol"]=="admin"){
        $_SESSION['admin'] = $username;
        // $_SESSION['authenticatedA']=true;
        header("location: admin.php");
    }
    else{
        // echo "ERROR";
        // $_SESSION['fallo_login'] = 'fallo inicio de sesion, datos incorrectos';//Creamos una nueva variable de sesion
        header("location: ../html/login.html?datos=falsos");
    }
}

mysqli_free_result($result);
mysqli_close($data);
?>