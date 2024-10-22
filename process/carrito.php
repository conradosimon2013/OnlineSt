<?php
error_reporting(E_PARSE);
include '../library/configServer.php';
include '../library/consulSQL.php';
session_start();

// Inicializar variables de sesión si no existen
if (!isset($_SESSION['producto'])) {
    $_SESSION['producto'] = array();
}
if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 0;
}

$suma = 0;

// Si se recibe un precio (o más bien un código de producto) por la URL, se agrega al carrito
if (isset($_GET['precio'])) {
    $_SESSION['producto'][$_SESSION['contador']] = $_GET['precio'];
    $_SESSION['contador']++;
}

// Imprimir la tabla con los productos en el carrito
echo '<table class="table table-bordered">';
if ($_SESSION['contador'] > 0) {
    for ($i = 0; $i < $_SESSION['contador']; $i++) {
        // Escapar el código del producto para evitar inyección SQL
        $codigoProd = mysqli_real_escape_string($db, $_SESSION['producto'][$i]);
        
        // Ejecutar la consulta
        $consulta = ejecutarSQL::consultar("SELECT * FROM producto WHERE CodigoProd='$codigoProd'");
        
        // Verificar si la consulta devolvió resultados
        if ($consulta && mysqli_num_rows($consulta) > 0) {
            while ($fila = mysqli_fetch_array($consulta)) {
                echo "<tr><td>" . htmlspecialchars($fila['NombreProd']) . "</td><td>$" . number_format($fila['Precio'], 2) . "</td></tr>";
                $suma += $fila['Precio'];
            }
        } else {
            echo "<tr><td colspan='2'>Producto no encontrado</td></tr>";
        }
    }
} else {
    echo "<tr><td colspan='2'>El carrito está vacío</td></tr>";
}

echo "<tr><td>Subtotal</td><td>$" . number_format($suma, 2) . "</td></tr>";
echo "</table>";

// Guardar el total en la sesión
$_SESSION['sumaTotal'] = $suma;
?>
