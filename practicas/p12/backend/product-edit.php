<?php
    use TECWEB\MYAPI\Products as Products;
    require_once __DIR__ . '/myapi/Products.php';

    if (isset($_POST['id'])) {
        $jsonOBJ = json_decode(json_encode($_POST));
        $prodObj = new Products('marketzone');
        $prodObj-> edit($jsonOBJ);
        echo $prodObj->getData();
    }
?>