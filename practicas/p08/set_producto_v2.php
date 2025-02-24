<?php
@$link = new mysqli('localhost', 'root', 'Cande02022004', 'marketzone');	

if ($link->connect_errno) {
    die('Falló la conexión: '.$link->connect_error.'<br/>');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['name']);
    $marca = trim($_POST['marca']);
    $modelo = trim($_POST['modelo']);
    $precio = trim($_POST['precio']);
    $detalles = trim($_POST['detalles']);
    $unidades = trim($_POST['unidades']);
    
    // Manejo del archivo de imagen
    $imagen = '';
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $imagenTmp = $_FILES['img']['tmp_name'];
        $imagenName = basename($_FILES['img']['name']);
        $imagenPath = 'uploads/' . $imagenName;

        if (move_uploaded_file($imagenTmp, $imagenPath)) {
            $imagen = $imagenPath; // Ruta de la imagen guardada
        } else {
            die("Error al subir la imagen.");
        }
    }

    if (empty($nombre) || empty($marca) || empty($modelo) || $precio <= 0 || $unidades < 0) {
        die("Por favor, llena todos los campos.");
    }

    $verificar_producto = "SELECT id FROM productos WHERE nombre=? AND marca=? AND modelo=?";
    $stmt = $link->prepare($verificar_producto);
    $stmt->bind_param("sss", $nombre, $marca, $modelo);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        die("ERROR: El producto ya existe en la base de datos.");
    }
/* Consulta ORIGINAL (no usa los nombres de las columnas)
$sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado)
        VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
*/
// Modificación para usar los nombres de columnas y no insertar valores para las columnas `id` ni `eliminado`
$sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen)
VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

    if ($link->query($sql)) {
        echo 'Resumen de productos insertados:<br/>';
        echo 'PRODUCTO:<br/>';
        echo '<strong>Producto insertado con ID:</strong>' . $link->insert_id . '<br/>';
        echo '<strong>Nombre del producto:</strong>' . $nombre . '<br/>';
        echo '<strong>Marca: </strong>' . $marca . '<br/>';
        echo '<strong>Modelo: </strong>' . $modelo . '<br/>';
        echo '<strong>Precio: </strong>' . $precio . '<br/>';
        echo '<strong>Detalles/Descripción: </strong>' . $detalles . '<br/>';
        echo '<strong>Cantidad de unidades: </strong>' . $unidades . '<br/>';
        if (!empty($imagen)) {
            echo '<p><strong>Imagen:</strong></p><br/>';
            echo '<img src="' . $imagen . '" alt="Imagen del producto" style="max-width: 100%; border-radius: 5px;">';
        }
    } else {
        echo 'El Producto no pudo ser insertado.';
    }

} else {
    echo 'No hay datos por insertar.';
}

$link->close();
?>
