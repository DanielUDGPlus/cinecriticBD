<?php
include 'conexion.php';

// Obtener todas las películas
$stmt = $conn->query("SELECT * FROM peliculas ORDER BY fecha_lanzamiento DESC");
$peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Películas - Cinecritic</title>
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

    .boton-editar {
      margin-top: 10px;
      background-color: #007bff;
      color: white;
      padding: 10px 16px;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
    }

    .boton-editar:hover {
      background-color: #0056b3;
    }
  </style>

  <!-- Script para el menú hamburguesa -->
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
        <!-- Botón hamburguesa -->
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
      <h2 style="text-align:center;">Editar películas</h2>
      <section id="peliculas" class="juegos-container" style="flex-wrap: wrap;">
        <?php foreach ($peliculas as $pelicula): ?>
          <div class="juego-card">
            <h3><?= htmlspecialchars($pelicula['titulo']) ?></h3>
            <img src="<?= htmlspecialchars($pelicula['imagen_url']) ?>" alt="<?= htmlspecialchars($pelicula['titulo']) ?>" loading="eager">
            <p><strong>Género:</strong> <?= htmlspecialchars($pelicula['genero']) ?></p>
            <p><strong>Calificación:</strong> <?= htmlspecialchars($pelicula['calificacion']) ?>/10</p>
            <p><strong>Fecha:</strong> <?= date('d/m/Y', strtotime($pelicula['fecha_lanzamiento'])) ?></p>
            <p><?= htmlspecialchars($pelicula['resena']) ?></p>
            <a href="<?= htmlspecialchars($pelicula['enlace_trailer']) ?>" target="_blank">Trailer</a>

            <a class="boton-editar" href="formulario_editar.php?id=<?= $pelicula['id'] ?>">Editar</a>
          </div>
        <?php endforeach; ?>
      </section>
    </main>

    <footer>
      <p>Curso: Conceptualización de servicios en la nube</p>
      <p>Nombre: Alexis Daniel Moran Ramos</p>
    </footer>
  </div>
</body>
</html>
