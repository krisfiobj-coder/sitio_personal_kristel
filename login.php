<?php
session_start();
include 'config/conexion.php';

$error = "";

// Si el usuario ya está autenticado, lo redirigimos al panel
if (isset($_SESSION['usuario_id'])) {
    header("Location: admin/dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['usuario'];
    $pass = $_POST['password'];

    // Verificación directa y segura
    if ($user === "admin" && $pass === "12345") {
        $_SESSION['usuario_id'] = 1;
        $_SESSION['usuario_nombre'] = "admin";
        header("Location: admin/dashboard.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Administración</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<header>
    <h1>Administración del Sitio Web</h1>
    <nav>
        <a href="index.php">← Volver al Sitio Público</a>
    </nav>
</header>

<section style="max-width: 400px; margin-top: 50px;">
    <h2>Iniciar Sesión</h2>
    
    <?php if(!empty($error)): ?>
        <p style="color: red; font-weight: bold; margin-bottom: 15px;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required placeholder="Ingresa tu usuario">

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required placeholder="Ingresa tu contraseña">

        <button type="submit">Ingresar al Panel</button>
    </form>
</section>

</body>
</html>