<?php
include_once __DIR__.'/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
$data = array(
    'status'  => 'error',
    'message' => 'Ya existe un producto con ese nombre'
);

if (!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JSON A OBJETO
    $jsonOBJ = json_decode($producto);

    // Verificar si el ID del producto está presente
    if (!isset($jsonOBJ->id)) {
        $data['message'] = "El ID del producto es necesario.";
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    // Verificar si el nombre del producto ya existe
    $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND id != {$jsonOBJ->id} AND eliminado = 0";
    $result = $conexion->query($sql);

    if ($result->num_rows == 0) {
        $conexion->set_charset("utf8");

        // Preparar la consulta para actualizar el producto
        $sql = "UPDATE productos SET 
                    nombre = '{$jsonOBJ->nombre}', 
                    marca = '{$jsonOBJ->marca}', 
                    modelo = '{$jsonOBJ->modelo}', 
                    precio = {$jsonOBJ->precio}, 
                    detalles = '{$jsonOBJ->detalles}', 
                    unidades = {$jsonOBJ->unidades}, 
                    imagen = '{$jsonOBJ->imagen}' 
                WHERE id = {$jsonOBJ->id}";

        if ($conexion->query($sql)) {
            $data['status'] = "success";
            $data['message'] = "Producto modificado";
        } else {
            $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($conexion);
        }
    } else {
        $data['message'] = "Ya existe un producto con ese nombre.";
    }

    $result->free();
    // Cierra la conexión
    $conexion->close();
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>