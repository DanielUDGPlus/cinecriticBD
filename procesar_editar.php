<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $titulo = $_POST['titulo'];
  $genero = $_POST['genero'];
  $calificacion = $_POST['calificacion'];
  $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
  $resena = $_POST['resena'];
  $enlace_trailer = $_POST['enlace_trailer'];

  // Obtener ruta actual de la imagen
  $stmtActual = $conn->prepare("SELECT imagen_url FROM peliculas WHERE id = :id");
  $stmtActual->execute(['id' => $id]);
  $actual = $stmtActual->fetch(PDO::FETCH_ASSOC);
  $imagenActual = $actual['imagen_url'];

  // Si se subió una nueva imagen
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombreTemp = $_FILES['imagen']['tmp_name'];
    $nombreArchivo = basename($_FILES['imagen']['name']);
    $rutaDestino = 'imagenes/' . uniqid() . '_' . $nombreArchivo;

    // Mueve la imagen al directorio de imágenes
    move_uploaded_file($nombreTemp, $rutaDestino);

    // Borra la imagen anterior (opcional)
    if (file_exists($imagenActual) && strpos($imagenActual, 'imagenes/') === 0) {
      unlink($imagenActual);
    }

    // Actualizar con nueva imagen
    $stmt = $conn->prepare("UPDATE peliculas 
      SET titulo = :titulo, genero = :genero, calificacion = :calificacion,
          fecha_lanzamiento = :fecha, resena = :resena, enlace_trailer = :trailer,
          imagen_url = :imagen
      WHERE id = :id");

    $stmt->execute([
      'titulo' => $titulo,
      'genero' => $genero,
      'calificacion' => $calificacion,
      'fecha' => $fecha_lanzamiento,
      'resena' => $resena,
      'trailer' => $enlace_trailer,
      'imagen' => $rutaDestino,
      'id' => $id
    ]);
  } else {
    // Actualizar sin cambiar imagen
    $stmt = $conn->prepare("UPDATE peliculas 
      SET titulo = :titulo, genero = :genero, calificacion = :calificacion,
          fecha_lanzamiento = :fecha, resena = :resena, enlace_trailer = :trailer
      WHERE id = :id");

    $stmt->execute([
      'titulo' => $titulo,
      'genero' => $genero,
      'calificacion' => $calificacion,
      'fecha' => $fecha_lanzamiento,
      'resena' => $resena,
      'trailer' => $enlace_trailer,
      'id' => $id
    ]);
  }

  header("Location: editar.php");
  exit;
}
