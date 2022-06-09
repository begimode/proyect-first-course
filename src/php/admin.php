<?php
$sessionTime = 365 * 24 * 60 * 60; // 1 año de duración
session_set_cookie_params($sessionTime);
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
    <script src="../js/atras.js"> </script>
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
            let popUpBox = document.getElementById('popUpBox');
            document.getElementById("popUpOverlay").style.display="flex"
            popUpBox.style.display = "block";
            //Close Modal
            // document.getElementById('closeModal').innerHTML = '<button onclick="ok()" class="boton">OK</button>';
        }

        function cerrar(){
            document.getElementById('popUpBox').style.display = "none";
            document.getElementById('popUpOverlay').style.display = "none";
        }

        // function salir(){
        //     console.log("salir")
        //     location.reload();
        //     <?php
        //         session_destroy();
        //         header("Location: ../html/indice.html");
        //     ?>
        // }


    </script>
<body>
    <section class="cabecera">
        <header class="encabezado" role="banner">
            <a class="logo" href="">
                <img src="../images/logo.png" alt="logo de la empresa" >
            </a>
            <div class="menuHeader">
                <button class="menu" id="menuHamburger" type="button" onclick="menuAbrirCerrar()">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </button>
            </div>
        </header>

        <div class="menuDesplegable" id="menuDesplegable">
            <a href="../php/admin.php">Inicio</a>
            <a href="../html/productos.html">Productos</a>
            <a href="../html/contacto.html">Consultas</a>
            <a href="../html/nosotros.html">Nosotros</a>
        </div>
    </section>

    <p>Lista de usuarios:</p>
    <div class="line"></div>
    <section class="admin_tables">

        <div class="botones_admin">
            <button class="boton" onclick="abrirPopUp()">Añadir usuario</button>
            <button class="boton" ><a href="admin.php?salir=salir">Cerrar sesión</a></button>        </div>

        <ul>
            <div class="form-group pull-right">
                <input type="text" class="search form-control" placeholder="¿A quién buscas?" id="search">
            </div>
            <span class="counter pull-right"></span>
            <table class="table table-hover table-bordered results" id="tablea">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="col-md-5 col-xs-5">Nombre usuario</th>
                    <th class="col-md-4 col-xs-4">Email</th>
                    <th class="col-md-3 col-xs-3 table_parcelas">Parcelas</th>
                    <th class="col-md-3 col-xs-3">Modificar</th>
                </tr>
                <tr class="warning no-result">
                    <td colspan="4"><i class="fa fa-warning"></i> No hay resultados</td>
                </tr>
            </thead>
            <tbody>

                <?php
                
                    $contador[2]=1;
                    $contador[3]=1;
                    $contadorUsu1 = 0;
                    $contadorUsu2 = 0;

                    $data=mysqli_connect($hostdb,$userdb,$passworddb,$db) or die("Error de conexion");

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
                    mysqli_close($data);



                    $data=mysqli_connect($hostdb,$userdb,$passworddb,$db) or die("Error de conexion");

                    if($_SERVER["REQUEST_METHOD"]=="GET")
                    {
                        // $sqlAll="SELECT Usu.id, Usu.nombre, Usu.email, Usu.rol, UsuP.parcela, UsuP.usuario  FROM usuarios Usu INNER JOIN usuarios_parcelas UsuP ON Usu.id = UsuP.usuario";
                        $sql = "SELECT * FROM usuarios";
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
                                    <tr id="fila_tabla">
                                        <th scope="row" ><?php echo $row["id"] ?></th>
                                        <td><?php echo $row["nombre"]; ?></td>
                                        <td><?php echo $row["email"]; ?></td>
                                        <td class="table_parcelas"><?php echo $contador[$aux]; $aux++;?></td>
                                        <td class="modify">
                                            <a href="actualizar.php?id=<?php echo $row["id"];?>" class="editar">Editar</a>
                                            <div class="line_vertical"></div>
                                            <a href="eliminar.php?id=<?php echo $row["id"];?>" class="editar">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                    }
                    mysqli_close($data);
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

    <footer class="footer">
        <a class="flecha_arriba" href="../html/indice.html">
            <img id="flecha_arriba" src="../images/flecha_arriba.png" alt="flecha">
        </a>
        <a class="gti" href="../html/indice.html">
            <img id="logo" src="../images/logo.png" alt="GTI" style="float: left">
        </a>
    </footer>

    <div id="popUpOverlay"></div>
    <div id="popUpBox">
        <div class="cruz">
            <svg onclick="cerrar()" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </div>
        <div id="box">
          <i class="fas fa-check-circle fa-5x"></i>
              <form action="nuevo_usu.php" class="form_nuevo_usu" method="post">
                <div class="nuevo_usu">
                    <div>
                        <p>Usuario:<br></p>
                        <input class="usuario" type="text" name="nombre" placeholder="Ingrese su nombre"><br><br>
                    </div>
                    <div>
                        <p>Email:<br></p>
                        <input class="apellido" type="text" name="email" placeholder="Ingrese su email"><br><br>
                    </div>
                    <div>
                        <p>Rol:<br></p>
                        <select name="rol" class="usuario">
                            <option value="user" selected>user</option>
                            <option value="admin">admin</option>
                        </select>
                        
                        <!-- <input class="apellido" type="text" name="rol" placeholder="Ingrese su rol"><br><br> -->
                    </div>
                    <div>
                        <p>Numero/s de parcelas:<br></p>
                        <input class="apellido" type="text" name="parcelas" placeholder="Ej: 2,3,4 "><br><br>
                    </div>
                    <button class="boton" type="submit">OK</button>
              </form>
          <div id="closeModal">

          </div>
        </div>
    </div>

    <!-- BUSCADOR -->
    <script>
        $(document).ready(function(){
            $("#search").keyup(function(){
            _this = this;
            $.each($("#mytable tbody tr"), function() {
                if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
                });
            });
        });


    </script>
    </body>
</html>
