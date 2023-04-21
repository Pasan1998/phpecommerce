<?php

include '../system/function.php';
session_start();

$total = 0;

extract($_POST);
$db = dbConn();
if ($action == 'addcart' && $_SERVER['REQUEST_METHOD'] == 'POST') {

    //Finding the product by code
    $sql = "SELECT * FROM tbl_preorderproducts WHERE ProductID='$ProductID'";
    $result = $db->query($sql);

    $product = $result->fetch_assoc();

    $currentQty = $_SESSION['products'][$ProductID]['qty'] + 1; //Incrementing the product qty in cart

    $_SESSION['products'][$ProductID] = array('qty' => $currentQty, 'name' => $product['ProductName'], 'image' => $product['ProductImage'], 'price' => $product['ProductPrice']);
    $product = '';
    header("Location:index.php");
}


