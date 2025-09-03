<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinica";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $dni = $_POST['dni'];
    $fecha_nacimiento = $_POST['fecha-nacimiento'];
    $genero = $_POST['genero'];
    $direccion = $_POST['direccion'];
    $estado_civil = $_POST['estado-civil'];
    
    $sql = "INSERT INTO clientes (nombre, email, telefono, dni, fecha_nacimiento, genero, direccion, estado_civil) 
            VALUES ('$nombre', '$email', '$telefono', '$dni', '$fecha_nacimiento', '$genero', '$direccion', '$estado_civil')";
    
    if ($conn->query($sql) === TRUE) {
        $success_message = "Cliente registrado con éxito";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM clientes ORDER BY fecha_registro DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CM Jerusalén - Gestión de Clientes</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
            scroll-behavior: smooth;
            color: #333;
            line-height: 1.6;
        }
        
        .top-bar {
            background-color: #0077b6;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-size: 14px;
            letter-spacing: 0.05em;
            font-weight: 500;
        }
        
        .contact-info span {
            margin: 0 20px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .contact-info i {
            font-size: 14px;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            background-color: white;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 999;
            transition: background-color 0.3s ease;
        }
        
        .logo img {
            height: 60px;
            transition: transform 0.3s ease;
        }
        
        .logo img:hover {
            transform: scale(1.05);
        }
        
        .menu {
            display: flex;
            list-style: none;
            gap: 25px;
        }
        
        .menu li a {
            padding: 12px 15px;
            color: #333;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            position: relative;
            transition: color 0.3s ease;
        }
        
        .menu li a::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #0077b6;
            transition: width 0.3s ease;
            border-radius: 2px;
        }
        
        .menu li a:hover::after,
        .menu li a.active::after {
            width: 100%;
        }
        
        .menu li a:hover,
        .menu li a.active {
            color: #0077b6;
        }
        
        .menu-toggle {
            display: none;
            font-size: 26px;
            cursor: pointer;
            color: #0077b6;
            transition: color 0.3s ease;
        }
        
        .menu-toggle:hover {
            color: #005f92;
        }
        
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)), url('img/hero-bg.jpg') no-repeat center/cover;
            height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 0 20px;
        }
        
        .hero-content h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
        }
        
        .hero-content p {
            font-size: 1.5rem;
            max-width: 700px;
            margin: 0 auto 30px;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
        }
        
        .formulario-clientes {
            padding: 5rem 0;
            background: #f9f9f9;
        }
        
        .formulario-clientes .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 1.2rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }
        
        .form-group.full-width {
            grid-column: 1 / -1;
        }
        
        .btn {
            background: #0077b6;
            color: white;
            padding: 1.2rem 2.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.2rem;
            transition: all 0.3s;
        }
        
        .btn:hover {
            background: #005f92;
            transform: scale(1.05);
        }
        
        .tabla-clientes {
            margin: 5rem auto;
            max-width: 1200px;
            padding: 0 20px;
        }
        
        .tabla-clientes h2 {
            margin-bottom: 2rem;
            text-align: center;
            color: #0077b6;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #0077b6;
            color: white;
            font-weight: 600;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
        
        .acciones {
            display: flex;
            gap: 10px;
        }
        
        .btn-editar, .btn-eliminar {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-editar {
            background-color: #4CAF50;
            color: white;
        }
        
        .btn-eliminar {
            background-color: #f44336;
            color: white;
        }
        
        .btn-editar:hover, .btn-eliminar:hover {
            opacity: 0.8;
            transform: scale(1.05);
        }
        
        .mensaje {
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            text-align: center;
        }
        
        .success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }
        
        .error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }
        
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .menu {
                display: none;
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 100%;
                left: 0;
                background: #fff;
                padding: 1rem;
            }
            
            .menu.active {
                display: flex;
            }
            
            .menu-toggle {
                display: block;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
        }
        
        .cerrar-sesion {
            position: absolute;
            top: 8px;
            right: 20px;
            font-size: 12px;
        }
        
        .cerrar-sesion a {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            background-color: #FF6F61;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-size: 14px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        
        .cerrar-sesion a i {
            margin-right: 5px;
            font-size: 14px;
        }
        
        .cerrar-sesion a:hover {
            background-color: #e95d4f;
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <header>
        <div class="top-bar">
            <div class="contact-info">
                <span><i class="fas fa-envelope"></i> contacto@cmjerusalen.com.pe</span>
                <span><i class="fas fa-phone"></i> 053-495346</span>
                <span><i class="fas fa-mobile-alt"></i> 953978797</span>
            </div>
        </div>
        
        <div class="cerrar-sesion">
            <a href="../login.php">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </div>
        
        <nav>
            <div class="logo">
                <img src="../IMAJENES/FONDO DE CLINICA.jpg" style="width:60px;height:auto;">
            </div>
            
            <ul class="menu" id="menu">
                <li><a href="clientes.php" class="active">AGREGAR CLIENTES</a></li>
            </ul>
            
            <div class="menu-toggle" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </header>

    <section class="hero clientes-hero">
        <div class="hero-content">
            <h1>Gestión de Clientes</h1>
            <p>Administra la información de tus pacientes de manera eficiente</p>
        </div>
    </section>

    <section class="formulario-clientes">
        <div class="container">
            <h2>Registro de Nuevo Cliente</h2>
            
            <?php if(isset($success_message)): ?>
                <div class="mensaje success">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($error_message)): ?>
                <div class="mensaje error">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <form id="formCliente" method="POST" action="">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre"><i class="fas fa-user"></i> Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefono"><i class="fas fa-phone"></i> Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono" pattern="[0-9]{9}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="dni"><i class="fas fa-id-card"></i> DNI:</label>
                        <input type="text" id="dni" name="dni" pattern="[0-9]{8}" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha-nacimiento"><i class="fas fa-calendar-alt"></i> Fecha de Nacimiento:</label>
                        <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" required>
                    </div>

                    <div class="form-group">
                        <label for="genero"><i class="fas fa-venus-mars"></i> Género:</label>
                        <select id="genero" name="genero" required>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="direccion"><i class="fas fa-map-marker-alt"></i> Dirección:</label>
                        <input type="text" id="direccion" name="direccion">
                    </div>

                    <div class="form-group full-width">
                        <label for="estado-civil"><i class="fas fa-heart"></i> Estado Civil:</label>
                        <select id="estado-civil" name="estado-civil">
                            <option value="soltero">Soltero</option>
                            <option value="casado">Casado</option>
                            <option value="divorciado">Divorciado</option>
                            <option value="viudo">Viudo</option>
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn"><i class="fas fa-save"></i> Guardar Cliente</button>
            </form>
        </div>
    </section>

    <section class="tabla-clientes">
        <div class="container">
            <h2>Clientes Registrados</h2>
            
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>DNI</th>
                            <th>Edad</th>
                            <th>Género</th>
                            <th>Estado Civil</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                                <td><?php echo htmlspecialchars($row['dni']); ?></td>
                                <td>
                                    <?php 
                                        $fecha_nac = new DateTime($row['fecha_nacimiento']);
                                        $hoy = new DateTime();
                                        $edad = $hoy->diff($fecha_nac)->y;
                                        echo $edad;
                                    ?>
                                </td>
                                <td><?php echo ucfirst($row['genero']); ?></td>
                                <td><?php echo ucfirst($row['estado_civil']); ?></td>
                                <td class="acciones">
                                    <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                                    <button class="btn-eliminar"><i class="fas fa-trash"></i> Eliminar</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay clientes registrados aún.</p>
            <?php endif; ?>
        </div>
    </section>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('menu').classList.toggle('active');
        });

        document.querySelectorAll('.btn-eliminar').forEach(button => {
            button.addEventListener('click', function() {
                if(confirm('¿Estás seguro de que deseas eliminar este cliente?')) {
                    alert('Cliente eliminado (funcionalidad pendiente de implementar)');
                }
            });
        });

        document.querySelectorAll('.btn-editar').forEach(button => {
            button.addEventListener('click', function() {
                alert('Editar cliente (funcionalidad pendiente de implementar)');
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>