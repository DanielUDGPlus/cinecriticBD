<?php
$host = "localhost";          // O usa la IP o URL de Render/Railway si migras
$port = "5432";
$dbname = "Cinecritic";       // ← Aquí el nombre correcto
$user = "postgres";           // Sustituye si tu nombre de usuario es distinto
$password = "6754";           // Asegúrate de usar el real

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}
?>
