<?php
use TECWEB\MYAPI\Products;
require_once __DIR__.'/myapi/Products.php';

$productos = new Products('marketzone', 'root', 'Cande02022004');
$productos->edit(json_decode(json_encode($_POST)));
echo $productos->getData();
