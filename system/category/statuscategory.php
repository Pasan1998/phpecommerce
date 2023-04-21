

<?php
include '../function.php';


$id=$_GET['Id'];
$status = $_GET['Status'];
 
$sql="UPDATE tbl_category SET Status=$status WHERE id=$id";
$db=dbConn();
$results=$db->query($sql);

        header('location:categories.php');




?>