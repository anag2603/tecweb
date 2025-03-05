<?php
    include_once __DIR__.'/database.php';
//Se crea nuestro arreglo
    $data = array();
//Verificacion de ID
    if (isset($_POST['search'])) {
        $search = $conexion->real_escape_string($_POST['search']); // Para prevenir inyecciones SQL
        
        // SE REALIZA LA QUERY DE BÚSQUEDA CON 'LIKE' EN NOMBRE, MARCA Y DETALLES
        $query = "SELECT * FROM productos WHERE 
                  nombre LIKE '%{$search}%' OR 
                  marca LIKE '%{$search}%' OR 
                  detalles LIKE '%{$search}%'";

        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $data[] = $row;
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    }

    echo json_encode($data, JSON_PRETTY_PRINT);
?>



