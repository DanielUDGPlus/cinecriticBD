<?php
include 'conexion.php';

if (isset($_POST['eliminar_ids']) && is_array($_POST['eliminar_ids'])) {
    $ids = $_POST['eliminar_ids'];
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    // Cambiamos la tabla de juegos a peliculas
    $stmt = $conn->prepare("DELETE FROM peliculas WHERE id IN ($placeholders)");
    $stmt->execute($ids);
}

header("Location: eliminar.php");
exit;
?>
