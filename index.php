<?php
// Incluimos la conexión a la base de datos
include 'config/conexion.php';

// Consultar los atestados ordenados por año
$sql_atestados = "SELECT * FROM atestados ORDER BY anio DESC";
$res_atestados = $conexion->query($sql_atestados);

// Consultar la galería de fotos
$sql_galeria = "SELECT * FROM galeria ORDER BY fecha_subida DESC";
$res_galeria = $conexion->query($sql_galeria);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kristel Benavides - Sitio Web Personal</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<header>
    <h1>Kristel Benavides</h1>
    <p>Portafolio Personal & Blog</p>
    <nav>
        <a href="#inicio">Inicio</a>
        <a href="#acerca">Acerca de mí</a>
        <a href="#atestados">Atestados</a>
        <a href="#galeria">Galería</a>
        <a href="#contacto">Contacto</a>
        <a href="login.php" style="color: #00bcd4; font-weight: bold;">[ Administración ]</a>
    </nav>
</header>

<!-- 1. SECCIÓN INICIO -->
<section id="inicio">
    <h2>Inicio</h2>
    <img src="uploads/perfil.jpg" alt="Fotografía de perfil de Kristel Benavides" class="perfil-img" onerror="this.src='https://via.placeholder.com/160?text=Kristel+B.'">
    
    <h3 style="text-align: center; margin-top: 15px;">Kristel Benavides</h3>
    
    <p style="text-align: center; font-weight: bold; margin-top: 5px; color: #555;">
        Estudiante de Ingeniería en Sistemas
    </p>

    <h4 style="margin-top: 20px;">Presentación Corta</h4>
    <p style="text-align: justify; margin-top: 5px;">
        ¡Hola! Soy Kristel Benavides, estudiante de Ingeniería en Sistemas apasionada por el desarrollo de tecnología, la lógica de programación y la creación de soluciones digitales eficientes. Este sitio web funciona como mi portafolio digital y blog personal para mostrar mis proyectos, conocimientos y evolución académica.
    </p>

    <h4 style="margin-top: 15px;">Descripción Personal</h4>
    <p style="text-align: justify; margin-top: 5px;">
        Me caracterizo por ser una persona analítica, organizada, proactiva y orientada a resultados. Disfruto enfrentar retos complejos en el ámbito informático, aprender continuamente sobre nuevas herramientas tecnológicas y colaborar activamente en equipos interdisciplinarios.
    </p>
</section>

<!-- 2. SECCIÓN ACERCA DE MÍ -->
<section id="acerca">
    <h2>Acerca de mí</h2>
    <p style="text-align: justify; margin-bottom: 15px;">
        A lo largo de mi carrera en Ingeniería en Sistemas, he desarrollado una sólida fascinación por la arquitectura de software, el diseño de bases de datos y la automatización de procesos. Mi objetivo académico y profesional es construir aplicaciones web eficientes, seguras e intuitivas que impacten de manera positiva en las organizaciones.
    </p>

    <h3>Intereses</h3>
    <ul style="margin-left: 20px; margin-bottom: 15px;">
        <li>Desarrollo de Aplicaciones Web Frontend y Backend</li>
        <li>Diseño, Modelado y Gestión de Bases de Datos Relacionales</li>
        <li>Seguridad Informática y Redes de Computadoras</li>
    </ul>

    <h3>Habilidades</h3>
    <p style="margin-bottom: 15px;">
        HTML5, CSS3, PHP, MySQL, JavaScript, Git, Pensamiento Lógico, Análisis de Sistemas, Trabajo en Equipo y Resolución de Problemas.
    </p>

    <h3>Experiencia o Conocimientos Actuales</h3>
    <p style="text-align: justify;">
        Actualmente poseo conocimientos prácticos en el diseño y desarrollo de aplicaciones web dinámicas integradas con bases de datos relacionales, manejo de entornos locales con XAMPP, lógica de programación orientada a objetos y análisis de requerimientos de software.
    </p>
</section>

<!-- 3. SECCIÓN ATESTADOS ACADÉMICOS -->
<section id="atestados">
    <h2>Atestados Académicos</h2>
    <div class="grid-atestados">
        <?php if ($res_atestados && $res_atestados->num_rows > 0): ?>
            <?php while($row = $res_atestados->fetch_assoc()): ?>
                <div class="card">
                    <?php if(!empty($row['imagen'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($row['imagen']); ?>" alt="Atestado">
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($row['titulo']); ?></h3>
                    <p><strong>Institución:</strong> <?php echo htmlspecialchars($row['institucion']); ?></p>
                    <p><strong>Año:</strong> <?php echo htmlspecialchars($row['anio']); ?></p>
                    <p style="margin-top: 8px;"><?php echo htmlspecialchars($row['descripcion']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No se han registrado atestados aún. Agrega algunos desde el panel de administración.</p>
        <?php endif; ?>
    </div>
</section>

<!-- 4. SECCIÓN GALERÍA -->
<section id="galeria">
    <h2>Galería</h2>
    <div class="grid-galeria">
        <?php if ($res_galeria && $res_galeria->num_rows > 0): ?>
            <?php while($row = $res_galeria->fetch_assoc()): ?>
                <div class="card">
                    <img src="uploads/<?php echo htmlspecialchars($row['imagen']); ?>" alt="Galería">
                    <p style="text-align: center; font-weight: bold; margin-top: 8px;"><?php echo htmlspecialchars($row['titulo']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>La galería está vacía por el momento. Puedes subir imágenes desde el panel de administración.</p>
        <?php endif; ?>
    </div>
</section>

<!-- 5. SECCIÓN CONTACTO -->
<section id="contacto">
    <h2>Contacto</h2>
    <p><strong>Correo Electrónico:</strong> krisfio.bj@gmail.com</p>
    <p><strong>Teléfono:</strong> +506 6087-7867</p>
    <p><strong>Redes Sociales:</strong> kristel.benavides</p>
</section>

</body>
</html>