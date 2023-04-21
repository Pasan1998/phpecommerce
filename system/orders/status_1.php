
<?php
include '../function.php';


$orderID=$_GET['orderID'];
$productid=$_GET['productid'];
$status = $_GET['changestatus'];


$sql="UPDATE orderproducts SET orderstatusproduct=$status WHERE orderID=$orderID and  productid=$productid";
$db=dbConn();
$results=$db->query($sql);

        header('location:orders.php');




?>