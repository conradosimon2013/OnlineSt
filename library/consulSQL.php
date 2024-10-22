<?php
class ejecutarSQL {
    public static function consultar($query) {
        // Conexión con MySQL usando MySQLi
        $con = new mysqli(SERVER, USER, PASS, BD);

        // Verificar si hubo un error en la conexión
        if ($con->connect_error) {
            die("Conexión fallida: " . $con->connect_error);
        }

        // Ejecutar la consulta
        $resultado = $con->query($query);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error en la consulta: " . $con->error);
        }

        // Cerrar la conexión (opcional, ya que PHP lo hace automáticamente)
        $con->close();

        return $resultado;
    }
}