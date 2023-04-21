<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>
<br>
<br><br><br><br><br>
<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
    $db= dbConn();
     $sql= "SELECT * FROM tbl_users WHERE UserId='$UserId'";
     $results= $db->query($sql);
     $row = $results->fetch_assoc();
             
    echo $UserId;
    }
?>