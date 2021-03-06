<?php

$sessionTime = 365 * 24 * 60 * 60; // 1 año de duración
session_set_cookie_params($sessionTime);
session_start();

// if(!isset($_SESSION['usuario']]){
//     header("Location: ../index.html");
// }


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
    <link rel="stylesheet" href="../css/usuario.css">
    <link rel="stylesheet" href="../css/header_footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../css/usuario.css">

    <title>Página del usuario nº1</title>
</head>
<body>
    <script src="../js/header.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?&callback=initMap" async defer></script>


    <!-- <script>
        let map;
        let parcelas;
        var marker;

        async function initMap() {

            let urlParams = new URLSearchParams(window.location.search);
            let usuario = urlParams.get("usuario");
            if(!usuario) usuario = 1;
            
            let consulta = await fetch("../api/v1.0/parcela?usuario="+usuario);
            parcelas = await consulta.json();
            console.log(parcelas);    
            crearSelector();
            
            map = new google.maps.Map(document.getElementById('mapa'), {
                center: {lat: 38.9965055, lng: -0.1674364},
                zoom: 15,
                mapTypeId: 'hybrid',
                styles: [
                {
                featureType: 'poi',
                stylers: [{visibility: 'off'}]
                },
                {
                featureType: 'transit',
                stylers: [{visibility: 'off'}]
                },
                ],
                mapTypeControl: false,
                streetViewControl: false,
                rotateControl: false,
            });

            map.setTilt(0);
  
            let bounds = new google.maps.LatLngBounds();

            // map.fitBounds(bounds);
            

            for(var i=0; i < parcelas.length; i++){
                marker = new google.maps.Marker({
                    position: {lat: parseFloat(parcelas[i].lat), lng: parseFloat(parcelas[i].lng)},
                    label: {text:(i+1).toString(), color: "#fff"},
                    animation: google.maps.Animation.DROP,
                    map: map,
                    icon: pinSymbol("#e91e63")
                });
            }
          
        }
        
        function pinSymbol(color) {
            return {
                path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
                fillColor: color,
                fillOpacity: 1,
                strokeColor: '#ffffff',
                strokeWeight: 1,
                scale: 1,
            };
        }

         function abrirMapas(){
            document.getElementById("chart-container").style.display = "flex"
            document.getElementById("texto_parcela").style.display = "none"
        } 
       
        function crearSelector() {
            let selector = document.getElementById("selector-parcelas")
            var aux=0;
            for(var i=0; i<2; i++){
                let label = document.createElement('label');
                label.textContent = parcelas[aux].nombre;
                let check = document.createElement('input');
                check.type = 'checkbox';
                check.addEventListener('change', function() {
                    mostrarOcultarParcela(aux , check.checked);
                })
                label.prepend(check)
                selector.append(label);
                aux = 4;
            }
        }

        async function crearPoligono(parcela) {
            let id = parcela.id;
            let consulta = await fetch("../api/v1.0/parcela/" + id + "/vertices");
            let vertices = await consulta.json();
            parcela.polygon = new google.maps.Polygon({
                paths: vertices,
                strokeColor: "#" + parcela.color,
                strokeOpacity: 0.8,
                strokeWeight: 1,
                fillColor: "#" + parcela.color,
                fillOpacity: 0.35,
                map: map
            });
        }

        async function mostrarOcultarParcela(index, mostrar) {
            let parcela = parcelas[index];
            if(mostrar) {
                // if(parcela.polygon) {
                //     parcela.polygon.setMap(map);
                // } else {
                   var a = await crearPoligono(parcela);
                // }
            } else {
                // if(parcela.polygon) parcela.polygon.setMap(null);
            }
            
        }
        ajustarMapa()
        function ajustarMapa() {
            let bounds = new google.maps.LatLngBounds();
            parcelas.forEach(function(parcela) {
                if(parcela.polygon && parcela.polygon.getMap()) {
                    parcela.polygon.getPath().getArray().forEach(function (v) {
                        bounds.extend(v);
                    })
                }
            })
            if(!bounds.isEmpty()) map.fitBounds(bounds);
        }

    </script>    	 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/luxon@2.4.0/build/global/luxon.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.1.0/dist/chartjs-adapter-luxon.min.js"></script>

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
            <a href="../php/usuario.php">Inicio</a>
            <a href="../html/productos.html">Productos</a>
            <a href="../html/contacto.html">Consultas</a>
            <a href="../html/nosotros.html">Nosotros</a>
        </div>
    </section>

    <button class="boton" ><a href="usuario.php?salir=salir">Cerrar sesión</a></button>

    <section class="data_user">
        <h3>Hola, <span id=""><?php echo $_GET["username"]; ?></span></h3>
        <div class="line" id="line"></div>
        <div id="mapa" onclick="abrirMapas()"></div>
        <div id="selector-parcelas"></div>
       
    <script>
        let map;
        let parcelas;
        async function initMap() {

            let urlParams = new URLSearchParams(window.location.search);
            let usuario = urlParams.get("username");
            let parcela = urlParams.get("parcela");
            
            if(usuario) {
                obtenerParcelasUsuario(usuario);
            } else if (parcela) {
                obtenerParcela(parcela)
            } else {
                obtenerParcelasUsuario(1)
            }
        }

        function abrirMapas(){
            document.getElementById("chart-container").style.display = "flex"
            document.getElementById("texto_parcela").style.display = "none"
        } 
            
        function crearMapa() {
            map = new google.maps.Map(document.getElementById('mapa'), {
                center: {lat: 39.9965055, lng: -0.1674364},
                zoom: 18,
                mapTypeId: 'hybrid',
                styles: [
                    {
                        featureType: 'poi',
                        stylers: [{visibility: 'off'}]
                    },
                    {
                        featureType: 'transit',
                        stylers: [{visibility: 'off'}]
                    }
                ],
                mapTypeControl: false,
                streetViewControl: false,
                rotateControl: false,
                });
        }
        

        async function obtenerParcela(parcela) {
        crearMapa();
        let consulta = await fetch("../api/v1.0/parcela/" + parcela);
        parcelas = [];
        parcelas[0] = await consulta.json();
        await crearPoligono(parcelas[0]);
        ajustarMapa();
        }
        
        async function obtenerParcelasUsuario(usuario) {
            let consulta = await fetch("../api/v1.0/parcela?usuario="+usuario);
            parcelas = await consulta.json();
            crearSelector();
            crearMapa();
        }

        function crearSelector() {
            let selector = document.getElementById("selector-parcelas")
            parcelas.forEach(function (parcela, index) {
                let label = document.createElement('label');
                label.textContent = parcela.nombre_parcela;
                let check = document.createElement('input');
                check.type = 'checkbox';
                check.addEventListener('change', function() {
                    mostrarOcultarParcela(index , check.checked);
                })
                label.prepend(check)
                selector.append(label);
            })
        }

        async function crearPoligono(parcela) {
            let id = parcela.parcela || parcela.id;
            let consulta = await fetch("../api/v1.0/parcela/" + id + "/vertices");
            let vertices = await consulta.json();
            parcela.polygon = new google.maps.Polygon({
                paths: vertices,
                strokeColor: "#" + parcela.color,
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#" + parcela.color,
                fillOpacity: 0.35,
                map: map
            });
        }

        async function mostrarOcultarParcela(index, mostrar) {
        let parcela = parcelas[index];
        if (mostrar) {
            if (parcela.polygon) {
                parcela.polygon.setMap(map);
            } else {
                await crearPoligono(parcela);
            }
        } else {
            if (parcela.polygon) parcela.polygon.setMap(null);
        }
        ajustarMapa();
    }
        
        function ajustarMapa() {
            let bounds = new google.maps.LatLngBounds();
            parcelas.forEach(function(parcela) {
                if(parcela.polygon && parcela.polygon.getMap()) {
                    parcela.polygon.getPath().getArray().forEach(function (v) {
                        bounds.extend(v);
                    })
                }
            })
            if(!bounds.isEmpty()) map.fitBounds(bounds);
        }

    </script>
        <div id="selector-parcelas"></div>
        <p>Sondas instaladas:</p>
        <div class="line"></div>
        <div class="texto_pinch text-center" id="texto_parcela">
            Elige la parcela para ver las graficas
        </div>

        <div class="chart-container" id="chart-container">
	        <canvas id="chart"></canvas>
        </div>
    </section>

       
    <footer class="footer">
        <a class="flecha_arriba" href="../html/indice.html">
            <img id="flecha_arriba" src="../images/flecha_arriba.png" alt="flecha">
        </a>
        <a class="gti" href="../html/indice.html">
            <img id="logo" src="../images/logo.png" alt="GTI" style="float: left">
        </a>      
    </footer>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="../js/grafica-base.js"></script>

</body>
</html>

