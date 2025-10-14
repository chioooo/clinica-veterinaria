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

if (isset($data->num) && isset($data->nombre) && isset($data->raza) && isset($data->dueño)) {
    $num = mysqli_real_escape_string($con, $data->num);
    $nombre = mysqli_real_escape_string($con, $data->nombre);
    $raza = mysqli_real_escape_string($con, $data->raza);
    $dueño = mysqli_real_escape_string($con, $data->dueño);

    $query = "INSERT INTO mascota (num, mascota, raza, dueño) VALUES ('$num', '$nombre', '$raza', '$dueño')";
    
    if (mysqli_query($con, $query)) {
        echo json_encode(["mensaje" => "Mascota registrada correctamente"]);
    } else {
        echo json_encode(["error" => " Error al registrar la mascota"]);
    }
} else {
    echo json_encode(["error" => "❗ Datos incompletos"]);
}
?>