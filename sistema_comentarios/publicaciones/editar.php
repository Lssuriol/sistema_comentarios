<?php
include("../conexion.php");

$id = $_GET['id'];
$resultado = $conexion->query("SELECT * FROM publicaciones WHERE id = $id");
$publicacion = $resultado->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $imagen_actual = $_POST['imagen_actual'];
    $nueva_imagen = $_FILES['nueva_imagen']['name'];

    
    if (!empty($nueva_imagen)) {
        $ruta_imagen = "../uploads/" . basename($nueva_imagen);
        move_uploaded_file($_FILES['nueva_imagen']['tmp_name'], $ruta_imagen);
        $imagen = $nueva_imagen;

        
        if (!empty($imagen_actual) && file_exists("../uploads/" . $imagen_actual)) {
            unlink("../uploads/" . $imagen_actual);
        }
    } else {
        $imagen = $imagen_actual;
    }

    $conexion->query("UPDATE publicaciones SET titulo='$titulo', imagen='$imagen' WHERE id=$id");
    header("Location: listar.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Publicación</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h2 class="mb-4">✏️ Editar Publicación</h2>

    <form action="" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Título:</label>
        <input type="text" name="titulo" class="form-control" value="<?php echo $publicacion['titulo']; ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Imagen actual:</label><br>
        <?php if (!empty($publicacion['imagen'])): ?>
          <img src="../uploads/<?php echo $publicacion['imagen']; ?>" width="120" class="rounded shadow">
        <?php else: ?>
          <p class="text-muted">No hay imagen disponible</p>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label class="form-label">Nueva imagen (opcional):</label>
        <input type="file" name="nueva_imagen" class="form-control">
      </div>

      <input type="hidden" name="imagen_actual" value="<?php echo $publicacion['imagen']; ?>">

      <button type="submit" class="btn btn-success">Guardar Cambios</button>
      <a href="listar.php" class="btn btn-secondary">Volver</a>
    </form>
  </div>
</body>
</html>
