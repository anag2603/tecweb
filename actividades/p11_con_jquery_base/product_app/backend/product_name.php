<?php
include('database.php'); // Incluye la conexión a la base de datos

if (isset($_GET['name'])) {
    $name = $_GET['name'];  // Obtiene el nombre del producto enviado en la solicitud GET

    // Consulta SQL para verificar si el nombre del producto ya existe en la base de datos
    $query = "SELECT * FROM productos WHERE nombre = ?";
    $stmt = $conn->prepare($query);  // Prepara la consulta para evitar SQL injection
    $stmt->bind_param('s', $name);  // Enlaza el parámetro del nombre
    $stmt->execute();  // Ejecuta la consulta
    $result = $stmt->get_result();  // Obtiene los resultados

    // Si ya existe un producto con ese nombre
    if ($result->num_rows > 0) {
        echo json_encode(["error" => "El producto con ese nombre ya existe."]);
    } else {
        // Si el nombre no existe, es válido
        echo json_encode(["success" => "Nombre válido."]);
    }
}
?>
