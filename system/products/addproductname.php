<?php $product='active'; ?>

<?php include '../header.php'; ?>
<?php include '../menu.php'; ?> 
<?php
if (($_SESSION['UserRole']) != 'manager') {
    header("Location:../login.php");
}?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add New Product Name</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>/products/products.php" class="btn btn-sm btn-outline-secondary">View Product</a>

            </div>
            

        </div>
    </div>
    <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //seperate variables and values from the form
        extract($_POST);
        //data clean
        $productname = cleanInput($productname);
        $pCategory = cleanInput($pCategory);
        //create array variable store validation messages
        $messages = array();
        //validate required fields
        if (empty($productname)) {
            $messages['error_productname'] = "The product name should not be empty..!";
        }
        if (empty($pCategory)) {
            $messages['error_pcategory'] = "The product Category should not be empty..!";
        }
        //adavanced validations
       if (!empty($productname)) {
            $sql = "SELECT * FROM tbl_products_name WHERE ProductName='$productname'";
            $db = dbConn();
            $results = $db->query($sql);
            if ($results->num_rows > 0) {
                $messages['error_productname'] = "This Product code is already in the database";
            }
        }

        if (empty($messages)) {

            $db = dbConn();
            $adduser = $_SESSION['UserId'];
            $adddate = date('Y-m-d');
            $sql = "INSERT INTO tbl_products_name(ProductName,Category)VALUES ('$productname','$pCategory')";
  
            $results = $db->query($sql);
            @$productname=null;
        }
        
        
        
         if (empty($messages)) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '<?=$productname?>',
                    text: '<?=$productname ?> . Product name is Created'
                })
            </script>
        <?php
        ?>
            <?php
        }
        
        
        
    }

    ?>

    <?php echo @$_SESSION['project_title']; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >

        <div class="mb-3">
            <label for="product_name" class="form-label">Enter Product Name</label>
            <input type="text" class="form-control" id="product_name" name="productname" value="<?= @$productname; ?>">
            <div class="text-danger"> <?= @$messages['error_productname']; ?></div>
        </div>
         <div class="mb-3">
            <?php
            $sql = "SELECT Id,ProductName FROM tbl_category WHERE Status=1";
            $db = dbConn();
            $result = $db->query($sql);
            ?>
            <label>Select Category</label>
            <select id="category" name="pCategory" class="form-control">
                <option value="">--</option>
                <?php
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        ?>
                        
                        <option value="<?= $row['ProductName'] ?>"  ><?= $row['ProductName'] ?></option>
                    <?php
                    }
                }
                ?>
            </select>
            <div class="text-danger"> <?= @$messages['error_pcategory']; ?></div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>
<?php include '../footer.php'; ?>            