<?php
use TECWEB\MYAPI\Products;
require_once __DIR__ . '/../vendor/autoload.php';

$productos = new Products('marketzone', 'root', 'Cande02022004');
$productos->single($_POST['id']);
echo $productos->getData();
