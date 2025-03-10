<?php
    include_once __DIR__ . '/database.php'; // Incluir la conexión a la base de datos

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "SELECT * FROM productos WHERE id = $id;";
        $result = mysqli_query($conexion, $query);  // Usamos la conexión ya establecida

        if(!$result) {
            die('Query Failed');
        }
        $json = array();
        while($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'nombre' => $row['nombre'],
                'id' => $row['id'],
                'precio' => $row['precio'],
                'unidades' => $row['unidades'],
                'modelo' => $row['modelo'],
                'marca' => $row['marca'],
                'detalles' => $row['detalles'],
                'imagen' => $row['imagen']
            );
        }
        echo json_encode($json[0]);
    }
?>