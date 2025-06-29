<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'];
  $genero = $_POST['genero'];
  $calificacion = $_POST['calificacion'];
  $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
  $resena = $_POST['resena'];
  $enlace_trailer = $_POST['enlace_trailer'];

  // Subida de imagen
  $imagen_url = null;
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    $nombre_final = time() . '_' . basename($_FILES['imagen']['name']);
    $ruta_destino = 'imagenes/' . $nombre_final;

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
      $imagen_url = $ruta_destino;
    }
  }

  // Insertar en la BD
  $stmt = $conn->prepare("INSERT INTO peliculas (titulo, genero, calificacion, fecha_lanzamiento, resena, enlace_trailer, imagen_url)
                        VALUES (:titulo, :genero, :calificacion, :fecha_lanzamiento, :resena, :enlace_trailer, :imagen_url)");

  $stmt->execute([
    'titulo' => $titulo,
    'genero' => $genero,
    'calificacion' => $calificacion,
    'fecha_lanzamiento' => $fecha_lanzamiento,
    'resena' => $resena,
    'enlace_trailer' => $enlace_trailer,
    'imagen_url' => $imagen_url
  ]);


  header("Location: index.php");
  exit;
}
?>
