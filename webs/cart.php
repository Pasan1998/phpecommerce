<?php ob_start(); ?>    

<?php
extract($_GET);

include 'header.php';
include 'menu.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$action == 'del') {
    $product = $_SESSION['products'];
    unset($product[$sku]);
    $_SESSION['products'] = $product;
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$action == 'empty') {
    unset($_SESSION['products']);
    header('Location:index.php');
}
?>


<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);

    $redeemcode = cleanInput($redeemcode);
    echo $redeemcode;

    $messages = array();

    if (empty($redeemcode)) {
        $messages['error_redeemcode'] = "Redeem code did not entered";
    }



    if (!empty($redeemcode)) {

        $sql = "SELECT * FROM tbl_redeemcodes WHERE RedeemCode='$redeemcode' AND Status='1'";
        $db = dbConn();
        $results = $db->query($sql);
        if ($results->num_rows > 0) {
            $row = $results->fetch_assoc();
            $_SESSION['RedeemcodeID'] = $row['RedeemcodeID'];
            $percentage = $row['Percentage'];
            echo $percentage;

            //echo '<script>alert("Promotional code is Active")</script>';
            $messages['error_redeemcode_sucess'] = "This redeemcode is Active";
        } else {
            //echo '<script>alert("Promotional code is De-active")</script>';
            $messages['error_redeemcode_error'] = "This redeemcode is Inactive ";
        }
    }
}
?>
<br>
<br>
<br>
<main>
    <section id="signup" class="section-bg ">
        <div class="section-title" >
            <h2>Cart Page</h2>
        </div>
    </section>

    <div class="row ">
        <div class="col-md-6 p-5">

            <div class="text-end p-3" >
                <div class="col-md-4"></div> 
                <div class="col-md-4"></div> 
                <div class="col-md-4">
                    <a href="cart.php?action=empty"> Empty My Cart</div>

                </a></div> 

            <table border="1" style="border:1px solid #055160;width: 100%; padding: 10px 10px;" class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th width="100">Image</th>
                        <th width="100">Name</th>
                        <th width="100"> Price</th>
                        <th width="100">Qty</th>
                        <th width="100">Amount</th>
                        <th width="100">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $i = 0;
                    foreach (@$_SESSION['products'] as $key => $value) {
                        ?>
                        <tr>
                            <td  style="width:50%"><img src="../system/assets/images/products/<?= $value['image'] ?>" class="w-100" ></td>
                            <td><?= $value['name'] ?></td> 
                            <td><?= $value['price'] ?></td>
                            <td><?= $value['qty'] ?></td>
                            <td><?php
                                $amount = $value['qty'] * $value['price'];
                                $total += $amount;
                                echo $amount;
                                ?></td>

                            <td><a href="cart.php?action=del&sku=<?= $key ?>">Delete</a></td>
                        </tr>




                        <?php
                        $i++;
                    }
                    $_SESSION['testingquantity'] = $i;
                    ?>

                    <?php
                    $totals = 0;
                    foreach (@$_SESSION['products'] as $key => $value) {
                        ?>
                    <div class="row">



                        <?php $totals += $value['qty'] ?>
                    </div>
                    <?php
                }
                ?>

                <tfoot>
                    <tr>
                        <td colspan="5">Grand Total</td>

                        <td><?= $total ?></td>
                    </tr>
                    <tr>
                        <td colspan="5">Discount</td>

                        <td><?php
                            $disscount2 = $total * 0.02;

                            echo $total * 0.02
                            ?></td>
                    </tr>
                    <tr>
                        <td colspan="5">Net Total</td>

                        <td><?php echo $total = $total - $total * 0.02 ?></td>
                    </tr>
                </tfoot>
                </tbody>
            </table>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <label class="form-label" for="form1Example13">Enter Redeemcode </label>
                <input type="text" name="redeemcode" value="<?= @$redeemcode ?>"> 
<!--                <div class="alert alert-warning" role="alert">
                    <?= @$messages['error_redeemcode']; ?>
                </div>-->
                <?php
                if (@$messages['error_redeemcode']){?>
                    <div class="alert alert-warning" role="alert"> <?= @$messages['error_redeemcode']; ?></div> <?php
                }else{
                    
                }
                ?>
                    <?php
                if (@$messages['error_redeemcode_sucess']){?>
                    <div class="alert alert-success" role="alert"> <?= @$messages['error_redeemcode_sucess']; ?></div> <?php
                }else{
                    
                }
                ?>
                    <?php
                if (@$messages['error_redeemcode_error']){?>
                    <div class="alert alert-danger" role="alert"> <?= @$messages['error_redeemcode_error']; ?></div> <?php
                }else{
                    
                }
                ?>
                

                <button type="submit" > check</button>




                <div><?php
                    $discount = $total / 100 * @$percentage;

                    $_SESSION['discount'] = $discount;

                    $total = $total - $discount;

                    $_SESSION['finaltotal'] = $total;
                    ?></div>

                <?php if (!empty(@$percentage)) { ?>

                    <?php // echo $total ?><?php } else {
                    ?>
                    <?php // echo $total - ($total / 100 * @$percentage)  ?><?php
                }
                ?>

            </form>

            <?php
            $totaldiscounts = $discount + $disscount2;
            $_SESSION['totaldiscounts'] = $totaldiscounts;
            ?>
            <label class="form-label" for="form1Example13">NET TOTAL AFTER ERDEEM CODE </label>
            <td><?php echo $total ?></td>
            <br>
            <?php
            if (!isset($_SESSION['CustomerId'])) {
                ?>
                <a href="checkout.php"> login + check out </a>
            <?php } else {
                ?>
                <a href="processcheckout.php"> Checkout </a><?php
            }
            ?>



        </div>
        <div class="col-md-6 p-5">  
            <?php
            foreach (@$_SESSION['products'] as $key => $value) {
                ?> 

                <div class="col-md-11 ">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                        <img src="../system/assets/images/products/<?= $value['image'] ?>" class="w-100" >
    <!--                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(4).webp"
                                             class="w-100" />-->
                                        <a href="#!">
                                            <div class="hover-overlay">
                                                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <h5><?= $value['name'] ?></h5>
                                    <div class="d-flex flex-row">
                                        <div class="text-danger mb-1 me-2">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <span>reviews</span>
                                    </div>
                                    <div class="mt-1 mb-0 text-muted small">
                                        <span><?= $value['name'] ?></span>
                                        <span class="text-primary"> • </span>
                                        <span>Light weight</span>
                                        <span class="text-primary"> • </span>
                                        <span>Best finish<br /></span>
                                    </div>
                                    <div class="mb-2 text-muted small">
                                        <span>Unique design</span>
                                        <span class="text-primary"> • </span>
                                        <span>For men</span>
                                        <span class="text-primary"> • </span>
                                        <span>Casual<br /></span>
                                    </div>
                                    <p class="text-truncate mb-4 mb-md-0">
                                        There are many variations of passages of Lorem Ipsum available, but the
                                        majority have suffered alteration in some form, by injected humour, or
                                        randomised words which don't look even slightly believable.
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>

    <?php
    print_r($_SESSION);
    print_r($discount);
    print_r($disscount2);
    print_r($_SESSION['products']);
    ?>
</main>



<?php ob_end_flush(); ?>