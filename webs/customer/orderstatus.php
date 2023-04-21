


<?php
include '../function.php';


$productid=$_POST['productid'];
$orderid=$_POST['orderid'];
$qty=$_POST['qty'];
$customerid=$_POST['customerid'];
$orderstatus=5;

echo  $productid;
echo '<br>';
echo  $orderid;
echo '<br>';
echo  $qty;
echo '<br>';
echo  $customerid;
echo '<br>';
//$sql="UPDATE orderproducts SET orderstatusproduct=$status WHERE orderID=$orderID and  productid=$productid";

//update query of the order product table when customer select the cancel order this will change status of orderproduct table's orderstatusproduct to 5
$sql="UPDATE orderproducts SET orderstatusproduct=$orderstatus WHERE orderID=$orderid AND  productid=$productid AND CustomerId=$customerid  ";
$db=dbConn();
$results=$db->query($sql);

// update query for the table product table where the cancelled product id get and re
$sql2="UPDATE tbl_products SET Quantity=Quantity + $qty WHERE  productid=$productid";
$result=$db->query($sql2);


$cancelleddate=date('Y-m-d');
$sql3="INSERT INTO ordercancelled(productid,orderid,customerid,cancelleddate) VALUES ('$productid','$orderid','$customerid','$cancelleddate')";
$result3=$db->query($sql3);



//$ledgerproductqunatity= -$qty;

$sql4="INSERT INTO productledger(productid,quantity) VALUES ('$productid','$qty'";
$result4=$db->query($sql4);
      header('location:ordershistory.php?CustomerId=56');




?>