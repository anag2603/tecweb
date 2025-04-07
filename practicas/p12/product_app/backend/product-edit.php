<?php
require_once __DIR__ . '/../vendor/autoload.php';
use TECWEB\MYAPI\Products;

$productos = new Products('marketzone', 'root', 'Cande02022004');
$productos->edit(json_decode(json_encode($_POST)));
echo $productos->getData();
