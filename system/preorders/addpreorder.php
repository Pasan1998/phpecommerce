<?php $product = 'active'; ?>

<?php include '../header.php'; ?>
<?php include '../menu.php'; ?> 
<?php
if (($_SESSION['UserRole']) != 'manager') {
    header("Location:../login.php");
}?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add Pre order  Products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>/products/products.php" class="btn btn-sm btn-outline-secondary">All Pre-Order Products</a>

            </div>

        </div>
    </div>
    <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $pName = cleanInput($pName);
        $pCategory = cleanInput($pCategory);
        $mYear = cleanInput($mYear);
        $pDescription = cleanInput($pDescription);
        $pCamera = cleanInput($pCamera);
        $pBattery = cleanInput($pBattery);
        $pStorage = cleanInput($pStorage);
        $pWarranty = cleanInput($pWarranty);
        $pStatus = cleanInput($pStatus);
        $pPrice= cleanInput($pPrice);

         $productimage = $_FILES['pImage'];

        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($pName)) {
            $messages['error_pname'] = "The product name should not be empty..!";
        }

        if (empty($pCategory)) {
            $messages['error_pcategory'] = "The product Category should not be empty..!";
        }

        if (empty($mYear)) {
            $messages['error_myear'] = "The year should not be empty..!";
        }

        if (empty($pDescription)) {
            $messages['error_description'] = "The description should not be empty..!";
        }
        if (empty($pPrice)) {
            $messages['error_pprice'] = "The price should not be empty..!";
        }
        if (empty($pCamera)) {
            $messages['error_pcamera'] = "The Camera should not be empty..!";
        }
        if (empty($pBattery)) {
            $messages['error_pbattery'] = "The Battery should not be empty..!";
        }
        if (empty($pStorage)) {
            $messages['error_pstorage'] = "The Storage should not be empty..!";
        }
        if (empty($pWarranty)) {
            $messages['error_pwarranty'] = "The Warranty should not be empty..!";
        }

        if (empty($pStatus)) {
            $messages['error_pstatus'] = "The status should not be empty..!";
        }

        if ($_FILES['pImage']['name'] == "") {
            $messages['error_pimage'] = "The Images should not be empty..!";
        }


        //adavanced validations
        if (!empty($pPrice)) {
            if ($pPrice <= 1) {
                $messages['error_pprice'] = "The price should not be less than 1!";
            }
        }
        if (!empty($pCode)) {
            $sql = "SELECT * FROM tbl_preorderproducts WHERE ProductName='$pName'";
            $db = dbConn();
            $results = $db->query($sql);
            if ($results->num_rows > 0) {
                $messages['error_pcode'] = "This Product is already in the database";
            }
        }


        if ($_FILES['pImage']['name'] != "") {
            $productimage = $_FILES['pImage'];
            $filename = $productimage['name'];
            $filetmpname = $productimage['tmp_name'];
            $filesize = $productimage['size'];
            $fileerror = $productimage['error'];
            //take file extension
            $file_ext = explode(".", $filename);
            $file_ext = strtolower(end($file_ext));
            //select allowed file type
            $allowed = array("jpg", "jpeg", "png", "gif");
            //check wether the file type is allowed
            if (in_array($file_ext, $allowed)) {
                if ($fileerror === 0) {
                    //file size gives in bytes
                    if ($filesize <= 2097152) {
                        //giving appropriate file name. Can be duplicate have to validate using function
                        $file_name_new = uniqid('', true) . '.' . $file_ext;
                        //directing file destination
                        $file_path = "../assets/images/products/" . $file_name_new;
                        //moving binary data into given destination
                        if (move_uploaded_file($filetmpname, $file_path)) {
                            "The file is uploaded successfully";
                        } else {
                            $messages['file_error'] = "File is not uploaded";
                        }
                    } else {
                        $messages['file_error'] = "File size is invalid";
                    }
                } else {
                    $messages['file_error'] = "File has an error";
                }
            } else {
                $messages['file_error'] = "Invalid File type";
            }
        }

        if (empty($messages)) {

            $db = dbConn();
            $adduser = $_SESSION['UserId'];
            $adddate = date('Y-m-d');
            $sql = "INSERT INTO tbl_preorderproducts(ProductName,ProductImage,ProductCategory,ProductPrice,Camera,Battery,Storage,Warranty,SelectYear,ProductDescription,ProductStatus,AddUser,AddDate)VALUES ('$pName','$file_name_new','$pCategory','$pPrice','$pCamera','$pBattery','$pStorage','$pWarranty','$mYear','$pDescription','$pStatus','$adduser','$adddate')";
            //           $sql = "INSERT INTO tbl_products(ProductName,ProductCode,ProductCategory,Quantity,ProductPrice,SelectYear,ProductDescription,ProductSellingType,AddUser,AddDate)VALUES ('$pName','$pCode','$pCategory','$qty','$mYear','$pDescription','$pPrice','$sType','$pPrice','$adduser','$adddate') ";


            $results = $db->query($sql);
           
        }
        
         if (empty($messages)) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '<?= $pName ?>',
                    text: ' <?= $pName ?> Pre-Order Product is Created'
                })
            </script>
        <?php
        ?>
            <?php
        }



        if (empty($messages)) {
         $pName = null;
        $pCategory = null;
        $mYear = null;
        $pDescription =null;
        $pCamera = null;
        $pBattery = null;
        $pStorage = null;
        $pWarranty = null;
        $pStatus = null;
        $pPrice= null;
        }
        
    }

    ?>

    <?php echo @$_SESSION['project_title']; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="product_name" class="form-label">Enter Product Name</label>
            <input type="text" class="form-control" id="product_name" name="pName" value="<?= @$pName; ?>">
 <div class="text-danger"> <?= @$messages['error_pname']; ?></div>
        </div>

        <div class="mb-3">
            <label for="ProductImage" class="form-label">File upload</label>
            <input class="form-control" type="file" id="ProductImage"  name="pImage">
            <div class="text-danger"> <?= @$messages['error_pimage']; ?></div>
            <div class="text-danger"> <?= @$messages['file_error']; ?></div>
        </div>

        <div class="mb-3">
            <?php
            $sql = "SELECT Id,ProductName FROM tbl_category WHERE Status=1 ";
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

                        <option value="<?= $row['ProductName'] ?>" <?php if(@$pCategory == $row['ProductName']){echo "selected";}?> ><?= $row['ProductName'] ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <div class="text-danger"> <?= @$messages['error_pcategory']; ?></div>
        </div>

      

        <div class="mb-3">
            <label for="product_price" class="form-label">Enter Product Price</label>
            <input type="text" class="form-control" id="product_price" name="pPrice" value="<?= @$pPrice; ?>">
            <div class="text-danger"><?= @$messages['error_pprice']; ?></div>
        </div>

        <div class="mb-3">
            <label for="product_camera" class="form-label">Enter Camera</label>
            <input type="number" class="form-control" id="product_camera" name="pCamera" value="<?= @$pCamera; ?>">
            <div class="text-danger"><?= @$messages['error_pcamera']; ?></div>
        </div>
        <div class="mb-3">
            <label for="product_battery" class="form-label">Enter Battery</label>
            <input type="number" class="form-control" id="product_battery" name="pBattery" value="<?= @$pBattery; ?>">
            <div class="text-danger"><?= @$messages['error_pbattery']; ?></div>
        </div>
        <div class="mb-3">
            <label for="product_storage" class="form-label">Enter Storage</label>
            <input type="number" class="form-control" id="product_storage" name="pStorage" value="<?= @$pStorage; ?>">
            <div class="text-danger"><?= @$messages['error_pstorage']; ?></div>
        </div>
        <div class="mb-3">
            <label for="product_pwarranty" class="form-label">Enter Warranty Period</label>
            <input type="number" class="form-control" id="product_pwarranty" name="pWarranty" value="<?= @$pWarranty; ?>">
            <div class="text-danger"><?= @$messages['error_pwarranty']; ?></div>
        </div>
       

        <div class="mb-3">
            <label>Select Year</label>
            <select id="mYear" name="mYear" class="form-control">
                <option value="">-Select-</option>
                <?php for ($i = 2012; $i <= date('Y'); $i++) { ?>
                    <option value="<?= $i; ?>">Year <?= $i; ?></option>
                <?php } ?>
            </select>
            <div class="text-danger"> <?= @$messages['error_myear']; ?></div>
        </div>

        <div class="mb-3">
            <label for="product_description" class="form-label">Enter Product Description</label>
            <textarea  class="form-control" id="product_description" rows="5" name="pDescription"><?= @$pDescription; ?></textarea>
            <div id="errorPDescription" class="form-text">/100</div>
            <div class="text-danger"> <?= @$messages['error_description']; ?></div>
            <!--<?php echo $p_dec_count; ?> -->
        </div>

        <div class="mb-3">
            <label>Select Status</label>
            <select id="product_status" name="pStatus" class="form-control">
                <option value="">-Select-</option>
                <option value="1" <?php if(@$pStatus == "1"){echo 'selected';}  ?>>Activated</option>
                <option value="2"<?php if(@$pStatus == "2"){echo 'selected';}  ?> >De-Activated</option>

            </select>
            <div class="text-danger"> <?= @$messages['error_pstatus']; ?></div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>
<?php include '../footer.php'; ?>            