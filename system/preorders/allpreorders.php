<?php $product = 'active'; ?>
<?php include '../header.php'; ?>

<?php include '../menu.php'; ?> 

<?php
if (($_SESSION['UserRole']) != 'manager') {
    header("Location:../login.php");
}?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <section>

        <?php
        $sql = "SELECT * FROM tbl_preorderproducts";
        $db = dbConn();
        $result = $db->query($sql);

        $totalProducts = $result->num_rows;
        ?>
        <h5><span class="badge bg-primary"><?= $totalProducts ?></span> Pre Order Products</h5>
        <div class="table-responsive">

            <table class="table table-striped table-sm ">
                <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        
                        <th scope="col">Product Name</th>
                        <th scope="col">ProductImage</th>
                        <th scope="col">Product Category </th>
                        <th scope="col">ProductPrice</th>                                    
                        <th scope="col">Camera </th>
                        <th scope="col">Battery</th>
                        <th scope="col">Storage</th>
                        <th scope="col">Warranty </th>
                        <th scope="col">SelectYear </th>
                        <th scope="col">ProductDescription </th>
                        <th scope="col">ProductStatus </th>

                        
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
                                <td ><?= $i ?></td>
                               
                                <td  ><?= $row['ProductName'] ?></td>
                                <td width="100"><img class="img-fluid" width="50" src="<?= SYSTEM_PATH ?>assets/images/products/<?= $row['ProductImage'] ?>"></td>
                                <td ><?= $row['ProductCategory'] ?></td>
                                <td ><?= $row['ProductPrice'] ?></td>
                                <td ><?= $row['Camera'] ?></td>                                    
                                <td ><?= $row['Battery'] ?></td>
                                <td><?= $row['Storage'] ?></td>

                                <td ><?= $row['Warranty'] ?></td>

                                <td ><?= $row['SelectYear'] ?></td>
                                <td ><?php echo substr($row['ProductDescription'],0,50)  ?></td>

                                <td>
                                     <?php
                            if ($row['ProductStatus'] == 1) {
                                ?>
                                 <p><a href="statuspre.php?ProductID=<?= $row['ProductID']?>.&ProductStatus=0" class="text-success text-decoration-none">Active</a></p> <?php
                            } else {?>
                                <p><a href="statuspre.php?ProductID=<?= $row['ProductID']?>.&ProductStatus=1" class="text-danger text-decoration-none">Deactive</a></p><?php
                            }
                            ?>
                            </td>
                              
                                </td>

                                <!--                                
                                                                
                                                                <td width="50"><?= $row['AddUser'] ?></td>
                                                                <td width="100"><?= $row['AddDate'] ?></td> 
                                <!--                                <td width="50"> <a href="productdetails.php?ProductID=<?= $row['ProductID'] ?>">View</td>-->
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