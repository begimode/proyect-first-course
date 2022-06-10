<?php

// die("Texto index");

require_once ('../src/api/includes/PeticionRest.inc');

$peticion = new PeticionREST('v1.0');

$salida = [];

require "modelos/" . $peticion->recurso() . ".php";

header('Content-Type: application/json; charset=utf-8');
echo json_encode($salida);