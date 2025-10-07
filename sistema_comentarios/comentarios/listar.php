<?php
include("../conexion.php");
$resultado = $conexion->query("SELECT c.*, p.titulo FROM comentarios c JOIN publicaciones p ON c.id_publicacion = p.id ORDER BY c.id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Comentarios</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<h2>💬 Lista de Comentarios</h2>
<a href="crear.php" class="btn btn-primary mb-3">+ Nuevo Comentario</a>
<a href="../publicaciones/listar.php" class="btn btn-secondary mb-3">📚 Ver Publicaciones</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Texto</th>
            <th>Fecha</th>
            <th>Publicación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['texto'] ?></td>
            <td><?= $row['fecha'] ?></td>
            <td><?= $row['titulo'] ?></td>
            <td>
                <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar comentario?')">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>
