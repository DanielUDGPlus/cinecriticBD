<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Película - Cinecritic</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="logo_pestana.png" type="image/png">
  <style>
    body {
      background-image: url('fondo_sitio.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

    .formulario-pelicula input,
    .formulario-pelicula textarea {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }

    .formulario-pelicula label {
      font-weight: bold;
      margin-top: 10px;
      display: block;
    }

    .formulario-pelicula button {
      background-color: #222;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      margin-top: 15px;
    }

    .formulario-pelicula button:hover {
      background-color: #444;
    }
  </style>

  <!-- Agrega el script para el menú hamburguesa -->
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
      <section class="juegos-container detalle-juego">
        <div class="juego-card">
          <h2 style="text-align:center;">Agregar nueva película</h2>
          <form class="formulario-pelicula" action="procesar_agregar.php" method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="genero">Género:</label>
            <input type="text" name="genero" id="genero" required>

            <label for="calificacion">Calificación (1-10):</label>
            <input type="number" name="calificacion" id="calificacion" min="1" max="10" required>

            <label for="fecha_lanzamiento">Fecha de lanzamiento:</label>
            <input type="date" name="fecha_lanzamiento" id="fecha_lanzamiento" required>

            <label for="resena">Reseña:</label>
            <textarea name="resena" id="resena" rows="4" required></textarea>

            <label for="enlace_trailer">Enlace al trailer:</label>
            <input type="text" name="enlace_trailer" id="enlace_trailer">

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" accept="image/*" required>

            <button type="submit">Guardar película</button>
          </form>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
