<?php ob_start(); ?>

<?php $product = 'active'; ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?> 
<?php
if (($_SESSION['UserRole']) != 'manager') {
    header("Location:../login.php");
}
?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Manage Products</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Add Product</a>

                </div>
                <!--                <div class="btn-group me-2">
                                    <a href="<?= SYSTEM_PATH ?>products/addproductname.php" class="btn btn-sm btn-outline-secondary">Add Product Name</a>
                
                                </div>-->
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>preorders/addpreorder.php" class="btn btn-sm btn-outline-secondary">Add PreOrder Product</a>

                </div>
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>pie.php" class="btn btn-sm btn-outline-secondary">View Charts</a>

                </div>

            </div>
        </div>




        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>       
        <div style="width:300px;">
            <canvas id="myChart"></canvas>
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
        </div>



        asdas

        <div style="width:300px;">
            <canvas id="myChart"></canvas>
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
        </div>


        <?php
        $sql = "SELECT * FROM tbl_products WHERE ProductStatus < 2";
        $db = dbConn();
        $result = $db->query($sql);

        $totalProducts = $result->num_rows;
        ?>
        <h5><span class="badge bg-primary"><?= $totalProducts ?></span> Products</h5>
        <div class="table-responsive">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th >#</th>
                        <th>Product ID</th>
                        <th >Product Name</th>
                        <th>Product Code</th>
                        <th >Product Category </th>
                        <th>Quantity</th>                                    
                        <th >Product Price</th>
                        <th>Year</th>
                        <th >Description</th>
                        <th >Product Image</th>


                       
                        <th >Add Date</th>
                        <th >Status</th>
                        <th >View</th>
                        <th >Change status</th>
                        <th>Change status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td ><?= $i ?></td>
                                <td ><?= $row['ProductID'] ?></td>
                                <td ><?= $row['ProductName'] ?></td>
                                <td ><?= $row['ProductCode'] ?></td>
                                <td ><?= $row['ProductCategory'] ?></td>
                                <td ><?= $row['Quantity'] ?></td>
                                <td ><?= number_format($row['ProductPrice']) ?></td>                                    
                                <td ><?= $row['SelectYear'] ?></td>
                                <td ><?= $row['ProductDescription'] ?></td>
                                <td ><img class="img-fluid" width="20" src="<?= SYSTEM_PATH ?>assets/images/products/<?= $row['ProductImage'] ?>"></td>


                               
                                <td><?= $row['AddDate'] ?></td>  


                                <td>



                                    <?php
                                    if ($row['ProductStatus'] == 1) {
                                        ?>
                                        <p><a href="status.php?ProductID=<?= $row['ProductID'] ?>.&ProductStatus=0" class="text-success text-decoration-none">Active</a></p> <?php } else {
                                        ?>
                                        <p><a href="status.php?ProductID=<?= $row['ProductID'] ?>.&ProductStatus=1" class="text-danger text-decoration-none">Deactive</a></p><?php
                                    }
                                    ?>
                                               </td>

                                <td > <a href="productdetails.php?ProductID=<?= $row['ProductID'] ?>">View</td>


                                <?php
                                if (isset($_GET['changestatus'])) {
                                    $selected_option = $_GET['changestatus'];

                                    exit();
                                }
                                ?>
