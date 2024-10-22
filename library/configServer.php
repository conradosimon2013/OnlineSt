<?php
define("USER", "root");
define("SERVER", "localhost");
define("BD", "store");
define("PASS", "");

// Configuración de los detalles de la base de datos
$host = "localhost";    // El host donde está tu base de datos
$user = "root";         // El usuario de la base de datos
$password = "";         // La contraseña del usuario de la base de datos
$dbname = "nombre_de_tu_base_de_datos"; // El nombre de tu base de datos

// Crear la conexión a la base de datos
$db = new mysqli($host, $user, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($db->connect_error) {
    die("Conexión fallida: " . $db->connect_error);
}
?>