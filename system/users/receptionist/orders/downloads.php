<?php

include '../../../function.php';

$orderID = $_GET['orderID'];
$db = dbConn();
// fetch file to download from database
$sql = "SELECT * FROM tbl_orders WHERE orderID = '$orderID'";

$result = $db->query($sql);

$file = mysqli_fetch_assoc($result);
print_r($file);

$filename=$row['bankslip'];



header("Content-type: ".$file['bankslip']);
header("Content-length: ".$file['bankslip']);
header("Content-Disposition: attachment; filename=".$file['bankslip']);





?>