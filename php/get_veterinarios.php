<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

include 'db_connection.php';

$sql = "SELECT * FROM veterinarios";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $veterinarios = [];

    while ($row = $result->fetch_assoc()) {
        $veterinarios[] = $row;
    }

    echo json_encode($veterinarios);
} else {
    echo json_encode(["mensaje" => "No se encontraron registros"]);
}

$con->close();
