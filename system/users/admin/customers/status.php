<?php
include '../../../function.php';


$id=$_GET['CustomerId'];
$status = $_GET['Status'];
 
$sql="UPDATE tbl_customers SET Status=$status WHERE CustomerId=$id";
$db=dbConn();
$results=$db->query($sql);

        header('location:customers.php');




?>