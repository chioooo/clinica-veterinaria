<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include("db_connection.php");

$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    echo json_encode(["error" => "No se recibieron datos"]);
    exit();
}

if (isset($data->nombre) && isset($data->especie) && isset($data->raza) && isset($data->edad) && isset($data->peso) && isset($data->id_cliente)) {
    $nombre = mysqli_real_escape_string($con, $data->nombre);
    $especie = mysqli_real_escape_string($con, $data->especie);
    $raza = mysqli_real_escape_string($con, $data->raza);
    $edad = mysqli_real_escape_string($con, $data->edad);
    $peso = mysqli_real_escape_string($con, $data->peso);
    $id_cliente = mysqli_real_escape_string($con, $data->id_cliente);

    $query = "INSERT INTO mascotas (nombre, especie, raza, edad, peso, id_cliente) VALUES ('$nombre', '$especie', '$raza', '$edad', '$peso', '$id_cliente')";
    
    if (mysqli_query($con, $query)) {
        echo json_encode(["mensaje" => "Mascota registrada correctamente"]);
    } else {
        echo json_encode(["error" => " Error al registrar la mascota"]);
    }
} else {
    echo json_encode(["error" => "❗ Datos incompletos"]);
}
?>