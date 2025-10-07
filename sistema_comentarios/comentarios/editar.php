<?php
include("../conexion.php");

$id = $_GET['id'];
$resultado = $conexion->query("SELECT * FROM comentarios WHERE id=$id");
$comentario = $resultado->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = $_POST['texto'];
    $conexion->query("UPDATE comentarios SET texto='$texto' WHERE id=$id");
    header("Location: listar.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Comentario</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<h2>✏️ Editar Comentario</h2>

<form method="POST">
    <label>Texto:</label>
    <textarea name="texto" class="form-control"><?= $comentario['texto'] ?></textarea>

    <button type="submit" class="btn btn-success mt-3">Actualizar</button>
    <a href="listar.php" class="btn btn-secondary mt-3">Volver</a>
</form>
</body>
</html>
