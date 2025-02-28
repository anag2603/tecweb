<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    
    <?php
    $producto = null;
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        @$link = new mysqli('localhost', 'root', 'Cande02022004', 'marketzone');
        if ($link->connect_errno) {
            die('Falló la conexión: ' . $link->connect_error);
        }
        if ($stmt = $link->prepare("SELECT * FROM productos WHERE id = ?")) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $producto = $result->fetch_assoc();
            $stmt->close();
        }
        $link->close();
    }
    if (!$producto) {
        die('<p>Error: Producto no encontrado.</p>');
    }
    ?>

    <form id="formularioProductos" action="update_producto.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
        <input type="hidden" name="imagen_actual" value="<?= htmlspecialchars($producto['imagen']) ?>"> <!-- Imagen actual -->

        <label>Nombre:</label> <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required maxlength="100"><br>
        <label>Marca:</label> <input type="text" name="marca" value="<?= htmlspecialchars($producto['marca']) ?>" required><br>
        <label>Modelo:</label> <input type="text" name="modelo" value="<?= htmlspecialchars($producto['modelo']) ?>" required maxlength="25"><br>
        <label>Precio:</label> <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" required min="100"><br>
        <label>Unidades:</label> <input type="number" name="unidades" value="<?= htmlspecialchars($producto['unidades']) ?>" required min="0"><br>
        <label>Detalles:</label> <textarea name="detalles" maxlength="250"><?= htmlspecialchars($producto['detalles']) ?></textarea><br>
        <label>Imagen:</label> <input type="file" name="imagen"><br>
        <button type="submit">Actualizar Producto</button>
    </form>
</body>
</html>
