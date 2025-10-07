<?php
include("../conexion.php");

$id = $_GET['id'];
$conexion->query("DELETE FROM comentarios WHERE id=$id");

header("Location: listar.php");
?>
