<?php
function login(){
    session_start();
    $hostdb="localhost:8080";
    $userdb = "root";
    $passworddb = "";
    $db = "mapas";

    $data=mysqli_connect($hostdb,$userdb,$passworddb,$db);

    if ($data==false){
        die("Error de conexion");
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    }

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $username=$_POST["username"];
        $password=$_POST["password"];
        $sql="SELECT * FROM usuarios WHERE nombre='".$username."' AND password='".$password."'";
        $result=mysqli_query($data,$sql);
        $row=mysqli_fetch_array($result);

        if($row["rol"]=="user"){
            $_SESSION['authenticatedU']=true;
            header("location: usuario.php");
        }
        elseif ($row["rol"]=="admin"){
            $_SESSION['authenticatedA']=true;
            header("location: admin.php");
        }
        else{
            echo "ERROR";
        }
        mysqli_free_result($result);
        mysqli_close($data);
    }   
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/header_footer.css">
    <title>Document</title>
    <script src="../js/header.js"></script>

</head>
<body id="bodyLogin">

    <!-- HEADER -->
    <section class="cabecera">
        <header class="encabezado" role="banner">
            <a class="logo" href="../html/indice.html">
                <img src="../images/logo.png" alt="logo de la empresa" >
            </a>
            <div class="menuHeader">
                <a class="login" href="../html/login.html" >
                    <img src="../images/icono_login.png" alt="logo registrarse" href="../html/login.html">
                </a>
                <button class="menu" id="menuHamburger" type="button" onclick="menuAbrirCerrar()">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </button>
            </div>
        </header>

        <div class="menuDesplegable" id="menuDesplegable">
            <a href="../html/indice.html">Inicio</a>
            <a href="../html/indice.html">Productos</a>
            <a href="../html/indice.html">Consultas</a>
            <a href="../html/indice.html">Nosotros</a>
        </div>
    </section>

<div class="cajafuera">
    <div class="foto_login">
        <img src="../images/login-otp-banner.png" alt="login image">
    </div>
     <div class="caja">
        <form action="" method="post" accept-charset='UTF-8'>
            <h5>Iniciar sesión</h5>
            <div class="line"></div>
            <div class="datosUsuario">
                <p>Usuario:<br></p>
                <input class="usuario" type="text" name="username" placeholder="Nombre de usuario"><br><br>
                <p>Contraseña:<br></p>
                <input class="pass" type="password" name="password" placeholder="Escriba su contraseña"><br><br>
                <input class="boton" id="boton" type="submit" name="submit" value="Acceder" onclick="login()">
            </div>
            <p class="olvidar"><a href="#">¿Has olvidado la contraseña?</a></p>
            <div class="line"></div>
        </form>
    </div>
</div>
   
<!-- FOOTER -->
    <footer class="footer">
        <a class="flecha_arriba" href="../html/indice.html">
            <img id="flecha_arriba" src="../images/flecha_arriba.png" alt="flecha">
        </a>
        <a class="gti" href="../html/indice.html">
            <img id="logo" src="../images/logo.png" alt="GTI" style="float: left">
        </a>      
    </footer>
</body>
</html>