<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplos 4 de POO con PHP</title>
</head>
<body>
    <?php
    require_once __DIR__.'/Tabla.php';

    $tab1 = new Tabla(2, 3, 'border: 1px solid');
    $tab1->cargar(0, 0, 'A');
    $tab1->cargar(0, 1, 'N');
    $tab1->cargar(0, 2, 'A');
    $tab1->cargar(1, 0, 'I');
    $tab1->cargar(1, 1, 'L');
    $tab1->cargar(1, 2, 'Y');
    $tab1->graficar();



    ?>
    
</body>
</html>