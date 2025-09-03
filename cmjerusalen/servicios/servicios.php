<?php
require_once 'db_config.php';

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset('utf8mb4');

$especialidades = [];
$result = $conn->query("SELECT slug, nombre, especialidad, precio, duracion FROM especialidades");
while ($row = $result->fetch_assoc()) {
    $especialidades[] = $row;
}
$result->free();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CM Jerusalén - Servicios</title>
    <link rel="stylesheet" href="../paciente/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
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
        <img src="../IMAJENES/FONDO DE CLINICA.jpg" alt="Logo CM Jerusalén" />
      </div>
      <ul class="menu" id="menu">
        <li><a href="../paciente/paciente.html">QUIENES SOMOS</a></li>
        <li><a href="../servicios/servicios.php">SERVICIOS</a></li>
        <li><a href="../paciente/paciente.html#especialidades">ESPECIALIDADES</a></li>
        <li><a href="../contactenos/contactenos.html">CONTACTENOS</a></li>
      </ul>
      <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
      </div>
    </nav>
  </header>

<section class="servicios" id="servicios">
    <h2>Nuestros Servicios Médicos</h2>
    
    <div class="pasos-servicio">
        <h3>¿Cómo solicitar un servicio?</h3>
        <ol class="lista-pasos">
            <li>Seleccione el servicio requerido</li>
            <li>Complete el formulario de contacto</li>
            <li>Espere nuestra confirmación vía telefónica</li>
        </ol>
    </div>

    <div class="busqueda-servicios">
        <input type="text" id="buscarServicio" placeholder="Buscar servicio o especialidad..."> <br>
        <small>Haz clic en cualquier servicio de la tabla para seleccionarlo automáticamente</small>
    </div>

    <div class="tabla-servicios">
        <table>
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Especialidad</th>
                    <th>Precio</th>
                    <th>Duración</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($especialidades as $e): ?>
                <tr data-servicio="<?= htmlspecialchars($e['slug']) ?>">
                    <td><?= htmlspecialchars($e['nombre']) ?></td>
                    <td><?= htmlspecialchars($e['especialidad']) ?></td>
                    <td>S/ <?= number_format($e['precio'], 2) ?></td>
                    <td><?= htmlspecialchars($e['duracion']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <form id="formServicios" class="form-servicio" method="POST">
        <fieldset>
            <legend>Solicitar Servicio</legend>
            
            <div class="form-group">
                <label>Seleccione servicios:</label>
                <div class="checkbox-group" id="checkboxGroup">
                    <?php foreach($especialidades as $e): ?>
                    <label><input type="checkbox" name="servicio[]" value="<?= htmlspecialchars($e['slug']) ?>"> <?= htmlspecialchars($e['nombre']) ?></label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-group">
                <label>Horario preferido:
                    <select id="horario" name="horario" required>
                        <option value="">Seleccione...</option>
                        <option value="mañana">Mañana (8am - 12pm)</option>
                        <option value="tarde">Tarde (2pm - 6pm)</option>
                    </select>
                </label>
            </div>

            <div class="form-group">
                <label>Teléfono:
                    <input type="tel" id="telefono" name="telefono" pattern="[0-9]{9}" required>
                </label>
            </div>

            <button type="submit" class="btn">Enviar Solicitud</button>
            <button type="reset" class="btn">Limpiar</button>
        </fieldset>
    </form>
</section>

<style>
    .servicios {
        padding: 80px 5%;
        background-color: #f9f9f9;
    }

    .lista-pasos {
        margin: 20px auto;
        max-width: 600px;
        text-align: left;
        font-size: 1.1rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        background: white;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #0077b6;
        color: white;
        font-weight: 600;
    }

    .form-servicio {
        max-width: 600px;
        margin: 30px auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    fieldset {
        border: 2px solid #0077b6;
        padding: 20px;
        border-radius: 6px;
    }

    legend {
        color: #0077b6;
        font-weight: 700;
        padding: 0 15px;
        font-size: 1.2rem;
    }

    .form-group label {
        display: block;
        margin: 15px 0;
        font-weight: 500;
    }

    .btn {
        margin: 10px 5px;
        padding: 12px 25px;
    }

    .busqueda-servicios {
        text-align: center;
        margin: 25px 0;
    }

    #buscarServicio {
        padding: 12px 20px;
        width: 100%;
        max-width: 400px;
        border: 2px solid #0077b6;
        border-radius: 6px;
        font-size: 1rem;
    }

    tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    @media (min-width: 1024px) {
        .servicios {
            padding: 100px 10%;
        }

        .form-servicio {
            max-width: 700px;
        }

        #buscarServicio {
            max-width: 500px;
        }
    }

    @media (max-width: 1024px) {
        .servicios {
            padding: 80px 5%;
        }

        .form-servicio {
            max-width: 500px;
        }

        table {
            font-size: 0.9rem;
        }

        #buscarServicio {
            max-width: 90%;
        }
    }

    @media (max-width: 768px) {
        .servicios {
            padding: 60px 5%;
        }

        table {
            font-size: 0.85rem;
        }

        .form-servicio {
            max-width: 400px;
        }

        #buscarServicio {
            max-width: 90%;
            padding: 10px;
        }

        .busqueda-servicios {
            margin-top: 10px;
        }
    }

    @media (max-width: 480px) {
        .servicios {
            padding: 40px 5%;
        }

        .form-servicio {
            max-width: 90%;
            padding: 15px;
        }

        table {
            font-size: 0.8rem;
        }

        th, td {
            padding: 10px;
        }

        .btn {
            padding: 10px 20px;
        }

        #buscarServicio {
            max-width: 90%;
            padding: 8px;
        }

        .busqueda-servicios {
            margin-top: 10px;
        }

        .form-group label {
            font-size: 0.9rem;
        }

        .lista-pasos {
            font-size: 1rem;
        }
    }

    @media (max-width: 400px) {
        table {
            font-size: 0.75rem;
        }

        th, td {
            padding: 8px;
        }

        #buscarServicio {
            max-width: 85%;
        }

        .btn {
            padding: 8px 16px;
        }
    }
