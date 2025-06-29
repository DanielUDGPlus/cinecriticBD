<?php
$host = "dpg-d1gov27gi27c73c00ra0-a.oregon-postgres.render.com"; // Host externo de Render
$port = "5432";                          // Puerto por defecto de PostgreSQL
$dbname = "cinecriticbd";               // Nombre de tu base de datos
$user = "pancho";                        // Usuario proporcionado por Render
$password = "vfr8ZYRxSmCAvuy0VYmwzcn5yvwEJ2eX"; // Contraseña segura de Render

try {
    // Incluye sslmode=require para conexión segura con Render
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}
?>
