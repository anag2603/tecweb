<?php
    include_once __DIR__.'/database.php';

    $producto = file_get_contents('php://input');
    $data = array(
        'status'  => 'error',
        'message' => 'No se encontró el producto para actualizar'
    );
    
    if(!empty($producto)) {
        $jsonOBJ = json_decode($producto);
        

        $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND marca = '{$jsonOBJ->marca}' AND modelo = '{$jsonOBJ->modelo}' AND id != {$jsonOBJ->id} ";
        $checkResult = $conexion->query($sql);
        
        if ($checkResult->num_rows > 0) {
            $data['message'] = "No se pudo editar, ya existe un producto con ese nombre, marca y modelo";
        } else {

            $sql = "SELECT * FROM productos WHERE id = {$jsonOBJ->id} ";
            $result = $conexion->query($sql);
            
            if ($result->num_rows > 0) {
                // SI EL PRODUCTO EXISTE, SE ACTUALIZA
                $conexion->set_charset("utf8");
                $sql = "UPDATE productos SET 
                            nombre = '{$jsonOBJ->nombre}',
                            marca = '{$jsonOBJ->marca}', 
                            modelo = '{$jsonOBJ->modelo}', 
                            precio = {$jsonOBJ->precio}, 
                            detalles = '{$jsonOBJ->detalles}', 
                            unidades = {$jsonOBJ->unidades}, 
                            imagen = '{$jsonOBJ->imagen}' 
                        WHERE id = {$jsonOBJ->id} AND eliminado = 0";
                
                if ($conexion->query($sql)) {
                    $data['status'] = "success";
                    $data['message'] = "Producto actualizado correctamente";
                } else {
                    $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($conexion);
                }
            }
            
            $result->free();
        }
        
        $checkResult->free();
        $conexion->close();
    }
    echo json_encode($data, JSON_PRETTY_PRINT);
?>