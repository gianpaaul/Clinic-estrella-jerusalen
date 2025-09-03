<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "clinica";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'error de conexion a la base de datos: ' . $conn->connect_error]);
    exit();
}

$medico_nombre = htmlspecialchars($_POST['medico_nombre'] ?? '');
$especialidad = htmlspecialchars($_POST['especialidad'] ?? '');
$cmp = htmlspecialchars($_POST['cmp'] ?? '');
$fecha_consulta = htmlspecialchars($_POST['fecha_consulta'] ?? '');

$paciente_nombre = htmlspecialchars($_POST['paciente_nombre'] ?? '');
$dni = htmlspecialchars($_POST['dni'] ?? '');
$edad = intval($_POST['edad'] ?? 0); 
$sexo = htmlspecialchars($_POST['sexo'] ?? '');
$telefono_paciente = htmlspecialchars($_POST['telefono_paciente'] ?? '');
$seguro = htmlspecialchars($_POST['seguro'] ?? '');

$motivo_consulta = htmlspecialchars($_POST['motivo_consulta'] ?? '');
$enfermedad_actual = htmlspecialchars($_POST['enfermedad_actual'] ?? '');
$antecedentes = htmlspecialchars($_POST['antecedentes'] ?? '');

$presion_arterial = htmlspecialchars($_POST['presion_arterial'] ?? '');
$frecuencia_cardiaca = intval($_POST['frecuencia_cardiaca'] ?? 0);
$temperatura = floatval($_POST['temperatura'] ?? 0.0); 
$peso = floatval($_POST['peso'] ?? 0.0);
$descripcion_examen_fisico = htmlspecialchars($_POST['descripcion_examen_fisico'] ?? '');

$texto_diagnostico = htmlspecialchars($_POST['texto_diagnostico'] ?? '');
$texto_tratamiento = htmlspecialchars($_POST['texto_tratamiento'] ?? '');

$observaciones = htmlspecialchars($_POST['observaciones'] ?? '');

$reposo_medico = isset($_POST['reposo_medico']) ? 1 : 0;
$control_medico = isset($_POST['control_medico']) ? 1 : 0;
$examenes_auxiliares = isset($_POST['examenes']) ? 1 : 0; 
$interconsulta = isset($_POST['interconsulta']) ? 1 : 0;

$proxima_cita = htmlspecialchars($_POST['proxima_cita'] ?? '');
if (empty($proxima_cita)) {
    $proxima_cita = NULL;
}

$conn->begin_transaction();

try {
    $medico_id = null;
    $paciente_id = null;
    $consulta_id = null;

    $stmt = $conn->prepare("SELECT id FROM Medicos WHERE cmp = ?");
    $stmt->bind_param("s", $cmp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $medico_id = $result->fetch_assoc()['id'];
    } else {
        $stmt_insert_medico = $conn->prepare("INSERT INTO Medicos (nombre, especialidad, cmp) VALUES (?, ?, ?)");
        $stmt_insert_medico->bind_param("sss", $medico_nombre, $especialidad, $cmp);
        if (!$stmt_insert_medico->execute()) {
            throw new Exception("Error al insertar médico: " . $stmt_insert_medico->error);
        }
        $medico_id = $conn->insert_id; 
        $stmt_insert_medico->close();
    }
    $stmt->close();

    $stmt = $conn->prepare("SELECT id FROM Pacientes WHERE dni = ?");
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $paciente_id = $result->fetch_assoc()['id'];
    } else {
        $stmt_insert_paciente = $conn->prepare("INSERT INTO Pacientes (nombre, dni, edad, sexo, telefono, seguro) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_insert_paciente->bind_param("ssisss", $paciente_nombre, $dni, $edad, $sexo, $telefono_paciente, $seguro);
        if (!$stmt_insert_paciente->execute()) {
            throw new Exception("Error al insertar paciente: " . $stmt_insert_paciente->error);
        }
        $paciente_id = $conn->insert_id; 
        $stmt_insert_paciente->close();
    }
    $stmt->close();

    $stmt_insert_consulta = $conn->prepare("INSERT INTO Consultas (medico_id, paciente_id, fecha_consulta, motivo_consulta, enfermedad_actual, antecedentes, observaciones, reposo_medico, control_medico, examenes_auxiliares, interconsulta, proxima_cita) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt_insert_consulta->bind_param("iissssssiiis",
        $medico_id, $paciente_id, $fecha_consulta, $motivo_consulta, $enfermedad_actual,
        $antecedentes, $observaciones, $reposo_medico, $control_medico,
        $examenes_auxiliares, $interconsulta, $proxima_cita
    );
    
    if (!$stmt_insert_consulta->execute()) {
        throw new Exception("Error al insertar consulta: " . $stmt_insert_consulta->error);
    }
    $consulta_id = $conn->insert_id; 
    $stmt_insert_consulta->close();

    $stmt_insert_examen = $conn->prepare("INSERT INTO ExamenesFisicos (consulta_id, presion_arterial, frecuencia_cardiaca, temperatura, peso, descripcion_examen_fisico) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_insert_examen->bind_param("isidds",
        $consulta_id, $presion_arterial, $frecuencia_cardiaca, $temperatura, $peso, $descripcion_examen_fisico
    );
    if (!$stmt_insert_examen->execute()) {
        throw new Exception("Error al insertar examen físico: " . $stmt_insert_examen->error);
    }
    $stmt_insert_examen->close();

    $stmt_insert_diagnostico = $conn->prepare("INSERT INTO Diagnosticos (consulta_id, texto_diagnostico) VALUES (?, ?)");
    $stmt_insert_diagnostico->bind_param("is", $consulta_id, $texto_diagnostico);
    if (!$stmt_insert_diagnostico->execute()) {
        throw new Exception("Error al insertar diagnóstico: " . $stmt_insert_diagnostico->error);
    }
    $stmt_insert_diagnostico->close();

    $stmt_insert_tratamiento = $conn->prepare("INSERT INTO Tratamientos (consulta_id, texto_tratamiento) VALUES (?, ?)");
    $stmt_insert_tratamiento->bind_param("is", $consulta_id, $texto_tratamiento);
    if (!$stmt_insert_tratamiento->execute()) {
        throw new Exception("Error al insertar tratamiento: " . $stmt_insert_tratamiento->error);
    }
    $stmt_insert_tratamiento->close();

    $conn->commit();

    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Consulta médica guardada exitosamente.']);

} catch (Exception $e) {
    $conn->rollback();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Error al guardar la consulta: ' . $e->getMessage()]);
}
$conn->close();
?>