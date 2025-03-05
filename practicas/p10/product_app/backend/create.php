<?php
    include_once __DIR__.'/database.php';

    // OBTENER LOS DATOS DEL PRODUCTO
    $productoJson = file_get_contents("php://input");
    $producto = json_decode($productoJson, true);

    if ($producto) {
        // INSERTAR EL NUEVO PRODUCTO EN LA BASE DE DATOS
        $query = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen) 
                  VALUES ('{$producto['nombre']}', '{$producto['precio']}', '{$producto['unidades']}', 
                          '{$producto['modelo']}', '{$producto['marca']}', '{$producto['detalles']}', 
                          '{$producto['imagen']}')";

        if ($conexion->query($query)) {
            echo json_encode(["message" => "Producto agregado exitosamente."]);
        } else {
            echo json_encode(["error" => "Error al agregar producto: " . mysqli_error($conexion)]);
        }
    } else {
        echo json_encode(["error" => "Datos de producto no válidos."]);
    }

    $conexion->close();
?>
