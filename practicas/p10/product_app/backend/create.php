<?php
include_once __DIR__.'/database.php';

// OBTENER LOS DATOS DEL PRODUCTO
$productoJson = file_get_contents("php://input");
$producto = json_decode($productoJson, true);

if ($producto) {
    // Validación: Verificar si el producto ya existe
    $nombre = $producto['nombre'];
    $marca = $producto['marca'];
    $modelo = $producto['modelo'];

    // Se verifica si el producto ya existe en la base de datos con 'eliminado' en 0
    $query = "SELECT * FROM productos WHERE 
              (nombre = '{$nombre}' AND marca = '{$marca}' OR marca = '{$marca}' AND modelo = '{$modelo}') 
              AND eliminado = 0";
    
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        echo json_encode(["error" => "El producto ya existe."]);
    } else {
        // Si no existe, insertamos el nuevo producto
        $insertQuery = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen, eliminado) 
                        VALUES ('{$producto['nombre']}', '{$producto['precio']}', '{$producto['unidades']}', 
                                '{$producto['modelo']}', '{$producto['marca']}', '{$producto['detalles']}', 
                                '{$producto['imagen']}', 0)";
        
        if ($conexion->query($insertQuery)) {
            echo json_encode(["message" => "Producto agregado exitosamente."]);
        } else {
            echo json_encode(["error" => "Error al agregar producto: " . mysqli_error($conexion)]);
        }
    }
} else {
    echo json_encode(["error" => "Datos de producto no válidos."]);
}

$conexion->close();
?>
