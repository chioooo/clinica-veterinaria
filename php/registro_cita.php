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

if (isset($data->id_mascota) && isset($data->id_veterinario) && isset($data->fecha) && isset($data->motivo)) {
    $id_mascota = mysqli_real_escape_string($con, $data->id_mascota);
    $id_veterinario = mysqli_real_escape_string($con, $data->id_veterinario);
    $fecha = mysqli_real_escape_string($con, $data->fecha);
    $motivo = mysqli_real_escape_string($con, $data->motivo);

    $query = "INSERT INTO citas (id_mascota, id_veterinario, fecha, motivo) VALUES ('$id_mascota', '$id_veterinario', '$fecha', '$motivo')";

    if (mysqli_query($con, $query)) {
        echo json_encode(["mensaje" => "Cita registrada correctamente"]);
    } else {
        echo json_encode(["error" => " Error al registrar la cita"]);
    }
} else {
    echo json_encode(["error" => "❗ Datos incompletos"]);
}
?>