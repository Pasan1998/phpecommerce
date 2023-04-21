<?php $product='active'; ?>

<?php include '../header.php'; ?>
<?php include '../menu.php'; ?> 
<?php
if (($_SESSION['UserRole']) != 'manager') {
    header("Location:../login.php");
}?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Manage Products</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Add Product</a>

                </div>
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>products/addproductname.php" class="btn btn-sm btn-outline-secondary">Add Product Name</a>

                </div>
                 <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>products/addpreorder.php" class="btn btn-sm btn-outline-secondary">Add PreOrder Product</a>

                </div>

            </div>
        </div>
        <?php
        $sql = "SELECT * FROM tbl_products WHERE ProductStatus=0";
        $db = dbConn();
        $result = $db->query($sql);

        $totalProducts = $result->num_rows;
        ?>
        <h5><span class="badge bg-primary"><?= $totalProducts ?></span>Active Products</h5>
        <div class="table-responsive">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Code</th>
                        <th scope="col">Product Category </th>
                        <th scope="col">Quantity</th>                                    
                        <th scope="col">Product Price</th>
                        <th scope="col">Year</th>
                        <th scope="col">Description</th>
                        <th scope="col">Product Image</th>
                        
                       
                        <th scope="col">Add User</th>
                        <th scope="col">Add Date</th>
                         <th scope="col">Status</th>
                         <th scope="col">View</th>
                         
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td width="50"><?= $i ?></td>
                               
                                <td width="50" ><?= $row['ProductName'] ?></td>
                                <td width="50"><?= $row['ProductCode'] ?></td>
                                <td width="50"><?= $row['ProductCategory'] ?></td>
                                <td width="50"><?= $row['Quantity'] ?></td>
                                <td width="50"><?= $row['ProductPrice'] ?></td>                                    
                                <td width="50"><?= $row['SelectYear'] ?></td>
                                <td width="50"><?= $row['ProductDescription'] ?></td>
                                <td width="100"><img class="img-fluid" width="50" src="<?= SYSTEM_PATH?>assets/images/products/<?= $row['ProductImage'] ?>"></td>
                                

                                <td width="50"><?= $row['AddUser'] ?></td>
                                <td width="100"><?= $row['AddDate'] ?></td>  
                                <td width="100" ><?php
                                if($row['ProductStatus']== 1){echo '<p><a href="status.php?ProductID='.$row['ProductID'].'&ProductStatus=0" class="text-success">Active</a></p>';}
                                else{
                                    echo'<p><a href="status.php?ProductID='.$row['ProductID'].'&ProductStatus=1" class="text-danger">Dective</a></p>';
                                }
                                ?></td>  
                                <td width="50"> <a href="productdetails.php?ProductID=<?= $row['ProductID']?>">View</td>
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