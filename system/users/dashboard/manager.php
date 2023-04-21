<?php $dashboard = 'active'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 ">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 text-danger">Manage Operation</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <!--            <div class="btn-group me-2">
                            <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Manage Product</a>  
                        </div>
                        <div class="btn-group me-2">
                            <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Manage Cancelled product</a>
                        </div>
                         <div class="btn-group me-2">
                            <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Manage Returned product</a>
                        </div>
                         <div class="btn-group me-2">
                            <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Manage Defect product</a>
                        </div>-->
            <!--            <div class="btn-group me-2">
                            <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">List of Return Products</a>
                        </div>-->

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div style="width: 500px;">
        <canvas id="myChart"></canvas>
    </div>
    <script>
        // === include 'setup' then 'config' above ===
        const labels = [12, 19, 3, 5, 2, 3];
        const data = {
            labels: labels,
            datasets: [{
                    label: 'My First Dataset',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        var myChart = new Chart(
                document.getElementById('myChart'),
                config
                );
    </script>


    
    
    
     <div style="width: 500px;">
        <canvas id="myChart"></canvas>
    </div>
    <script>
        // === include 'setup' then 'config' above ===
        const labels = [12, 19, 3, 5, 2, 3];
        const data = {
            labels: labels,
            datasets: [{
                    label: 'My First Dataset',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        var myChart = new Chart(
                document.getElementById('myChart'),
                config
                );
    </script>


    <?php
    $sql = "SELECT * FROM tbl_products";
    $db = dbConn();
    $result = $db->query($sql);

    $totalProducts = $result->num_rows;
    ?>







    <section>  
        <div class="row">
            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-titletext-center ">Total Products</h5>
                        <h5 class="card-text text-center"><?= $totalProducts ?></h5>
                        <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>products/products.php"> View All Products</a></div>
                    </div>
                </div>
            </div>
            <?php
            $sql = "SELECT * FROM tbl_products WHERE ProductStatus=1";
            $db = dbConn();
            $result = $db->query($sql);

            $totalactiveProducts = $result->num_rows;
            ?>
            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-center">Total Active Products </h5>

                        <h5 class="card-text text-center"><?= $totalactiveProducts ?></h5>
                        <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>products/activeproducts.php"> View Active Products</a></div>

                    </div>
                </div>
            </div>


            <?php
            $sql = "SELECT * FROM tbl_products WHERE ProductStatus=0";
            $db = dbConn();
            $result = $db->query($sql);

            $totalinactiveProducts = $result->num_rows;
            ?>
            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-center">Total In-Active Products </h5>

                        <h5 class="card-text text-center"><?= $totalinactiveProducts ?></h5>
                        <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>products/inactiveproducts.php"> View  In-Active Products</a></div>

                    </div>
                </div>
            </div>
    </section>
    <section>
        <div class="row">
            <?php
            $sql = "SELECT * FROM tbl_category";
            $db = dbConn();
            $result = $db->query($sql);

            $totalCategories = $result->num_rows;
            ?>
            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-center">Total Categories </h5>

                        <h5 class="card-text text-center"><?= $totalCategories ?></h5>
                        <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>category/categories.php"> View All Categories</a></div>

                    </div>
                </div>
            </div>
            <?php
            $sql = "SELECT * FROM tbl_category WHERE Status=1";
            $db = dbConn();
            $result = $db->query($sql);

            $totalactiveCategories = $result->num_rows;
            ?>
            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-center">Total Active Categories </h5>

                        <h5 class="card-text text-center"><?= $totalactiveCategories ?></h5>
                        <div class="text-center text-decoration-none"><a class="text-decoration-none"  href="<?= SYSTEM_PATH ?>category/activecategories.php"> View Active Categories</a></div>

                    </div>
                </div>
            </div>
            <?php
            $sql = "SELECT * FROM tbl_category WHERE Status=0";
            $db = dbConn();
            $result = $db->query($sql);

            $totalinactiveCategories = $result->num_rows;
            ?>
            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-center">Total In-Active Categories </h5>

                        <h5 class="card-text text-center"><?= $totalinactiveCategories ?></h5>
                        <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>category/inactivecategories.php"> View In-Active Categories</a></div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <?php
        $sql = "SELECT * FROM tbl_stories";
        $db = dbConn();
        $result = $db->query($sql);

        $totalSuccessstories = $result->num_rows;
        ?>
        <section>  
            <div class="row">
                <div class="col-sm-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <h5 class="card-titletext-center ">Total Success Stories</h5>
                            <h5 class="card-text text-center"><?= $totalSuccessstories ?></h5>
                            <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>sucessstories/allsuccesstories.php"> View All SucessStories</a></div>
                        </div>
                    </div>
                </div>


                <?php
                $sql = "SELECT * FROM tbl_stories WHERE SuccessStatus=1";
                $db = dbConn();
                $result = $db->query($sql);

                $totalActiveSuccessstories = $result->num_rows;
                ?>

                <div class="col-sm-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <h5 class="card-titletext-center ">Total Active Success Stories</h5>
                            <h5 class="card-text text-center"><?= $totalActiveSuccessstories ?></h5>
                            <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>sucessstories/activesucessstories.php"> View Active SucessStories</a></div>
                        </div>
                    </div>
                </div>

                <?php
                $sql = "SELECT * FROM tbl_stories WHERE SuccessStatus=0";
                $db = dbConn();
                $result = $db->query($sql);

                $totalActiveSuccessstories = $result->num_rows;
                ?>

                <div class="col-sm-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <h5 class="card-titletext-center ">De-Actived Success Stories</h5>
                            <h5 class="card-text text-center"><?= $totalActiveSuccessstories ?></h5>
                            <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>sucessstories/deactivesucessstories.php"> View Active SucessStories</a></div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section id="preorders">  
            <div class="row">

                <?php
                $sql = "SELECT * FROM tbl_preorderproducts ";
                $db = dbConn();
                $result = $db->query($sql);

                $allpreorderproducts = $result->num_rows;
                ?>
                <div class="col-sm-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <h5 class="card-titletext-center ">Total Pre Orders</h5>
                            <h5 class="card-text text-center"><?= $allpreorderproducts ?></h5>
                            <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>sucessstories/allsuccesstories.php"> View All Preorders</a></div>
                        </div>
                    </div>
                </div>


                <?php
                $sql = "SELECT * FROM tbl_preorderproducts WHERE ProductStatus=1";
                $db = dbConn();
                $result = $db->query($sql);

                $preorderproducts = $result->num_rows;
                ?>

                <div class="col-sm-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <h5 class="card-titletext-center ">Total Active Pre-Products</h5>
                            <h5 class="card-text text-center"><?= $preorderproducts ?></h5>
                            <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>sucessstories/activesucessstories.php"> View Active Pre-Products</a></div>
                        </div>
                    </div>
                </div>

                <?php
                $sql = "SELECT * FROM tbl_preorderproducts WHERE ProductStatus=0";
                $result = $db->query($sql);

                $totalActiveSuccessstories = $result->num_rows;
                ?>

                <div class="col-sm-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <h5 class="card-titletext-center "> De-activated  Pre-Products</h5>
                            <h5 class="card-text text-center"><?= $totalActiveSuccessstories ?></h5>
                            <div class="text-center text-decoration-none"><a class="text-decoration-none"  href="<?= SYSTEM_PATH ?>sucessstories/deactivesucessstories.php"> View Active Pre-Products</a></div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />


        </section>
        <?= $_SESSION['FirstName'] . " " . $_SESSION['LastName'] ?>

        <section>
            <!--            <div class="row">
                            <div class="col-md-3">this</div>
                            <div class="col-md-3">this</div>
                            <div class="col-md-3">this</div>
                            <div class="col-md-3">this</div>
                            
                        </div>-->


        </section>

        <section class="piechart">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Work', 11],
                ['Eat', 2],
                ['Commute', 2],
                ['Watch TV', 2],
                ['Sleep', 7]
            ]);
            var options = {
                title: 'My why Activities'
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
            </script>


            <div id="piechart" style="width: 100%; height: 50%;"></div>
        </section>

</main>
<?php include 'footer.php'; ?>