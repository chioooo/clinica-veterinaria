<?php
include("Perro.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$perroObj = new Perro();
$nombrePerro = isset($_POST['nombrePerro']) ? $_POST['nombrePerro'] : '';

$mascota = $perroObj->buscarPorNombre($nombrePerro);

if ($mascota) {
    echo json_encode($mascota->toArray());
} else {
    echo json_encode(["error" => "Perro no encontrado"]);
}
