<?php
include_once __DIR__.'/database.php';

// OBTENER LOS DATOS DEL PRODUCTO
$productoJson = file_get_contents("php://input");
$producto = json_decode($productoJson, true);

// Verificación de que los datos sean recibidos
if (!$producto) {
    echo json_encode(["error" => "No se recibieron datos correctamente."]);
    exit();
}

// Validar campos requeridos
if (empty($producto['nombre']) || empty($producto['marca']) || empty($producto['modelo'])) {
    echo json_encode(["error" => "Los campos 'nombre', 'marca' y 'modelo' son requeridos."]);
    exit();
}

// Preparar la consulta para verificar si el producto ya existe
$checkQuery = "SELECT * FROM productos 
               WHERE ((nombre = ? AND marca = ?) 
               OR (marca = ? AND modelo = ?)) 
               AND eliminado = 0";

$stmt = $conexion->prepare($checkQuery);
$stmt->bind_param('ssss', $producto['nombre'], $producto['marca'], $producto['marca'], $producto['modelo']);
$stmt->execute();
$checkResult = $stmt->get_result();

if ($checkResult && $checkResult->num_rows > 0) {
    echo json_encode(["error" => "El producto ya existe en la base de datos."]);
} else {
    // Preparar la consulta para insertar el nuevo producto
    $insertQuery = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($insertQuery);
    $stmt->bind_param('sssssss', $producto['nombre'], $producto['precio'], $producto['unidades'], 
                      $producto['modelo'], $producto['marca'], $producto['detalles'], $producto['imagen']);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Producto agregado exitosamente."]);
    } else {
        echo json_encode(["error" => "Error al agregar producto: " . $conexion->error]);
    }
}

$stmt->close();
$conexion->close();
?>


