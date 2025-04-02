<?php
 use TECWEB\MYAPI\Products as Products;
 require_once __DIR__ . '/myapi/Products.php';
 
  $jsonOBJ = json_decode(json_encode($_POST));
  $prodObj = new Products('marketzone');
  $prodObj->add($jsonOBJ);
  echo $prodObj->getData();
?>