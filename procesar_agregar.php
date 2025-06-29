<?php
include 'conexion.php';
require 'vendor/autoload.php'; // Asegúrate de que esté instalada la SDK

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

// Configurar Cloudinary (usa tus datos reales)
Configuration::instance([
  'cloud' => [
    'cloud_name' => 'dpebmoavx',
    'api_key' => '292534632943836',
    'api_secret' => 'nQ_x4hsxKHSu2FZzek4wpZeUgOg'
  ],
  'url' => [
    'secure' => true
  ]
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'];
  $genero = $_POST['genero'];
  $calificacion = $_POST['calificacion'];
  $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
  $resena = $_POST['resena'];
  $enlace_trailer = $_POST['enlace_trailer'];

  $imagen_url = null;

  // Subida a Cloudinary
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
    try {
      $resultado = (new UploadApi())->upload($_FILES['imagen']['tmp_name'], [
        'folder' => 'cinecritic' // Puedes cambiar el nombre de la carpeta en Cloudinary
      ]);
      $imagen_url = $resultado['secure_url']; // URL segura de la imagen subida
    } catch (Exception $e) {
      echo "Error al subir imagen a Cloudinary: " . $e->getMessage();
      exit;
    }
  }

  // Guardar en base de datos
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
