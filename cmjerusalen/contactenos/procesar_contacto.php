<?php
header('Content-Type: text/plain; charset=utf-8'); 
$host = "localhost";
$user = "root";
$password = "";
$database = "clinica";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    echo "Conexión fallida: " . mysqli_connect_error();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = mysqli_real_escape_string($conn, trim($_POST['nombre']));
    $correo_electronico = mysqli_real_escape_string($conn, trim($_POST['email']));
    $telefono = mysqli_real_escape_string($conn, trim($_POST['telefono']));
    $asunto = mysqli_real_escape_string($conn, trim($_POST['asunto']));
    $mensaje = mysqli_real_escape_string($conn, trim($_POST['mensaje']));

    if(empty($nombre_completo) || empty($correo_electronico) || empty($telefono) || empty($asunto) || empty($mensaje)) {
        echo "Por favor complete todos los campos.";
        exit;
    }

    $sql = "INSERT INTO contacto (nombre_completo, correo_electronico, telefono, asunto, mensaje) VALUES ('$nombre_completo', '$correo_electronico', '$telefono', '$asunto', '$mensaje')";

    if (mysqli_query($conn, $sql)) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} else {
    echo "Método no permitido.";
}

mysqli_close($conn);
?>
