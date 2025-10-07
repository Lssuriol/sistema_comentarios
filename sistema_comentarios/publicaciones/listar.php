<?php
include("../conexion.php");
$resultado = $conexion->query("SELECT * FROM publicaciones");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Publicaciones</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h2 class="mb-4">📚 Lista de Publicaciones</h2>

    <a href="crear.php" class="btn btn-primary mb-3">+ Nueva Publicación</a>
    <a href="../comentarios/listar.php" class="btn btn-secondary mb-3">💬 Ver Comentarios</a>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Imagen</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while($fila = $resultado->fetch_assoc()): ?>
          <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['titulo']; ?></td>
            <td>
              <?php if (!empty($fila['imagen'])): ?>
                <img src="../uploads/<?php echo $fila['imagen']; ?>" width="100" class="rounded shadow">
              <?php else: ?>
                <span class="text-muted">Sin imagen</span>
              <?php endif; ?>
            </td>
            <td>
              <a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
              <a href="eliminar.php?id=<?php echo $fila['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta publicación?')">Eliminar</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
