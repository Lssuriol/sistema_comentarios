<?php
include("../conexion.php");
$publicaciones = $conexion->query("SELECT * FROM publicaciones");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = $_POST['texto'];
    $id_publicacion = $_POST['id_publicacion'];

    $conexion->query("INSERT INTO comentarios (texto, id_publicacion) VALUES ('$texto', '$id_publicacion')");
    header("Location: listar.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo Comentario</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<h2>➕ Nuevo Comentario</h2>

<form method="POST">
    <label>Texto del Comentario:</label>
    <textarea name="texto" class="form-control" required></textarea>

    <label>Publicación:</label>
    <select name="id_publicacion" class="form-control" required>
        <option value="">-- Selecciona una publicación --</option>
        <?php while($p = $publicaciones->fetch_assoc()) { ?>
            <option value="<?= $p['id'] ?>"><?= $p['titulo'] ?></option>
        <?php } ?>
    </select>

    <button type="submit" class="btn btn-success mt-3">Guardar</button>
    <a href="listar.php" class="btn btn-secondary mt-3">Volver</a>
</form>
</body>
</html>
