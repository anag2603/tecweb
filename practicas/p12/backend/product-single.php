<?php
    use TECWEB\MYAPI\Products as Products;
    require_once __DIR__ . '/myapi/Products.php';
    
    $id = $_POST['id'] ?? null;
    
    $prodObj = new Products('marketzone');
    $prodObj->single($id);
    
    echo $prodObj->getData();
?>