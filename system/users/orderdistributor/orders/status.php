
<?php
include '../../../function.php';


$id=$_GET['orderID'];
$status = $_GET['orderstatus'];
 $db=dbConn();
 $sql="UPDATE tbl_orders SET orderstatus=$status WHERE orderID=$id";
 print_r($sql);

$results=$db->query($sql);
if($results){
         header('location:banktransfer.php');
}else{
         header('location:index.php');
}
   




?>