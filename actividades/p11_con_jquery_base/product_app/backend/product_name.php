<?php
include_once __DIR__.'/database.php';

$data = array();
$error = false;

// Verificar que se haya recibido el nombre
if (isset($_GET['name'])) {
    $name = $_GET['name'];

    // Usar 'name' exactamente para evitar coincidencias parciales
    $sql = "SELECT * FROM productos WHERE nombre = '{$name}' AND eliminado = 0";

    if ($result = $conexion->query($sql)) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Si existe un producto con el mismo nombre, marcar error
        if (count($rows) > 0) {
            $error = true;
        }

        $result->free();
    } else {
        die('Query Error: ' . mysqli_error($conexion));
    }

    $conexion->close();
}

// Devolver JSON con el error si existe
echo json_encode(["error" => $error], JSON_PRETTY_PRINT);
?>

