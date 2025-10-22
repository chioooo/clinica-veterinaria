<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$host = "localhost";
$user = "root";
$password = "";
$database = "ClinicaVeterinaria";
$port = 3306;

$con = new mysqli($host, $user, $password, $database, $port);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

//echo "Conexión exitosa";
?>
