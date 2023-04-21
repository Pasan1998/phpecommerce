
<?php
include '../function.php';


$id=$_GET['ProductID'];
$status = $_GET['changestatus'];


$sql="UPDATE tbl_products SET ProductStatus=$status WHERE ProductID=$id";
$db=dbConn();
$results=$db->query($sql);

        header('location:products.php');




?>