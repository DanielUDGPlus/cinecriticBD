<?php
include 'conexion.php';
require 'vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

// Configuración de Cloudinary
Configuration::instance([
  'cloud' => [
    'cloud_name' => 'dpebmoavx',
    'api_key'    => '292534632943836',
    'api_secret' => 'nQ_x4hsxKHSu2FZzek4wpZeUgOg'
  ],
  'url' => ['secure' => true]
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $titulo = $_POST['titulo'];
  $genero = $_POST['genero'];
  $calificacion = $_POST['calificacion'];
  $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
  $resena = $_POST['resena'];
  $enlace_trailer = $_POST['enlace_trailer'];

  // Obtener imagen actual
  $stmtActual = $conn->prepare("SELECT imagen_url FROM peliculas WHERE id = :id");
  $stmtActual->execute(['id' => $id]);
  $actual = $stmtActual->fetch(PDO::FETCH_ASSOC);
  $imagenActual = $actual['imagen_url'];

  $imagen_url = $imagenActual;

  // Si se subió una nueva imagen
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    try {
      $resultado = (new UploadApi())->upload($_FILES['imagen']['tmp_name'], [
        'folder' => 'cinecritic'
      ]);
      $imagen_url = $resultado['secure_url'];
    } catch (Exception $e) {
      echo "Error al subir nueva imagen a Cloudinary: " . $e->getMessage();
      exit;
    }
  }

  // Actualizar película (con o sin imagen)
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
    'imagen' => $imagen_url,
    'id' => $id
  ]);

  header("Location: editar.php");
  exit;
}
