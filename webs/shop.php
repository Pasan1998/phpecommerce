<?php

$shop='active';
?> 


<?php
include 'header.php';

?>
<?php
include 'menu.php';

?>


    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Shop PAge</h2>
                <p></p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-samsung">Samsung</li>
                        <li data-filter=".filter-nokia">Nokia</li>
                        <li data-filter=".filter-apple">Apple</li>
                        <li data-filter=".filter-huawei">Huawei</li>
                    </ul>
                </div>
            </div>
                <?php
            $sql = "SELECT * FROM tbl_products WHERE ProductStatus=1 AND ProductCategory='Samsung'  ORDER BY ProductID Desc LIMIT 8 ";
            $db = dbConn();
            $result = $db->query($sql);
            ?>
            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                <div class="col-lg-4 col-md-6 portfolio-item filter-samsung">
                    <div class="portfolio-wrap">
                        <img src="../system/assets/images/products/<?= $row['ProductImage'] ?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4><?= $row['ProductName'] ?></h4>
                            <p><?= $row['ProductStatus'] ?></p>
                            <div class="portfolio-links">
                                <a href="../system/assets/images/products/<?= $row['ProductImage'] ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                
                    }}?>
                
                
                
                <?php
            $sql = "SELECT * FROM tbl_products WHERE ProductStatus=1 AND ProductCategory='Nokia'  ORDER BY ProductID Desc LIMIT 8 ";
            $db = dbConn();
            $result = $db->query($sql);
            ?>
            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                <div class="col-lg-4 col-md-6 portfolio-item filter-nokia">
                    <div class="portfolio-wrap">
                        <img src="../system/assets/images/products/<?= $row['ProductImage'] ?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4><?= $row['ProductName'] ?></h4>
                            <p><?= $row['ProductStatus'] ?></p>
                            <div class="portfolio-links">
                                <a href="assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                
                    }}?>
                
                
                <?php
            $sql = "SELECT * FROM tbl_products WHERE ProductStatus=1 AND ProductCategory='Huawei'  ORDER BY ProductID Desc LIMIT 8 ";
            $db = dbConn();
            $result = $db->query($sql);
            ?>
            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                <div class="col-lg-4 col-md-6 portfolio-item filter-huawei">
                    <div class="portfolio-wrap">
                        <img src="../system/assets/images/products/<?= $row['ProductImage'] ?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4><?= $row['ProductName'] ?></h4>
                            <p><?= $row['ProductStatus'] ?></p>
                            <div class="portfolio-links">
                                <a href="assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                
                    }}?>
                
                
                         <?php
            $sql = "SELECT * FROM tbl_products WHERE ProductStatus=1 AND ProductCategory='Apple'  ORDER BY ProductID Desc LIMIT 8 ";
            $db = dbConn();
            $result = $db->query($sql);
            ?>
            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                <div class="col-lg-4 col-md-6 portfolio-item filter-apple">
                    <div class="portfolio-wrap">
                        <img src="../system/assets/images/products/<?= $row['ProductImage'] ?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4><?= $row['ProductName'] ?></h4>
                            <p><?= $row['ProductStatus'] ?></p>
                            <div class="portfolio-links">
                                <a href="assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                
                    }}?>


        </div>
    </section><!-- End Portfolio Section -->

    <?php
include 'footer.php';

?>