<?php ob_start(); ?>

<?php $signin = 'active'; ?>



<?php include 'header.php'; ?>
<?php
include 'menu.php';
?>
<?php

IF (5> 10 || 10>5)


if ($_SESSION['bankdetails'] == 'yes'){
    header("Location:index.php");
}
if ($_SESSION['coddetails'] == 'yes'){
    header("Location:index.php");
}
?>


<?php
$customeremail = @$_SESSION['Email'];
$customerid = @$_SESSION['CustomerId'];
$customercontact = @$_SESSION['Mobile'];
$customeraddress = @$_SESSION['Address'];
$customeraddress2 = @$_SESSION['Address2'];
$customercity = @$_SESSION['City'];
$customertitile = @$_SESSION['Title'];
$finaltotal = @$_SESSION['finaltotal'];
$totaldiscount = @$_SESSION['discount'] + @$_SESSION['discount2'];
$totalqunatity = @$_SESSION['testingquantity'];


$netdiscounts = @$_SESSION['totaldiscounts'];
?>
<br>
<?php
// echo'hoo';
print_r(@$totals);
// echo 'hoo';
$customername = $_SESSION['Title'] . " " . $_SESSION['First_Name'] . " " . $_SESSION['Last_Name'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    //seperate variables and values from the form
    extract($_POST);

    $Address = cleanInput($Address);
    $Address2 = cleanInput($Address2);
    $Mobile = cleanInput($Mobile);
    $City = cleanInput($City);

    $messages = array();

    //validate required fields

    if (empty($Address)) {
        $messages['error_address'] = "Customer Title  should not be empty!";
    }

    if (empty($Mobile)) {
        $messages['error_mobile'] = "Customer First Name should not be empty!";
    }
    if (empty($City)) {
        $messages['error_city'] = "Customer Last Name should not be empty!";
    }
    if (!isset($sType)) {
        $messages['error_stype'] = "The Type should be selected..!";
    }


    if (isset($sType)) {
        if ($sType == 'Cashondelivery') {
            print_r($sType);
            $orderstatus = 1;
        } else {
            print_r($sType);
            $orderstatus = 0;
        }
    }




    if (empty($messages)) {

        $orderid = rand();
        $_SESSION['orderreferencenumber']=$orderid;
        $db = dbConn();
        $AddDate = date('Y-m-d');
        //echo $sql = "INSERT INTO tbl_orders(orderID,CustomerName,customerId,customeremail, customercontact, deliveraddress, deliveraddress2, delivercity, grandtotal, totalquantity, totaldiscount,payementmethod, orderstatus,) VALUES ('$orderid','$customername','$customerid','$customeremail','$Mobile','$Address','$Address2','$City','$finaltotal','$totalqunatity','$totaldiscount','$sType','$orderstatus')";
        $sql1 = "INSERT INTO tbl_orders (orderID,CustomerName,customerId,customeremail,customercontact,deliveraddress,deliveraddress2,delivercity,grandtotal,totalquantity,totaldiscount,payementmethod,orderstatus,adddate) VALUES ('$orderid','$customername','$customerid','$customeremail','$Mobile','$Address','$Address2','$City','$finaltotal','$totalqunatity','$netdiscounts','$sType','$orderstatus','$AddDate')";
            $results = $db->query($sql1);
            
        $product_id = $db->insert_id;
         foreach ($_SESSION['products'] as $value) {
            $orderproductid = $value['productid'];
            $orderproductimage = $value['image'];
            $orderproductname = $value['name'];
            $orderproductqty = $value['qty'];
            //methan order id eka randomly genreate wenna damme eka nisa kelinma athana uda orderid eka create krpu varibale ekata call kla last id ekata call kre nathuwa
           echo $sql2 = "INSERT INTO orderproducts (orderID,Productname,productimage,productid,CustomerId,qty,orderstatusproduct) VALUE('$orderid','$orderproductname','$orderproductimage','$orderproductid','$customerid','$orderproductqty','$orderstatus')";
            $db->query($sql2);
            $_SESSION['asd']= $sql2;
            
            print_r($sql2);

        }


        $sql3="SELECT * FROM orderproducts WHERE orderID='$orderid'";
        $result12 = $db->query($sql3);
        
        while ($row = $result12->fetch_assoc()){
            
            //quantity eka 
            $qty = $row['qty'];
            $productId = $row['productid'];
            $updateQuery = "UPDATE tbl_products SET Quantity = Quantity -  $qty WHERE ProductID = $productId";
            $updateQuery2 = "UPDATE tbl_products SET ProductSold = ProductSold +  $qty WHERE ProductID = $productId";
            $result3 = $db->query($updateQuery);
             $result4 = $db->query($updateQuery2);
        }



       // print_r($sql2);
        //$result = $db->query($sql1);
        //print_r($result);
        unset($_SESSION['products']);
        // die();
        if (isset($sType)) {
            if ($sType == 'Cashondelivery') {
                
               header('Location:cod.php');
            } else {

                header('Location:bankdetails.php');
            }
        }
    }
}
?>







