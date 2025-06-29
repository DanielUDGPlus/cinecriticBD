<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinecritic</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="logo_pestana.png" type="image/png">
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
            <li><a href="#peliculas">Películas</a></li>
            <li><a href="agregar.php">Agregar</a></li>
            <li><a href="eliminar.php">Eliminar</a></li>
            <li><a href="editar.php">Editar</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <main>
      <a>Novedades</a>
      <section id="peliculas" class="juegos-container">
        <?php
        include 'conexion.php';
        $query = "SELECT * FROM peliculas ORDER BY id DESC LIMIT 5";
        $result = $conn->query($query);

        foreach ($result as $row): ?>
          <div class="juego-card">
          <h3><?= htmlspecialchars($row['titulo']) ?></h3>
          <img src="<?= htmlspecialchars($row['imagen_url']) ?>" alt="<?= htmlspecialchars($row['titulo']) ?>" loading="eager">

          <p><strong>Género:</strong> <?= htmlspecialchars($row['genero']) ?></p>
          <p><strong>Calificación:</strong> <?= htmlspecialchars($row['calificacion']) ?>/10</p>
          <p><strong>Fecha de lanzamiento:</strong>
            <?= date('d/m/Y', strtotime($row['fecha_lanzamiento'])) ?>
          </p>
          <p><strong>Reseña:</strong> <?= htmlspecialchars($row['resena']) ?></p>

          <a href="<?= htmlspecialchars($row['enlace_trailer']) ?>" target="_blank">Trailer</a>
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