</style>

<script>
    document.getElementById('buscarServicio').addEventListener('input', function() {
        const termino = this.value.toLowerCase();
        const filas = document.querySelectorAll('table tbody tr');
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        
        filas.forEach(fila => {
            const contenido = fila.textContent.toLowerCase();
            const mostrar = contenido.includes(termino);
            fila.style.display = mostrar ? '' : 'none';
            
            if(mostrar && termino) {
                fila.style.backgroundColor = '#f8f9fa';
            } else {
                fila.style.backgroundColor = '';
            }
        });

        checkboxes.forEach(checkbox => {
            const label = checkbox.parentElement.textContent.toLowerCase();
            if(label.includes(termino)) {
                checkbox.checked = true;
                checkbox.parentElement.style.color = '#0077b6';
            } else if(termino) {
                checkbox.checked = false;
                checkbox.parentElement.style.color = '';
            }
        });
    });

    document.querySelectorAll('table tbody tr').forEach(fila => {
        fila.addEventListener('click', function() {
            const servicio = this.dataset.servicio;
            const checkbox = document.querySelector(`input[value="${servicio}"]`);
            checkbox.checked = !checkbox.checked;
            this.style.backgroundColor = checkbox.checked ? '#e3f2fd' : '';
        });
    });
</script>

<script>
    const toggle = document.getElementById("menu-toggle");
    const menu = document.getElementById("menu");
    toggle.addEventListener("click", () => {
      menu.classList.toggle("active");
    });

    window.addEventListener("scroll", () => {
      const sections = document.querySelectorAll("section[id]");
      const navLinks = document.querySelectorAll("nav ul li a");
      let current = "";

      sections.forEach((section) => {
        const sectionTop = section.offsetTop - 70;
        if (pageYOffset >= sectionTop) {
          current = section.getAttribute("id");
        }
      });

      navLinks.forEach((link) => {
        link.classList.remove("active");
        if (link.getAttribute("href").includes(`#${current}`)) {
          link.classList.add("active");
        }
      });
    });
</script>

<script>
    document.getElementById('formServicios').addEventListener('submit', function(e) {
        e.preventDefault();

        const servicios = Array.from(document.querySelectorAll('input[name^="servicio"]:checked')).map(i => i.value);
        const horario = document.getElementById('horario').value;
        const telefono = document.getElementById('telefono').value;

        if(servicios.length === 0) {
            alert('Debe seleccionar al menos un servicio');
            return;
        }
        if(!horario || !telefono) {
            alert('Complete todos los campos obligatorios');
            return;
        }

        const confirmacion = confirm('¿Confirma el envío de la solicitud?');
        if(!confirmacion) return;

        const data = new URLSearchParams();
        servicios.forEach(s => data.append('servicio[]', s));
        data.append('horario', horario);
        data.append('telefono', telefono);

        fetch('procesar_servicio.php', {
            method: 'POST',
            body: data
        })
        .then(response => {
            if (!response.ok) throw new Error('Error en la petición');
            return response.text();
        })
        .then(text => {
            if(text.trim() === 'OK') {
                alert('Solicitud enviada exitosamente');
                this.reset();
            } else {
                alert('Error: ' + text);
            }
        })
        .catch(err => alert('Error: ' + err.message));
    });
</script>
</body>
</html>
