<?php
include_once __DIR__.'/database.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Buscar el producto por ID
    $sql = "SELECT * FROM productos WHERE id = {$id} AND eliminado = 0";
    $result = $conexion->query($sql);
    
    $data = array();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }

    $result->free();
    $conexion->close();

    echo json_encode($data, JSON_PRETTY_PRINT);
}
?>
