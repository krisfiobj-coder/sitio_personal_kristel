<?php
// Configuración de los parámetros de conexión
$host = "localhost";
$user = "root";
$password = ""; // En XAMPP por defecto la contraseña está vacía
$dbname = "sitio_web";

// Crear la conexión con la base de datos MySQL
$conexion = new mysqli($host, $user, $password, $dbname);

// Verificar si hubo algún error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Configurar el conjunto de caracteres a UTF-8 para admitir tildes y eñes
$conexion->set_charset("utf8mb4");
?>