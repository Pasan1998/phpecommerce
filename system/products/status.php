<?php
if (($_SESSION['UserRole']) != 'manager') {
    header("Location:../login.php");
}?>
<?php
include '../function.php';


$id=$_GET['ProductID'];
$status = $_GET['ProductStatus'];
 
$sql="UPDATE tbl_products SET ProductStatus=$status WHERE ProductID=$id";
$db=dbConn();
$results=$db->query($sql);

        header('location:products.php');




?>