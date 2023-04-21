<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>


<?php
if ($_SERVER ['REQUEST_METHOD'] == "GET") {
    extract($_GET);
    $db = dbConn();
    $sql = "SELECT * FROM tbl_products WHERE ProductID='$ProductID'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    echo $ProductID;
}
?>

<!-- ======= Contact Section ======= -->
<!--<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

        

        <div class="row"><div class="section-title">
            <h2><?= $row['ProductName'] ?></h2>
            <p>.</p>
        </div>



            <div class="col-lg-5 d-flex align-items-center">
                <img src="../../system/assets/images/products/<?= $row['ProductImage'] ?>"  style="height:30rem" alt="" class="img-fluid" data-aos="zoom-in">

            </div>

            <div class="col-lg-7 mt-5 mt-lg-0  align-items-stretch">

                <div class="row">
<?= $row['ProductName'] ?>
                </div>
                <div class="row">
<?= $row['ProductCategory'] ?>
                </div>
                <div class="row">
<?= $row['ProductPrice'] ?>
                </div>
                <div class="row">
<?= $row['Camera'] ?>
                </div>
                <div class="row">
<?= $row['Battery'] ?>
                </div>
                <div class="row">
<?= $row['Storage'] ?>
                </div>
                <div class="row">
<?= $row['Warranty'] ?>
                </div>
                <div class="row">
<?= $row['SelectYear'] ?>
                </div>
                 <div class="row">
<?= $row['ProductDescription'] ?>
                </div>
                 
<?php
echo $ProductID;
echo $ProductID
?>
                

            </div>

        </div>

    </div>
</section> End Contact Section -->

<section>
    <div class="section-title">
        <h2><?= $row['ProductName'] ?></h2>

    </div>
    <div class="super_container">

        <div class="single_product">
            <div class="container-fluid" style=" background-color: #fff; padding: 11px;">
                <div class="row">
                    <div class="col-lg-2 order-lg-1 order-2">
                        <ul class="image_list">


                        </ul>
                    </div>
                    <div class="col-lg-5 order-lg-2 order-1">
                        <div class="image_selected"><img src="../../system/assets/images/products/<?= $row['ProductImage'] ?>" style="width:50rem;"  class="img-fluid"  alt=""></div>
                    </div>
                    <div class="col-lg-5 order-3">
                        <div class="product_description">

                            <div class="product_name"> <?= $row['ProductDescription'] ?></div>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_reviews WHERE ProductID='$ProductID'";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            $totalreviews = $result->num_rows;
                            ?>
                            <?php
                            if ($result->num_rows > 0) {
                                $sum = 1;
                                while ($row = $result->fetch_assoc()) {


                                    $rating = $row['reviewrating'];
                                    $sum = $sum + $rating;
                                }
                            }
                            ?>





                            <?php
                            echo @$sum;
                            if (@$sum) {
                                @$star = @$sum / @$totalreviews;
                                @$star = (round($star));
                            } else {
                                
                            }
                            ?>
                            <br>

                            <?php
                            if (@$star) {
                                // set the number of stars to display
                                for ($i = 0; $i < $star; $i++) {
                                    echo '&#9733; '; // display a star symbol
                                }
                            } else {
                                
                            }
                            ?>
                            <?php
                            if (@$star) {
                                echo (round($star));
                            } else {
                                echo 0;
                            }
                            ?> Star
                            <div class="product-rating"><span class="badge badge-success"><?php  @$star==null ? '0' :$star ; ?> Star</span> <span class="rating-review"></span></div>

                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_products WHERE ProductID='$ProductID'";
                            $result = $db->query($sql);
                            $row = $result->fetch_assoc();
                            ?>
                            <div> <span class="product_price">Rs<?= number_format($row['ProductPrice'], 2) ?></span> 
    <!--                            <strike class="product_discount">  <span style='color:black'>₹ 2,000<span> </strike>-->
                            </div>
