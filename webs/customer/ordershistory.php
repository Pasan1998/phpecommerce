<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>
<?php
if (!isset($_SESSION['CustomerId'])) {
    header("Location:../signin/signin.php");
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $CustomerId = $_GET['CustomerId'];
    echo $sql = "SELECT * FROM tbl_orders,orderproducts  WHERE tbl_orders.orderID=orderproducts.orderID AND orderproducts.CustomerId=$CustomerId";
    $db = dbConn();
    $results = $db->query($sql);
}
?>
<main>
    <section id="acv" class="section">
        <div class="section-title" >
            <h2 class="">Personal and Payments Details</h2>
        </div>
    </section>



    <section>
        <div class="container">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>

                        <th>#</th>
                        <th>Order Id</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Amount</th>
                        <th>Discount</th>
                        <th>Payment method</th>
                        <th>Payment method</th>
                        <th>View Order</th>
                        <th>Order Status</th>
                        <th>Add Review</th>
                        <th>Cancellation availability</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($results->num_rows > 0) {
                        $i = 1;
                        while ($row = $results->fetch_assoc()) {
                            ?>
                            <tr>

                                <td><?= $i ?></td>
                                <td><?= $row['orderID'] ?></td>
                                <td><?= $row['Productname'] ?></td>
                                <td><img class="img-fluid" style="width: 10rem;" src="../../system/assets/images/products/<?= $row['productimage']; ?>" > </td>
                                <td ><?= $row['grandtotal'] ?></td>
                                <td ><?= $row['qty'] ?></td>
                                <td><?= $row['totaldiscount'] ?></td>
                                <td><?= $row['payementmethod'] ?></td>


                                <!--                                    <td>
                                                    <form method="get" action="status_1.php" >
                                                        <input type="hidden" name="orderID" value="<?= $row['orderID'] ?>">
                                                        <select name="changestatus" >
                                                            <option>--</option>
                                                            <option value="0">Not Proccessing</option>
                                                            <option value="1">Proccessing</option>
                                                            <option value="2">Packed</option>
                                                            <option value="3">Hand Over Delivery</option>
                                                            <option value="4">Delivered</option>
                                                            <option value="5">Cancelled</option>
                                                           
                                                            
                                                        </select>
                                                        <button type="submit" >update </button>

                                                    </form>
                                                </td>-->
                                <td >
                                    <a href="vieworder.php?orderID=<?= $row['orderID'] ?>">View <?= $row['orderstatusproduct'] ?> </a></td>




                                <td > <?php
                                    if
                                    ($row['orderstatusproduct'] == 0) {
                                        ?>
                                        <div class="p-2 text-center" style="background-color: #ff6666;"> Not Proccessed</div> <?php
                                    } else if ($row['orderstatusproduct'] == 1) {
                                        ?>
                                        <div class="p-2 text-center" style="background-color: #ffff99"> Proccessing</div> <?php
                                    } else if ($row['orderstatusproduct'] == 2) {
                                        ?>
                                        <div class="p-2 text-center" style="background-color: #9999ff"> Packed</div> <?php
                                    } else if ($row['orderstatusproduct'] == 3) {
                                        ?>
                                        <div class="p-2 text-center" style="background-color: #99ffff"> Handed to deliver</div> <?php
                                    } else if ($row['orderstatusproduct'] == 4) {
                                        ?>
                                        <div class="p-2 text-center" style="background-color: #009966"> Delivered </div> <?php
                                    } else if ($row['orderstatusproduct'] == 5) {
                                        ?>
                                        <div class="p-2 text-center" style="background-color: #cc0033"> Cancelled </div> <?php
                                    }
                                    ?></td> 



                                <td>
                                    <?php
                                    if
                                    ($row['orderstatus'] == 4) {
                                        ?>
                                        <form action="reviewpage.php" method="post">
                                            <input type='hidden' name='productid' value='<?= $row['productid'] ?>'>
                                            <button type="submit">
                                                Add Review
                                            </button>
                                        </form> <?php } else {
                                        ?>
                                        <h5> Not Available</h5> <?php }
                                    ?>

                                </td>


                                <td class="text-center"><?php
                                    $currentdate = date('Ymd');
                                    $timestamp = strtotime($currentdate);
                                    $currentdatenumber = date('Ymd', $timestamp);

                                    $orderdate = $row ['adddate'];
                                    $timestamp = strtotime($orderdate);
                                    $orderdatenumber = date('Ymd', $timestamp);

                                    if (($currentdatenumber - $orderdatenumber) < 1) {
                                        echo "Applicable";
                                    } else {
                                        echo 'Not Applicable';
                                    }
                                    ?>
                                </td>


                                <td><?php
                                    if (($currentdatenumber - $orderdatenumber) < 1) {
                                        $cancellationavaibleno = "";
                                    } else {
                                        $cancellationavaibleno = "disabled";
                                    }

                                    if ($row['orderstatusproduct'] == 5) {
                                        $cancellationavaibleno = "disabled";
                                    }
                                    ?>
                                    <form action="orderstatus.php" method="POST" >
                                        <input type='hidden' name='productid' value='<?= $row['productid'] ?>'>
                                        <input type='hidden' name='orderid' value='<?= $row['orderID'] ?>'>
                                        <input type='hidden' name='qty' value='<?= $row['qty'] ?>'>
                                        <input type='hidden' name='customerid' value='<?= $_SESSION['CustomerId'] ?>'>
                                        <button class=" " <?= $cancellationavaibleno ?>> Cancel </button>
                                    </form>

                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </tbody>

            </table>  
        </div>

    </section>

</main>
<?php include '../footer.php'; ?> 
<?php print_r($_SESSION); ?>