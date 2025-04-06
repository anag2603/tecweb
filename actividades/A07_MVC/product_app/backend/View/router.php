<?php
    require_once __DIR__ . '/../Controller/controlador.php';

    use TECWEB\MYAPI\Control;

    $control = new Control();
    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? $_POST['action'] ?? null;

    if (!$action) {
        http_response_code(400);
        echo json_encode(['error' => 'No se especificó ninguna acción']);
        exit;
    }

    switch ($method) {
        //En caso de usar GET
        case 'GET':
            if ($action === 'list') {
                $control->list(); //Listamos al principio
            } elseif ($action === 'search') {
                $control->search($_GET['search'] ?? '');
            } elseif ($action === 'singleByName') {
                $control->singleByName($_GET['name'] ?? '');
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Acción GET no válida']);
            }
            break;

        //En caso de usar POST
        case 'POST':
            switch ($action) {
                case 'single':
                    $control->single($_POST['id'] ?? null);
                    break;
                case 'add':
                    $control->add($_POST);
                    break;
                case 'edit':
                    $control->edit($_POST);
                    break;
                case 'delete':
                    $control->delete($_POST['id'] ?? null);
                    break;
                case 'name':
                    $control->name($_POST['nombre'] ?? '');
                    break;
                default:
                    http_response_code(400);
                    echo json_encode(['error' => 'Acción POST no válida']);
            }
            break;
    }
?>