<?php
include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $imagen = $_FILES['imagen']['name'];

    if (!empty($imagen)) {
        $ruta = "../imagenes/" . basename($imagen);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
    }

    $conexion->query("INSERT INTO publicaciones (titulo, imagen) VALUES ('$titulo', '$imagen')");
    header("Location: listar.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nueva Publicación</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<h2>➕ Nueva Publicación</h2>

<form method="POST" enctype="multipart/form-data">
    <label>Título:</label>
    <input type="text" name="titulo" class="form-control" required>

    <label>Imagen:</label>
    <input type="file" name="imagen" class="form-control mt-2" required>

    <button type="submit" class="btn btn-success mt-3">Guardar</button>
    <a href="listar.php" class="btn btn-secondary mt-3">Volver</a>
</form>
</body>
</html>
