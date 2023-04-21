<?php
include '../system/config.php';

$_SESSION['coddetails']=null;
$_SESSION['bankdetails']=null;
?>


<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center bg-light" >

    <div class="container">
        <div class="row">
            <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up" style="color: #66ccff;">Welcome to BlueTech Electronics</h1>
                <h2 data-aos="fade-up" data-aos-delay="400" style="color: #99ccff">We have listed your most valueable products</h2>
                <div data-aos="fade-up" data-aos-delay="800">
                    <!--                    <a href="#about" class="btn-get-started scrollto">Get Started</a>-->
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
                <img src="assets/img/32.jpg" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section><!-- End Hero -->

<main id="main">

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients clients">
        <div class="container">

            <div class="row">
                <?php
                $sql = "SELECT * FROM tbl_category WHERE Status=1 ORDER BY AddDate Desc  ";
                $db = dbConn();
                $result = $db->query($sql);
                ?>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-lg-2 col-md-4 col-6">
                            <img src="<?= SYSTEM_PATH ?>assets/images/categories/<?= $row['categoryimage'] ?>" class="img-fluid"  width="5rem" alt="" data-aos="zoom-in">
                        </div>
                        <?php
                    }
                }
                ?>  

            </div>

        </div>
    </section><!-- End Clients Section -->


    <!-- ======= Recently added products start ======= -->
    <section id="abc" class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Newly Products</h2>
        </div>

        <?php
        $sql = "SELECT * FROM tbl_products WHERE ProductStatus = '1' ORDER BY ProductID Desc LIMIT 8 ";
        $db = dbConn();
        $result = $db->query($sql);
        ?>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-3 mb-2 pr-2 card portfolio-item ">
                        <div class="portfolio-wrap">
                            <img src="<?= SYSTEM_PATH ?>assets/images/products/<?= $row['ProductImage'] ?>" class="card-img-top"   alt="...">
                            <div class="portfolio-info">

                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['ProductName'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $row['ProductCategory'] ?></h6>
                                    <p class="card-text"><?= $row['ProductDescription'] ?></p>
                                    <p class="card-text">Rs<?= number_format($row['ProductPrice'], 2) ?></p>
                                    <div class="row">
                                        <div class="col-md-6">   <form method="post" action="shopping-cart.php">
                                                <button type="submit" name="action" value="addcart" class="btn btn-warning" <?= ($row['Quantity']) <= 0 ? 'disabled="disabled"' : '';?>>Add To Cart</button>
                                                <input type="hidden" name="ProductID" value="<?= $row['ProductID'] ?>">
                                            </form></div>
                                        <div class="col-md-6" style="background-color: #6699ff; border-radius: 5px;"><a href="product/viewproduct.php?ProductID=<?= $row['ProductID'] ?> " class="btn mr-2"><i class="fas fa-link"></i> View Product</a></div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>  


        </div>




    </section><!-- End most new products  -->




    <!-- ======= most sold  Section ======= -->
    <section id="" class="container bg-light">
        <div class="section-title" data-aos="fade-up">
            <h2>Most Sold</h2>
        </div>
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
            <?php
            $sql = "SELECT * FROM tbl_products WHERE ProductStatus=1 AND ProductSold>=5 LIMIT 8";
            $db = dbConn();
            $result = $db->query($sql);
            ?>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-3 mb-2 pr-2 card ">
                        <div class="portfolio-wrap">
                            <img src="<?= SYSTEM_PATH ?>assets/images/products/<?= $row['ProductImage'] ?>" class="card-img-top"  style="height:10rem;" alt="...">
                            <div class="portfolio-info">

                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['ProductName'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $row['ProductCategory'] ?></h6>
                                    <p class="card-text"><?= $row['ProductDescription'] ?></p>
                                    <p class="card-text">Rs<?= number_format($row['ProductPrice'], 2) ?></p>

                                    <form method="post" action="shopping-cart.php">
                                        <button type="submit" name="action" value="addcart" class="btn btn-warning">Add To Cart</button>
                                        <input type="hidden" name="ProductID" value="<?= $row['ProductID'] ?>">
                                    </form>
                                    <a href="product/viewproduct.php?ProductID=<?= $row['ProductID'] ?> " class="btn mr-2"><i class="fas fa-link"></i> View Product</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>  







    </section><!-- End most sold products  -->

    <!-- ======= Pre order Section ======= -->
    <section id="" class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Pre Order</h2>
        </div>
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
            <?php
            $sql = "SELECT * FROM tbl_preorderproducts WHERE ProductStatus=1";
            $db = dbConn();
            $result = $db->query($sql);
            ?>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-3 mb-2 pr-2 card ">
                        <div class="portfolio-wrap">
                            <img src="<?= SYSTEM_PATH ?>assets/images/products/<?= $row['ProductImage'] ?>" class="card-img-top"  style="height:10rem;" alt="...">
                            <div class="portfolio-info">

                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['ProductName'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $row['ProductCategory'] ?></h6>
                                    <p class="card-text"><?= $row['ProductDescription'] ?></p>
                                    <p class="card-text">Rs<?= number_format($row['ProductPrice'], 2) ?></p>
                                    <form method="post" action="shopping-cart_1.php">
                                        <button type="submit" name="action" value="addcart" class="btn btn-warning">Add To Cart</button>
                                        <input type="hidden" name="ProductID" value="<?= $row['ProductID'] ?>">
                                    </form>
                                    <a href="product/viewproduct.php?ProductID=<?= $row['ProductID'] ?> " class="btn mr-2"><i class="fas fa-link"></i> View Product</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>  







    </section><!-- End preorder products  -->

    <!-- ======= Sucess Stories Section ======= -->
    <section id="" class="container bg-light">
        <div class="section-title" data-aos="fade-up">
            <h2>Success Stories</h2>
        </div>
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
            <?php
            $sql = "SELECT * FROM tbl_stories WHERE SuccessStatus=1 ORDER BY AddDate Desc LIMIT 8 ";
            $db = dbConn();
            $result = $db->query($sql);
            ?>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-3 mb-2 pr-2 card ">
                        <div class="portfolio-wrap">
                            <img src="<?= SYSTEM_PATH ?>assets/images/stories/<?= $row['CustomerImage'] ?>" class="card-img-top" style="height:20rem;"  alt="...">
                            <div class="portfolio-info">

                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['CustomerName'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $row['ProductName'] ?></h6>
                                    <p class="card-text"><?= $row['CustomerDescription'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>  


    </section><!-- End Success Stories  -->



    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Testimonials</h2>
                <p>Magnam dolores commodi suscipit eum quidem consectetur velit</p>
            </div>
            <?php
            $sql = "SELECT * FROM tbl_customers,tbl_reviews  WHERE tbl_customers.CustomerId=tbl_reviews.CustomerId  AND tbl_reviews.status=1 ";
            $db = dbConn();
            $result = $db->query($sql);

            $totalcodes = $result->num_rows;
            ?>
            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="swiper-slide">
                                <div class="testimonial-wrap">
                                    <div class="testimonial-item">
                                        <img src="../system/assets/images/customers/<?= $row['CustomerImage'] ?>" style="width: 5rem" class="testimonial-img" alt="">
                                        <h3><?= $row['Title'] . " " . $row['FirstName'] . " " . $row['LastName'] ?></h3>
                                        <h4><?= $row['City'] ?></h4>
                                        <p>
                                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                            <?= $row['review'] ?>
                                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div>
                            </div><!-- End testimonial item -->
                        <?php }
                    } ?>
                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="assets/img/testimonials/testimonials-2.jpg"  class="testimonial-img" alt="">
                                <h3>Sara Wilsson</h3>
                                <h4>Designer</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                                <h3>Jena Karlis</h3>
                                <h4>Store Owner</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                                <h3>Matt Brandon</h3>
                                <h4>Freelancer</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial-item">
                                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                                <h3>John Larson</h3>
                                <h4>Entrepreneur</h4>
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->


    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Frequently Asked Questions</h2>
            </div>

            <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-5">
                    <i class="ri-question-line"></i>
                    <h4>Non consectetur a erat nam at lectus urna duis?</h4>
                </div>
                <div class="col-lg-7">
                    <p>
                        Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                    </p>
                </div>
            </div><!-- End F.A.Q Item-->

            <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-5">
                    <i class="ri-question-line"></i>
                    <h4>Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</h4>
                </div>
                <div class="col-lg-7">
                    <p>
                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim.
                    </p>
                </div>
            </div><!-- End F.A.Q Item-->

            <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                <div class="col-lg-5">
                    <i class="ri-question-line"></i>
                    <h4>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?</h4>
                </div>
                <div class="col-lg-7">
                    <p>
                        Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus.
                    </p>
                </div>
            </div><!-- End F.A.Q Item-->

            <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                <div class="col-lg-5">
                    <i class="ri-question-line"></i>
                    <h4>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</h4>
                </div>
                <div class="col-lg-7">
                    <p>
                        Aperiam itaque sit optio et deleniti eos nihil quidem cumque. Voluptas dolorum accusantium sunt sit enim. Provident consequuntur quam aut reiciendis qui rerum dolorem sit odio. Repellat assumenda soluta sunt pariatur error doloribus fuga.
                    </p>
                </div>
            </div><!-- End F.A.Q Item-->

            <div class="row faq-item d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="500">
                <div class="col-lg-5">
                    <i class="ri-question-line"></i>
                    <h4>Tempus quam pellentesque nec nam aliquam sem et tortor consequat?</h4>
                </div>
                <div class="col-lg-7">
                    <p>
                        Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                    </p>
                </div>
            </div><!-- End F.A.Q Item-->

        </div>
    </section><!-- End F.A.Q Section -->


</main><!-- End #main -->
<?php print_r($_SESSION); ?>