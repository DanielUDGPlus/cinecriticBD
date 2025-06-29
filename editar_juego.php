<?php
include 'conexion.php';

if (!isset($_GET['id'])) {
  echo "ID no proporcionado.";
  exit;
}

$id = $_GET['id'];

// Obtener datos del juego
$stmt = $conn->prepare("SELECT * FROM juegos WHERE id = :id");
$stmt->execute(['id' => $id]);
$juego = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$juego) {
  echo "Juego no encontrado.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Juego</title>
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
            <li><a href="index.php#juegos">Juegos</a></li>
            <li><a href="juegos.php">Ranking</a></li>
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
          <h2>Editar: <?php echo htmlspecialchars($juego['nombre']); ?></h2>
          <form class="formulario-edicion" action="procesar_editar.php" method="post">
            <input type="hidden" name="id" value="<?php echo $juego['id']; ?>">

            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($juego['nombre']); ?>" required>

            <label>Género:</label>
            <input type="text" name="genero" value="<?php echo htmlspecialchars($juego['genero']); ?>" required>

            <label>Calificación (0-100):</label>
            <input type="number" name="calificacion" min="0" max="100" value="<?php echo $juego['calificacion']; ?>" required>

            <label>Fecha de lanzamiento:</label>
            <input type="date" name="fecha_lanzamiento" value="<?php echo $juego['fecha_lanzamiento']; ?>" required>

            <label>Descripción:</label>
            <textarea name="descripcion" required><?php echo htmlspecialchars($juego['descripcion']); ?></textarea>

            <button type="submit">Guardar cambios</button>
          </form>

          <a href="editar.php" class="boton-volver">← Volver</a>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
