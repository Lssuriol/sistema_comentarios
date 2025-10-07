<?php
$conexion = new mysqli("localhost", "root", "", "sistema_comentarios");

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
?>