<!--                        <div> <span class="product_saved">You Saved:</span> <span style='color:black'>₹ 2,000<span> </div>-->
                            <hr class="singleline">
                            <div> <span class="product_info">EMI starts at ₹ 2,000. No Cost EMI Available<span><br> <span class="product_info">Warranty: 6 months warranty<span><br> <span class="product_info">7 Days easy return policy<span><br> <span class="product_info">7 Days easy return policy<span><br> <span class="product_info">In Stock: 25 units sold this week<span> </div>
                                                                        <div>
                                                                            <div class="row">
                                                                                <div class="col-md-5">
                                                                                    <div class="br-dashed">
                                                                                        <div class="row">
                                                                                            <div class="col-md-3 col-xs-3"> <img src="https://img.icons8.com/color/48/000000/price-tag.png"> </div>
                                                                                            <div class="col-md-9 col-xs-9">
                                                                                                <div class="pr-info"> <span class="break-all">Get 5% instant discount + 10X rewards @ RENTOPC</span> </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-7"> </div>
                                                                            </div>
                                                                            <div class="row" style="margin-top: 15px;">
                                                                                <div class="col-xs-6" style="margin-left: 15px;"> <span class="product_options">RAM Options</span><br> <button class="btn btn-primary btn-sm">4 GB</button> <button class="btn btn-primary btn-sm">8 GB</button> <button class="btn btn-primary btn-sm">16 GB</button> </div>
                                                                                <div class="col-xs-6" style="margin-left: 55px;"> <span class="product_options">Storage Options</span><br> <button class="btn btn-primary btn-sm">500 GB</button> <button class="btn btn-primary btn-sm">1 TB</button> </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr class="singleline">
                                                                        <div class="order_info d-flex flex-row">
                                                                            <form action="#">
                                                                        </div>
                                                                        <div class="row">

                                                                            <div class="col-xs-6"> <button type="button" class="btn btn-primary shop-button">Add to Cart</button> <button type="button" class="btn btn-success shop-button">Buy Now</button>
                                                                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                        </div>
                                                                        </div>
                                                                        <section>
                                                                            <div class="row row-underline">
                                                                                <div class="section-title">
                                                                                    <h2>Specification</h2>

                                                                                </div>

                                                                            </div>
                                                                            <div class="row">

                                                                                <div class="col-md-4"></div>
                                                                                <div class="col-md-8">
                                                                                    <table class="col-md-6">
                                                                                        <tbody>
                                                                                            <tr class="row mt-10">
                                                                                                <td class="col-md-4"><span class="p_specification">Sales Package :</span> </td>
                                                                                                <td class="col-md-8">
                                                                                                    <ul>
                                                                                                        <li>2 in 1 Laptop, Power Adaptor, Active Stylus Pen, User Guide, Warranty Documents</li>
                                                                                                    </ul>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr class="row mt-10">
                                                                                                <td class="col-md-4"><span class="p_specification">Model Number :</span> </td>
                                                                                                <td class="col-md-8">
                                                                                                    <ul>
                                                                                                        <li> 14-dh0107TU </li>
                                                                                                    </ul>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr class="row mt-10">
                                                                                                <td class="col-md-4"><span class="p_specification">Part Number :</span> </td>
                                                                                                <td class="col-md-8">
                                                                                                    <ul>
                                                                                                        <li>7AL87PA</li>
                                                                                                    </ul>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr class="row mt-10">
                                                                                                <td class="col-md-4"><span class="p_specification">Color :</span> </td>
                                                                                                <td class="col-md-8">
                                                                                                    <ul>
                                                                                                        <li>Black</li>
                                                                                                    </ul>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr class="row mt-10">
                                                                                                <td class="col-md-4"><span class="p_specification">Suitable for :</span> </td>
                                                                                                <td class="col-md-8">
                                                                                                    <ul>
                                                                                                        <li>Processing & Multitasking</li>
                                                                                                    </ul>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr class="row mt-10">
                                                                                                <td class="col-md-4"><span class="p_specification">Processor Brand :</span> </td>
                                                                                                <td class="col-md-8">
                                                                                                    <ul>
                                                                                                        <li>Intel</li>
                                                                                                    </ul>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>


                                                                            </div>
                                                                        </section>

                                                                        </div>
                                                                        </div>
                                                                        </div>
                                                                        </section>


<?php include '../footer.php'; ?>