<section id="acv" class="section">
    <div class="section-title" >
        <h2 class="">Personal and Payments Details</h2>
    </div>
</section>





<div class="row">

    <div class="col-md-12">
        <div class="col-md-10 col-lg-10 col-xl-10 offset-xl-1">
            <form  method="POST"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >

                <div class="row  justify-content-center">
                    <div class="col-md-5" style="box-shadow: 5px 5px 5px 5px #888888;">
                        <h1 class="title text-center"> Delivery Details </h1>
                        <div class="form-outline mb-4">

                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">Name : </label>
                                <?= @$customername ?>
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">Email : </label>
                                <?= @$customeremail; ?>
                            </div>


                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">Address Line 1</label>
                                <input type="text" placeholder="" class="form-control form-control-sm" id="address" name="Address" value="<?= @$customeraddress; ?>">
                                <div class="text-danger"> <?= @$messages['error_address']; ?></div>
                            </div>

                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">Address Line 2</label>
                                <input type="text" placeholder="" class="form-control form-control-sm" id="address" name="Address2" value="<?= @$customeraddress2; ?>">

                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">Mobile Number</label>
                                <input type="text" placeholder="" class="form-control form-control-sm" id="phone" name="Mobile" value="<?= @$customercontact; ?>">
                                <div class="text-danger"> <?= @$messages['error_mobile']; ?></div>
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">City</label>
                                <input type="text" class="form-control form-control-sm" id="city" name="City" value="<?= @$customercity; ?>">
                                <div class="text-danger"> <?= @$messages['error_city']; ?></div>
                            </div>



                        </div>






                        <!-- Submit button -->


                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0 text-muted"></p>
                        </div>

                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5 tex" style="box-shadow: 5px 5px 5px 5px #888888;"><h1 class="title text-center"> Payment  Details </h1>
                        <div class="form-outline mb-4">

                            <div class="form-outline mb-2">
                                <div class="row">
                                    <div class="col-md-4 text-center">Product Name</div>
                                    <div class="col-md-4 text-center">Quantity</div>
                                    <div class="col-md-4 text-center">Price</div>
                                </div>
                                <?php
                                $total = 0;
                                $totals = 0;
                                foreach (@$_SESSION['products'] as $key => $value) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-4 text-center"><?= $value['name'] ?></div>
                                        <div class="col-md-4 text-center"><?= $value['qty'] ?></div>
                                        <div class="col-md-4 text-center"><?= number_format($value['price'] * $value['qty']) . '.00' ?></div>
                                        <?php $totals += $value['qty'] ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-4" for="form1Example13"> Grand quantity</div>
                                    <div class="col-md-4" for="form1Example13"> <?= $totalqunatity ?></div>
                                    <div class="col-md-4 text-center" for="form1Example13"> </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4" for="form1Example13"> Grand Total</div>
                                    <div class="col-md-4" for="form1Example13"></div>
                                    <div class="col-md-4 text-center" for="form1Example13"> <?= $finaltotal . '.00' ?></div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label>Select Payment method</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sType" id="Bank_transfer" value="Bank_transfer" <?php
                                if (@$sType == 'Bank_transfer') {
                                    echo "checked";
                                }
                                ?>>
                                    <label class="form-check-label" for="Bank_transfer">Bank Transfer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sType" id="Cashondelivery" value="Cashondelivery" <?php
                                    if (@$sType == 'Cashondelivery') {
                                        echo "checked";
                                    }
                                ?>>
                                    <label class="form-check-label" for="Cashondelivery">Cash on Delivery </label>
                                </div>

                                <div class="text-danger"> <?= @$messages['error_stype']; ?></div>
                            </div>






                        </div>
                    </div>
                </div>


                </br>
                <button type="submit" class="btn btn-primary btn-lg btn-block col-md-12">Place Order</button> 
            </form>
        </div>
    </div>

</div>









<?php
$finaltotal = $_SESSION['finaltotal'];

$customername = $_SESSION['CustomerId'];

echo $finaltotal;
echo $customername;

print_r($_SESSION);
echo 'break';
print_r(@$messages);
?>
<br><?php
$orderid = uniqid("Blue");
echo $orderid;
print_r($customercity);
print_r($totals);
print_r($totaldiscount);
print_r(@$result);
?> 
<br><?php
print_r($totalqunatity);
?>

<?php

?>
