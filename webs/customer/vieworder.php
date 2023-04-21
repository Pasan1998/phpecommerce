<?php include '../header.php';?>

<?php include '../menu.php';?>
<br>
<br>
<br>
<br>
<br>
<?php

if(!isset($_SESSION['CustomerId'])){
    header("Location:../signin/signin.php");
}

?>
<?php

if ($_SERVER ['REQUEST_METHOD'] == "GET") {
    extract($_GET);
    $db = dbConn();
    $sql = "SELECT * FROM tbl_orders WHERE orderID='$orderID'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    print_r($row);
    echo $orderID;
}
?>

