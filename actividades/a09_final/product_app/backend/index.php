<?php
require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use TECWEB\MYAPI\Create;
use TECWEB\MYAPI\Read;
use TECWEB\MYAPI\Update;
use TECWEB\MYAPI\Delete;

$app = AppFactory::create();
$app->setBasePath('/tecweb/actividades/a09_final/product_app/backend');
$app->addBodyParsingMiddleware();

$app->get('/product/{id}', function ($request, $response, $args) {
    $read = new Read();
    $data = $read->getById($args['id']);
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/products', function ($request, $response) {
    $read = new Read();
    $data = $read->getAll();
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/products/{search}', function ($request, $response, $args) {
    $read = new Read();
    $data = $read->search($args['search']);
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/product', function ($request, $response) {
    $create = new Create();
    $data = $create->insert($request->getParsedBody());
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->put('/product', function ($request, $response) {
    $update = new Update();
    $data = $update->update($request->getParsedBody());
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->delete('/product', function ($request, $response) {
    $delete = new Delete();
    $data = $delete->delete($request->getParsedBody()['id']);
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();