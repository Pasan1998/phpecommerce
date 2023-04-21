<?php
if (($_SESSION['UserRole']) != 'manager') {
    header("Location:../login.php");
}?>
<?php
include '../function.php';


$id=$_GET['Id'];
$status = $_GET['Status'];
 
$sql="UPDATE tbl_products SET ProductStatus=$status WHERE ProductID=$id";
$db=dbConn();
$results=$db->query($sql);

        header('location:products.php');




?>