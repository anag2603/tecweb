<?php
header("Content-Type: application/json");

require_once 'myapi/DataBase.php';
require_once 'myapi/Products.php';

use TECWEB\MYAPI\Products;

$product = new Products("product_db"); // Ajusta con el nombre real de tu base de datos
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $product->single($_GET['id']);
        } elseif (isset($_GET['nombre'])) {
            $product->search($_GET['nombre']);
        } else {
            $product->list();
        }
        echo json_encode($product->getData());
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $product->add($data);
        echo json_encode($product->getData());
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        $product->edit($data);
        echo json_encode($product->getData());
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        $product->delete($data['id']);
        echo json_encode($product->getData());
        break;

    default:
        http_response_code(405);
        echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        break;
}