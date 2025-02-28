<?php
// Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = 'Cande02022004'; 
$dbname = 'marketzone';

// Crear la conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $unidades = $_POST['unidades'];
    $detalles = $_POST['detalles'];

    // Manejo de la imagen (si se sube una nueva)
    if ($_FILES['imagen']['error'] == 0) {
        $imagen = $_FILES['imagen'];
        $imagen_nombre = $imagen['name'];
        $imagen_tmp = $imagen['tmp_name'];
        $imagen_destino = 'uploads/' . basename($imagen_nombre);
        move_uploaded_file($imagen_tmp, $imagen_destino);
    } else {
        // Mantener la imagen actual si no se sube una nueva
        $imagen_destino = $_POST['imagen_actual'];  // Asegúrate de enviar la ruta actual en el formulario
    }

    // Preparar la consulta SQL para actualizar el producto
    $sql = "UPDATE productos SET nombre = ?, marca = ?, modelo = ?, precio = ?, unidades = ?, detalles = ?, imagen = ? WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Vincular los parámetros
        $stmt->bind_param("sssdisss", $nombre, $marca, $modelo, $precio, $unidades, $detalles, $imagen_destino, $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Producto actualizado exitosamente.";
            header("Location: get_productos_xhtml_v2.php");  // Redirigir después de actualizar
            exit;
        } else {
            echo "Error al actualizar el producto: " . $stmt->error;
        }
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
