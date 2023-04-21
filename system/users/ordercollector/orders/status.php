
<?php
include '../../../function.php';


$id=$_GET['orderID'];
$status = $_GET['changestatus'];
 $db=dbConn();
 $sql="UPDATE tbl_orders SET orderstatus=$status WHERE orderID=$id";
 print_r($sql);

$results=$db->query($sql);
if($results){
         header('location:orders.php');
}else{
         header('location:orders.php');
}
   




?>