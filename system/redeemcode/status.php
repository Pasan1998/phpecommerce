<?php
if (($_SESSION['UserRole']) != 'manager') {
    header("Location:../login.php");
}?>
<?php
include '../function.php';


$id=$_GET['RedeemcodeID'];
$status = $_GET['Status'];
 
$sql="UPDATE tbl_redeemcodes SET Status=$status WHERE RedeemcodeID=$id";
$db=dbConn();
$results=$db->query($sql);

        header('location:redeemcode.php');




?>