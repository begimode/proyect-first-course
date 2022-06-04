<?php
session_start();
$hostdb="localhost";
$userdb = "root";
$passworddb = "";
$db = "mapas";

$data=mysqli_connect($hostdb,$userdb,$passworddb,$db) or die("Error de conexion");

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username=$_POST["username"];
    $password=$_POST["password"];
    $sql="SELECT * FROM usuarios WHERE nombre='".$username."' AND password='".$password."'";
    $result=mysqli_query($data,$sql);
    $row=mysqli_fetch_array($result);

    if($row["rol"]=="user"){
        $_SESSION['authenticatedU']=true;
        
        header("location: usuario.php?username=".$username."");
    }
    elseif ($row["rol"]=="admin"){
        $_SESSION['authenticatedA']=true;
        header("location: admin.php");
    }
    else{
        echo "ERROR";
    }
}

mysqli_free_result($result);
mysqli_close($data);
?>