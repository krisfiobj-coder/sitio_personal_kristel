<?php
session_start();

// Validar que el usuario haya iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}

// CORRECCIÓN: Usar ../ para salir de la carpeta admin/ y entrar a config/
include '../config/conexion.php';
$mensaje = "";

// 1. Guardar un nuevo Atestado Académico
if (isset($_POST['guardar_atestado'])) {
    $titulo = $_POST['titulo'];
    $institucion = $_POST['institucion'];
    $anio = $_POST['anio'];
    $descripcion = $_POST['descripcion'];

    $nombre_imagen = "";
    if (!empty($_FILES['imagen']['name'])) {
        $nombre_imagen = time() . '_' . $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], "../uploads/" . $nombre_imagen);
    }

    $stmt = $conexion->prepare("INSERT INTO atestados (titulo, institucion, anio, descripcion, imagen) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $titulo, $institucion, $anio, $descripcion, $nombre_imagen);
    
    if ($stmt->execute()) {
        $mensaje = "Atestado agregado correctamente.";
    } else {
        $mensaje = "Error al guardar el atestado.";
    }
}

// 2. Guardar una nueva Imagen en la Galería
if (isset($_POST['guardar_galeria'])) {
    $titulo_foto = $_POST['titulo_foto'];

    if (!empty($_FILES['foto']['name'])) {
        $nombre_foto = time() . '_' . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/" . $nombre_foto);

        $stmt = $conexion->prepare("INSERT INTO galeria (titulo, imagen) VALUES (?, ?)");
        $stmt->bind_param("ss", $titulo_foto, $nombre_foto);
        
        if ($stmt->execute()) {
            $mensaje = "Imagen subida a la galería correctamente.";
        } else {
            $mensaje = "Error al subir la imagen.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>

<header>
    <h1>Panel Administrable</h1>
    <nav>
        <a href="../index.php" target="_blank">Ver Sitio Público ↗</a>
        <a href="../logout.php" style="color: #ff5252; margin-left: 20px;">Cerrar Sesión</a>
    </nav>
</header>

<?php if(!empty($mensaje)): ?>
    <section style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px;">
        <p style="font-weight: bold; text-align: center;"><?php echo $mensaje; ?></p>
    </section>
<?php endif; ?>

<!-- FORMULARIO 1: ATESTADOS ACADÉMICOS -->
<section>
    <h2>Agregar Nuevo Atestado Académico</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="titulo">Título, Curso o Certificación:</label>
        <input type="text" id="titulo" name="titulo" required placeholder="Ej. Diplomado en Desarrollo Web">

        <label for="institucion">Institución:</label>
        <input type="text" id="institucion" name="institucion" required placeholder="Ej. Universidad / Instituto">

        <label for="anio">Año:</label>
        <input type="text" id="anio" name="anio" required placeholder="Ej. 2024">

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" placeholder="Breve descripción del logro..."></textarea>

        <label for="imagen">Imagen o Fotografía del Atestado:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" style="margin-top: 5px;">

        <button type="submit" name="guardar_atestado">Guardar Atestado</button>
    </form>
</section>

<!-- FORMULARIO 2: GALERÍA DE FOTOS -->
<section>
    <h2>Agregar Fotografía a la Galería</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="titulo_foto">Título o Descripción Corta:</label>
        <input type="text" id="titulo_foto" name="titulo_foto" placeholder="Ej. Proyecto Final de Programación">

        <label for="foto">Seleccionar Fotografía:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required style="margin-top: 5px;">

        <button type="submit" name="guardar_galeria">Subir Fotografía</button>
    </form>
</section>

</body>
</html>