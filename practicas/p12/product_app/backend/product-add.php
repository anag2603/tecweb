<?php
use TECWEB\MYAPI\Products;
require_once __DIR__ . '/../vendor/autoload.php';

$productos = new Products('marketzone', 'root', 'Cande02022004');
$productos->add(json_decode(json_encode($_POST)));
echo $productos->getData();
