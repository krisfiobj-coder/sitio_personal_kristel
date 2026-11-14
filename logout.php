<?php
session_start();
session_unset();
session_destroy();

// Redirigir al inicio del sitio público tras cerrar sesión
header("Location: index.php");
exit;
?>