<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    <?php
    if(isset($_GET['tope']))
        $tope = $_GET['tope'];
    else
        die('<script>alert("Parámetro tope no detectado...");</script>');

    if (!empty($tope) && is_numeric($tope))
    {
        /** SE CREA EL OBJETO DE CONEXION */
        @$link = new mysqli('localhost', 'root', 'Cande02022004', 'marketzone');	

        /** comprobar la conexión */
        if ($link->connect_errno) 
        {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
        }

        /** Crear la consulta con sentencia preparada para seguridad */
        if ($stmt = $link->prepare("SELECT * FROM productos WHERE unidades <= ?")) 
        {
            $stmt->bind_param("i", $tope);
            $stmt->execute();
            $result = $stmt->get_result();

            /** Almacena los resultados */
            $productos = $result->fetch_all(MYSQLI_ASSOC);

            $stmt->close();
        }

        $link->close();
    }
    ?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Productos con Unidades Menores o Iguales a <?= htmlspecialchars($tope) ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h3 class="mt-4">Productos con Unidades ≤ <?= htmlspecialchars($tope) ?></h3>
            <br/>
            
            <?php if (!empty($productos)) : ?>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Unidades</th>
                            <th scope="col">Detalles</th>
                            <th scope="col">Imagen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $row) : ?>
                            <tr>
                                <th scope="row"><?= htmlspecialchars($row['id']) ?></th>
                                <td><?= htmlspecialchars($row['nombre']) ?></td>
                                <td><?= htmlspecialchars($row['marca']) ?></td>
                                <td><?= htmlspecialchars($row['modelo']) ?></td>
                                <td>$<?= htmlspecialchars($row['precio']) ?></td>
                                <td><?= htmlspecialchars($row['unidades']) ?></td>
                                <td><?= utf8_encode($row['detalles']) ?></td>
                                <td><img src="<?= htmlspecialchars($row['imagen']) ?>" width="100" alt="Imagen producto"/></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="alert alert-warning">No se encontraron productos con unidades menores o iguales a <?= htmlspecialchars($tope) ?>.</p>
            <?php endif; ?>
        </div>
    </body>
</html>
