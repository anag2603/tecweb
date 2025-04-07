<?php
use TECWEB\MYAPI\Products;
require_once __DIR__ . '/myapi/Products.php';

$producto = new Products("marketzone", "root", "Cande02022004");

$existe = false;

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $producto->search($nombre);
    $data = json_decode($producto->getData(), true);
    $existe = !empty($data);
}

echo json_encode(['existe' => $existe]);
