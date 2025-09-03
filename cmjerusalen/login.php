<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = new mysqli("localhost", "root", "", "clinica");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $num_doc = $_POST['document_number'] ?? '';
    $contrasena = $_POST['password'] ?? '';

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE num_doc = ?");
    $stmt->bind_param("s", $num_doc);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($usuario = $resultado->fetch_assoc()) {
        if ($usuario['contrasena'] === $contrasena) {
            switch ($usuario['num_doc']) {
                case '72918493':
                    echo "<script>window.location.href = './paciente/paciente.html';</script>";
                    exit;
                case '19283743':
                    echo "<script>window.location.href = './clientes/clientes.php';</script>";
                    exit;
                case '83948523':
                    echo "<script>window.location.href = './medico/medico.html';</script>";
                    exit;
                default:
                    echo "<script>alert('Acceso válido, pero sin ruta asignada.');</script>";
                    break;
            }
        } else {
            echo "<script>alert('Contraseña incorrecta.');</script>";
        }
    } else {
        echo "<script>alert('Número de documento no encontrado.');</script>";
    }

    $stmt->close();
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Acceso de Pacientes - CM Jerusalén</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <style>
body {
    font-family: 'Poppins', sans-serif;
    background-image: url('./IMAJENES/fondologin.png');
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    margin: 0;
    position: relative;
    overflow: hidden;
}
.clinic-logo {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    max-height: 120px;
    width: auto;
}
.login-container {
    background-color: rgba(255, 255, 255, 0.85);
    padding: 40px;
    border-radius: 40px;
    box-shadow: 0 20px 70px rgba(0, 0, 0, 0.35);
    width: 100%;
    max-width: 600px;
    text-align: center;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.4);
    animation: fadeIn 0.8s ease-out;
    margin-top: 100px;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
@media (max-width: 600px) {
    .login-container {
        padding: 20px;
        max-width: 100%;
    }
    .welcome-text h2 {
        font-size: 2.5em;
    }
    .input-group label {
        font-size: 1.2em;
    }
    .input-group input {
        font-size: 1.4em;
    }
    .btn-login {
        font-size: 1.8em;
        padding: 20px;
    }
}
.welcome-text {
    margin-bottom: 60px;
    color: #333;
}
.welcome-text h2 {
    font-size: 4.5em;
    color: #2c3e50;
    margin-bottom: 25px;
}
.input-group {
    margin-bottom: 45px;
    text-align: left;
    position: relative;
}
.input-group label {
    display: block;
    margin-bottom: 20px;
    color: #34495e;
    font-size: 1.5em;
    font-weight: 500;
}
.input-group input {
    width: calc(100% - 60px);
    padding: 30px;
    border: 1px solid #7BB6D3;
    border-radius: 12px;
    font-size: 1.6em;
    color: #2B6E94;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}
.input-group input::placeholder {
    color: #9bbad3;
}
.input-group input:focus {
    outline: none;
    border-color: #2D9CDB;
    box-shadow: 0 0 0 8px rgba(45, 156, 219, 0.5);
}
.password-toggle {
    position: absolute;
    right: 30px;
    top: 65%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #9bbad3;
    font-size: 1.5em;
    transition: color 0.2s ease;
}
.password-toggle:hover {
    color: #2D9CDB;
}
.btn-login {
    width: 100%;
    padding: 30px;
    background-color: #2D9CDB;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-size: 2em;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
    letter-spacing: 2px;
    box-shadow: 0 12px 35px rgba(45, 156, 219, 0.7);
}
.btn-login:hover {
    background-color: #2188da;
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(45, 156, 219, 0.8);
}
.forgot-password {
    margin-top: 60px;
    font-size: 1.4em;
}
.forgot-password a {
    color: #2D9CDB;
    text-decoration: none;
    transition: color 0.3s ease;
}
.forgot-password a:hover {
    color: #2188da;
    text-decoration: underline;
}
    </style>
</head>
<body>
    <div class="clinic-logo">
        <img src="IMAJENES/logoClinicaJerusalen.png" alt="Logo CM Jerusalén" />
    </div>

    <div class="login-container">
        <div class="welcome-text">
            <h2>Bienvenido</h2>
        </div>
        <form id="loginForm" method="POST">
            <?php
            ?>
            <div class="input-group">
                <label for="document_number">Número de documento</label>
                <input type="text" id="document_number" name="document_number" placeholder="Ingresa tu número de documento" required autocomplete="username" />
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required autocomplete="current-password" />
                <span class="password-toggle" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <button type="submit" class="btn-login">Ingresar</button>
        </form>
        <div class="forgot-password">
            <a href="#">¿Olvidaste tu contraseña?</a>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
