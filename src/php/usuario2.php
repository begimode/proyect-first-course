<?php
session_start();
if (($_SESSION['authenticatedU'] == false) and ($_SESSION['authenticatedA'] == false)) {
header("Location: indice.html");
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="usuario.css">
    <title>Página del usuario nº2</title>
    <style>
        #mapa {
            width: 100%;
            height: 50vh;
            background-color: blue;
        }
        #selector-parcelas {
            display: flex;
            flex-direction: column;
            gap: .5cm;
        }
    </style>
</head>
<body>

    <section class="cabecera">
        <header class="encabezado" role="banner">
            <a class="menu" href="#">
                <img src="menu.png" alt="menu" width="100" height="100">
            </a>
            <a class="logo" href="nuevo.html">
                <img src="logo.png" alt="logo de la empresa" width="300" height="150" >
            </a>
            <a class="login" href="login.html" >
                <img src="icono_login.png" alt="logo registrarse" width="75" height="75">
            </a>
        </header>
    </section>
    
    <table class="table">
        <tr>
            <td>Nombre</td>
            <td>Apellidos</td>
            <td>Email</td>
            <td>Parcelas</td>
        </tr>

        <tr>
            <td>Luis</td>
            <td>Gutiérrez García</td>
            <td>luisgg@gmail.com</td>
            <td>2</td>
        </tr>
    </table>

<div id="mapa"></div>
    <div id="selector-parcelas"></div>
       
    <script>
        let map;
        let parcelas;
        async function initMap() {

            let urlParams = new URLSearchParams(window.location.search);
            let usuario = urlParams.get("usuario");
            if(!usuario) usuario = 1;
            
            let consulta = await fetch("api/v1.0/parcela?usuario=" + usuario);
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
                }
                ],
                mapTypeControl: false,
                streetViewControl: false,
                rotateControl: false,
            });
            map.setTilt(0);
            var marker = new google.maps.Marker({
                position: {lat: 38.9927512, lng: -0.1694416},
                label: "9",
                animation: google.maps.Animation.DROP,
                map: map
            });  
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

        async function mostrarOcultarParcela(index, mostrar) {
            let parcela = parcelas[index];
            if(mostrar) {
                if(parcela.polygon) {
                    parcela.polygon.setMap(map);
                } else {
                    let consulta = await fetch("api/v1.0/parcela/" + parcela.parcela + "/vertices");
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
            } else {
                if(parcela.polygon) parcela.polygon.setMap(null);
            }
            ajustarMapa()
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
    <script src="https://maps.googleapis.com/maps/api/js?&callback=initMap" async defer></script>

</body>
</html>
