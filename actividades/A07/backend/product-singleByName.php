<?php
    use TECWEB\MYAPI\Products as Products;
    require_once __DIR__ . '/myapi/Products.php';

    $name = $_GET['name'] ?? null;

    $prodObj = new Products('marketzone');
    $prodObj->singleByName($name);

    echo $prodObj->getData();
?>