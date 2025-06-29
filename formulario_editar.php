<?php
include 'conexion.php';

if (!isset($_GET['id'])) {
  header('Location: editar.php');
  exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM peliculas WHERE id = :id");
$stmt->execute(['id' => $id]);
$pelicula = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pelicula) {
  echo "Película no encontrada.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Película - Cinecritic</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="logo_pestana.png" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      background-image: url('fondo_sitio.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
  </style>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const hamburger = document.getElementById("hamburger");
      const menuLinks = document.querySelector(".menu-links");
      hamburger.addEventListener("click", function () {
        menuLinks.classList.toggle("show");
      });
    });
  </script>
</head>
<body>
  <div class="container">
    <header>
      <div class="menu">
        <a href="index.php">
          <img src="logo_cinecritic.png" alt="Logo del sitio" id="logo">
        </a>
        <button class="hamburger" id="hamburger">&#9776;</button>
        <nav class="menu-links">
          <ul>
            <li><a href="index.php#peliculas">Películas</a></li>
            <li><a href="agregar.php">Agregar</a></li>
            <li><a href="eliminar.php">Eliminar</a></li>
            <li><a href="editar.php">Editar</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <main>
      <section class="juegos-container detalle-juego">
        <div class="juego-card">
          <h2 style="text-align:center;">Editar película</h2>
          <form class="formulario-pelicula" action="procesar_editar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $pelicula['id'] ?>">

            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($pelicula['titulo']) ?>" required>

            <label for="genero">Género:</label>
            <input type="text" name="genero" id="genero" value="<?= htmlspecialchars($pelicula['genero']) ?>" required>

            <label for="calificacion">Calificación (1-10):</label>
            <input type="number" name="calificacion" id="calificacion" min="1" max="10" value="<?= $pelicula['calificacion'] ?>" required>

            <label for="fecha_lanzamiento">Fecha de lanzamiento:</label>
            <input type="date" name="fecha_lanzamiento" id="fecha_lanzamiento" value="<?= $pelicula['fecha_lanzamiento'] ?>" required>

            <label for="resena">Reseña:</label>
            <textarea name="resena" id="resena" rows="4" required><?= htmlspecialchars($pelicula['resena']) ?></textarea>

            <label for="enlace_trailer">Enlace al trailer:</label>
            <input type="text" name="enlace_trailer" id="enlace_trailer" value="<?= htmlspecialchars($pelicula['enlace_trailer']) ?>">

            <label>Imagen actual:</label>
            <img src="<?= htmlspecialchars($pelicula['imagen_url']) ?>" alt="Imagen actual" style="max-width:150px; display:block; margin-bottom:10px;">
            <label for="imagen">Cambiar imagen (opcional):</label>
            <input type="file" name="imagen" id="imagen" accept="image/*">

            <button type="submit">Guardar cambios</button>
          </form>
        </div>
      </section>
    </main>

    <footer>
      <p>Curso: Conceptualización de servicios en la nube</p>
      <p>Nombre: Alexis Daniel Moran Ramos</p>
    </footer>
  </div>
</body>
</html>
