<?php
session_start();
require './conexion.php';


function salirPhp(){
    session_destroy(); 
    header("Location: ../index.html");
}

if (isset($_GET['salir'])) {
    salirPhp();
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/header_footer.css">
        <title>Document</title>

    </head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/header.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
        $(document).ready(function() {
        $(".search").keyup(function () {
            var searchTerm = $(".search").val();
            var listItem = $('.results tbody').children('tr');
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
            
        $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
                return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
        });
            
        $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','false');
        });

        $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','true');
        });

        var jobCount = $('.results tbody tr[visible="true"]').length;
            $('.counter').text(jobCount + ' item');

        if(jobCount == '0') {$('.no-result').show();}
            else {$('.no-result').hide();}
                });
        });

        function abrirPopUp(){
            let popUpBox = document.getElementById('popUpOverlay');
            document.getElementById("popUpBox").style.display="flex"
            popUpBox.style.display = "block";
            //Close Modal
            // document.getElementById('closeModal').innerHTML = '<button onclick="ok()" class="boton">OK</button>';
        }

        function cerrar(){
            document.getElementById('popUpOverlay').style.display = "none";
            document.getElementById('popUpBox').style.display = "none";
        } 
        
        </script>
<body>
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
            <a href="../index.html">Inicio</a>
            <a href="../html/productos.html">Productos</a>
            <a href="../html/contactos.html">Consultas</a>
            <a href="../html/nosotros.html">Nosotros</a>
        </div>
    </section>

    <p>Lista de usuarios:</p>
    <div class="line"></div>
    <section class="admin_tables">

        <div class="botones_admin">
            <!-- <button class="boton" onclick="abrirPopUp()">Añadir usuario</button> -->
            <button class="boton" ><a href="admin.php?salir=salir">Cerrar sesión</a></button>       
            <button class="boton" onclick="abrirPopUp()">Editar parcelas</button>
        </div>

        <ul>
            <!-- <div class="form-group pull-right">
                <input type="text" class="search form-control" placeholder="¿A quién buscas?" id="search">
            </div> -->
            <span class="counter pull-right"></span>
            <table class="table table-hover table-bordered results" id="tablea">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="col-md-5 col-xs-5">Nombre usuario</th>
                    <th class="col-md-4 col-xs-4">Email</th>
                    <th class="col-md-3 col-xs-3">Modificar</th>
                </tr>
                <!-- <tr class="warning no-result">
                    <td colspan="4"><i class="fa fa-warning"></i> No hay resultados</td>
                </tr> -->
            </thead>
            <tbody>
                
                <?php

                    $contador[2]=0;
                    $contadorUsu1 = 0;
                    $contadorUsu2 = 0;

                    if($_SERVER["REQUEST_METHOD"]=="GET")
                    {
                        $sqlParcelas = "SELECT * FROM usuarios_parcelas";
                        $result=mysqli_query($data,$sqlParcelas);                        

                        while($row=mysqli_fetch_array($result)){

                            if($row["usuario"] == "1"){
                                $contadorUsu1++;

                            } else if($row["usuario" == "2"]){
                                $contadorUsu2++;
                            }
                        }
                    }
                    $contador[0] = $contadorUsu1;
                    $contador[1] = $contadorUsu2;

                    if($_SERVER["REQUEST_METHOD"]=="GET")
                    {
                        // $sqlAll="SELECT Usu.id, Usu.nombre, Usu.email, Usu.rol, UsuP.parcela, UsuP.usuario  FROM usuarios Usu INNER JOIN usuarios_parcelas UsuP ON Usu.id = UsuP.usuario";
                        $sql = "SELECT * FROM usuarios WHERE id = '".$_GET["id"]."'";
                        // $sqlParcelas = "SELECT * FROM usuarios_parcelas";
                        // $resultParcelas = mysqli_query($data, $sqlParcelas);
                        $result=mysqli_query($data,$sql);
                        $aux=0;                        

                        while($row=mysqli_fetch_array($result)){


                            if($row["rol"] == "user"){

                                // --------------------------------------------
                                // SCRIPT PARA CALCULAR PARCELAS
                                // --------------------------------------------
                                ?>
                                <form action="procesar_actualizacion.php?id=<?php echo $row["id"]?>" method="post" accept-charset='UTF-8'>
                                        <tr id="fila_tabla">
                                        <th scope="row" ><?php echo $row["id"] ?></th>
                                        <td> <input type="text" name="new_usuario" value="<?php echo $row["nombre"]; ?>"> </td>
                                        <td> <input type="text" name="new_email" value="<?php echo $row["email"]; ?>"> </td>
                                        <td>
                                            <button type="submit" class="actualizar">Guardar</button> 
                                        </td>
                                    </tr>

                                </form>
                                    
                                <?php
                            }
                        }
                    }
                    echo "<script> 
                    var fila = document.getElementById('fila_tabla')

                    $( 'body' ).on( 'click', 'table tr', function() {
                        //tu codigo cuando se hace click sobre un tr
                        console.log('Hola' + parseInt($(this).parent().index()) + 1)
                      });
                    </script>";

                    ?>
            </tbody>
            </table>
        </ul>
    </section>


    <div id="popUpOverlay"></div>
    <div id="popUpBox">
    <p class="edit_parce">Editar las parcelas del usuarios</p>
    <div class="line"></div>
            <div class="parcela">
                <?php 
                if($_SERVER["REQUEST_METHOD"]=="GET")
                {
                     $sql = "SELECT VPV.lat, VPV.lng, VPV.nombre, V.id FROM vista_parcelas_con_vertices VPV, usuarios_parcelas UP, vertices V WHERE UP.parcela = VPV.id AND V.lat = VPV.lat  AND UP.usuario = '".$_GET["id"]."'";
                   // $sql = "SELECT * FROM vista_parcelas_con_vertices";
                    $result=mysqli_query($data,$sql);

                
                    $aux=0;                 
                    while($row=mysqli_fetch_array($result)){
                        ?>

                        <h6 class="nombre_parcela"><?php echo $row['nombre'] ?></h6>

                            <form action="editarParcela.php?lat=<?php echo $row["lat"]?>&lng=<?php echo $row["lng"];?>&id=<?php echo $_GET["id"];?>" method="POST" accept-charset='UTF-8'>
                                <ul class="puntos">
                                  <span>lat</span><input class="usuario" type="text" name="latNew" value="<?php echo $row["lat"]; ?>"><br>
                                  <span>lng</span><input class="usuario" type="text" name="lngNew" value="<?php echo $row["lng"]; ?>"><br>
                                  <button type="submit" class="boton_edit"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                    </svg></button> 
                                </ul>
                            </form>
                                
                            <?php     
                    }
                }  
                ?>

                <!-- <button class="boton" type="">Guardar</button> -->
                <button class="boton" onclick="cerrar()">Cerrar</button>

            </div>
    </div>

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
