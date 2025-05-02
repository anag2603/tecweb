<?php
require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use TECWEB\MYAPI\Create;
use TECWEB\MYAPI\Read;
use TECWEB\MYAPI\Update;
use TECWEB\MYAPI\Delete;

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->get('/product/{id}', function ($request, $response, $args) {
    $reader = new Read();
    $result = $reader->getById($args['id']);
    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/products', function ($request, $response) {
    $reader = new Read();
    $result = $reader->getAll();
    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/products/{search}', function ($request, $response, $args) {
    $reader = new Read();
    $result = $reader->search($args['search']);
    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/product', function ($request, $response) {
    $creator = new Create();
    $data = $request->getParsedBody();
    $result = $creator->insert($data);
    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->put('/product', function ($request, $response) {
    $updater = new Update();
    $data = $request->getParsedBody();
    $result = $updater->update($data);
    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->delete('/product', function ($request, $response) {
    $deleter = new Delete();
    $data = $request->getParsedBody();
    $result = $deleter->delete($data['id']);
    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();