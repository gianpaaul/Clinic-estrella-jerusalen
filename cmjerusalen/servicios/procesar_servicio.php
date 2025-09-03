<?php
require_once 'db_config.php';

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    http_response_code(500);
    echo "Error en la conexión: " . $conn->connect_error;
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Método no permitido";
    exit;
}

$servicios = $_POST['servicio'] ?? null;
$horario   = trim($_POST['horario'] ?? '');
$telefono  = trim($_POST['telefono'] ?? '');

if (!$servicios || !is_array($servicios) || count($servicios) === 0) {
    echo "Debe seleccionar al menos un servicio";
    exit;
}
if ($horario === '') {
    echo "El horario es obligatorio";
    exit;
}
if ($telefono === '' || !preg_match('/^\d{9}$/', $telefono)) {
    echo "El teléfono debe tener 9 dígitos";
    exit;
}

$servicios_str = implode(',', $servicios);
$stmt = $conn->prepare(
    "INSERT INTO solicitudes_servicios (servicios, horario, telefono) VALUES (?, ?, ?)"
);
if (!$stmt) {
    echo "Error en la preparación de la consulta";
    exit;
}
$stmt->bind_param("sss", $servicios_str, $horario, $telefono);

if ($stmt->execute()) {
    echo "OK";
} else {
    echo "Error al guardar la solicitud: " . $stmt->error;
}

$stmt->close();
$conn->close();