<!--                                <td>
                                    <form method="get" action="status_1.php" >
                                        <input type="hidden" name="ProductID" value="<?= $row['ProductID'] ?>">
                                        <select name="changestatus" >
                                            <option>--</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>


                                        </select>
                                        <button type="submit" >update </button>

                                    </form>
                                </td>-->

                                <td>
                                    <?php if ($row['ProductStatus'] == 0){?>
                             
                                        <form method="post" action="activestatus.php">
                                                <input type="hidden" name="ProductID" value="<?= $row['ProductID'] ?>">
                                                <div >
                                                    <button class="p-3 btn btn-primary" type="submit" name="action" value="active"  style="background-color: #99ff66;"> Click to Active</button>
                                                </div>
                                                

                                            </form>
                                              <?php
                                        
                                    }else{?>
                                         <form method="post" action="deactivestatus.php">
                                                <input type="hidden" name="ProductID" value="<?= $row['ProductID'] ?>">

                                                <button class="p-3 btn btn-primary" type="submit" name="action" value="deactive" style="background-color: #ff6666;"> Click to DeActive</button>
                                            </form><?php
                                        
                                    }
                                        
                                        
                                        
                                        
                                        
                                        ?>
                                    

                                </td>
                                
                                <td>
                                    <form method="post" action="deletestatus.php">
                                                <input type="hidden" name="ProductID" value="<?= $row['ProductID'] ?>">

                                                <button class="p-4  btn btn-primary" type="submit" name="action" value="deactive" style="background-color: #ff0000;"> Delete</button>
                                            </form>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>

                </tbody>
                <!--                             <td width="100" ><?php
                if ($row['ProductStatus'] == 1) {
                    echo '<p><a href="status.php?ProductID=' . $row['ProductID'] . '&ProductStatus=0" class="text-success">Active</a></p>';
                } else {
                    echo'<p><a href="status.php?ProductID=' . $row['ProductID'] . '&ProductStatus=1" class="text-danger">Dective</a></p>';
                }
                ?></td> -->
            </table>
        </div>
    </section>


    <!--
        <h1>All most sold  Products</h1>
    
        <div class="container mx-auto mt-4">
            <div class="row">
    <?php
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            ?>
                                                                                                        <div class="col-md-3">
                                                                                                            <div class="cardProduct" style="height:12rem;">
                                                                                                                <img src="<?= SYSTEM_PATH ?>/assets/images/products/<?= $row['ProductImage'] ?>"  class="card-img-top text-center cardProductImage" alt="...">
                                                                                                                <div class="card-body">
                                                                                                                    <h5 class="card-title"><?= $row['ProductName'] ?></h5>
                                                                                                                    <h6 class="card-subtitle mb-2 text-muted"><?= $row['ProductCategory'] ?></h6>
                                                                                                                    <p class="card-text"><?= $row['ProductDescription'] ?></p>
                                                                                                                    <p class="card-text"><?= $row['ProductPrice'] ?></p>
                                                                                                                    <a href="#" class="btn mr-2"><i class="fas fa-link"></i> Visit Site</a>
                                                                                                                    <a href="#" class="btn "><i class="fab fa-github"></i> Github</a>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>   
            <?php
        }
    }
    ?>
            </div>
        </div>
        <section>
            <h1>All new  Products</h1>
    <?php
//$sql = "SELECT * FROM tbl_products WHERE ProductStatus='active' AND AddDate IN (SELECT MAX( AddDate )";
//$sql = "SELECT * 
//FROM tbl_products
//WHERE id IN (SELECT ProductID  FROM table WHERE AddDate = (SELECT MAX(AddDate) FROM table))
//ORDER BY id DESC
//LIMIT 1";
//$sql="SELECT TOP 1 AddDate FROM tbl_products  
//ORDER BY AddDate DESC; ";

    $sql = "SELECT * FROM tbl_products WHERE ProductStatus=1 ORDER BY AddDate Desc LIMIT 8 ";
    $db = dbConn();
    $result = $db->query($sql);
    ?>
    
            
          <div class="container mx-auto mt-4">
                        <div class="row">
    <?php
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            ?>
                                                                                                                            <div class="col-md-3">
                                                                                                                                <div class="cardProduct" style="width:18rem;">
                                                                                                                                    <img src="<?= SYSTEM_PATH ?>/assets/images/products/<?= $row['ProductImage'] ?>" style="height:12rem;" class="card-img-top text-center cardProductImage" alt="...">
                                                                                                                                    <div class="card-body">
                                                                                                                                        <h5 class="card-title"><?= $row['ProductName'] ?></h5>
                                                                                                                                        <h6 class="card-subtitle mb-2 text-muted"><?= $row['ProductCategory'] ?></h6>
                                                                                                                                        <p class="card-text"><?= $row['ProductDescription'] ?></p>
                                                                                                                                        <p class="card-text"><?= $row['ProductPrice'] ?></p>
                                                                                                                                        <a href="#" class="btn mr-2"><i class="fas fa-link"></i> Visit Site</a>
                                                                                                                                        <a href="#" class="btn "><i class="fab fa-github"></i> Github</a>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>   
            <?php
        }
    }
    ?>
                        </div>
                    </div>
        </section>-->

</main>


<?php
print_r($_SESSION);

include '../footer.php';
?>       

<?php ob_end_flush(); ?> 