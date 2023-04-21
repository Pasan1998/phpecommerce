<?php $review='active'; ?>
<?php include '../header.php'; ?>
 <?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Reviews Management</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>redeemcode/newredeemcode.php" class="btn btn-sm btn-outline-secondary">Add New code</a>

                </div>

            </div>
        </div>
        </section>
            
      <?php
        $sql = "SELECT * FROM tbl_products,tbl_reviews  WHERE tbl_products.ProductID=tbl_reviews.ProductID";
        $db = dbConn();
        $result = $db->query($sql);

        $totalcodes = $result->num_rows;
        ?>
        <h5><span class="badge bg-primary"><?= $totalcodes ?></span> Codes</h5>
        <div class="table-responsive">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        
                        <th scope="col">Product name</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Review </th>                            
                        
                        <th scope="col">Review Rate</th>
                        <th scope="col">Review Status</th>
                         
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
                             
                                <td  ><?= $row['ProductName'] ?></td>
                               
                                <td width="50" ><img class="img-fluid" src="<?= SYSTEM_PATH ?>assets/images/products/<?= $row['ProductImage'] ?>"></td>
                                
                                <td ><?= $row['review'] ?></td>  
                                <td ><?= $row['reviewrating'] ?> </td>
                             <td ><?= $row['status'] ?> </td>
                                
                                
<!--                                <td width="50"> <a href="productdetails.php?ProductID=<?= $row['ProductID']?>">View</td>-->
                            </tr>
                        <?php
                            $i++;
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>


</main>





 <?php include '../footer.php'; ?>