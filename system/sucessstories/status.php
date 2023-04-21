<?php
include '../function.php';


$id=$_GET['SuccessID'];
$status = $_GET['SuccessStatus'];
 
$sql="UPDATE tbl_stories SET SuccessStatus=$status WHERE SuccessID=$id";
$db=dbConn();
$results=$db->query($sql);

        header('location:allsuccesstories.php');




?>