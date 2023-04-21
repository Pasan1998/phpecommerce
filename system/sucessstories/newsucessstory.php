<?php $sucessstorymenu = 'active'; ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?> 

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add New Success story</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>/sucessstories/allsuccesstories.php" class="btn btn-sm btn-outline-secondary">View Stories</a>

            </div>

        </div>
    </div>


    <?php echo @$_SESSION['project_title']; ?>



    <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $hCutomerName = cleanInput($hCutomerName);
//        $hImage = cleanInput($hImage);
        $hProduct = cleanInput($hProduct);
        $hDescription = cleanInput($hDescription);
        $hStatus = cleanInput($hStatus);
        $hImage = $_FILES['hImage'];

        if (empty($hCutomerName)) {
            $messages['error_cname'] = "The customer name should not be empty..!";
        }


        if (empty($hProduct)) {
            $messages['error_hproduct'] = "The product name should not be empty..!";
        }

        if (empty($hDescription)) {
            $messages['error_hdescription'] = "The customer description should not be empty..!";
        }

        if ($_FILES['hImage']['name'] == "") {
            $messages['error_himage'] = "The Images should not be empty..!";
        }

        if (empty($hStatus)) {
            $messages['error_hstatus'] = "The status should not be empty..!";
        }

        if ($_FILES['hImage']['name'] != "") {
            $hImage = $_FILES['hImage'];
            $filename = $hImage['name'];
            $filetmpname = $hImage['tmp_name'];
            $filesize = $hImage['size'];
            $fileerror = $hImage['error'];
            //take file extension
            $file_ext = explode(".", $filename);
            $file_ext = strtolower(end($file_ext));
            //select allowed file type
            $allowed = array("jpg", "jpeg", "png", "gif", "jfif");
            //check wether the file type is allowed
            if (in_array($file_ext, $allowed)) {
                if ($fileerror === 0) {
                    //file size gives in bytes
                    if ($filesize <= 5097152) {
                        //giving appropriate file name. Can be duplicate have to validate using function
                        $file_name_new = uniqid('', true) . $hCutomerName . '.' . $file_ext;
                        //directing file destination
                        $file_path = "../assets/images/stories/" . $file_name_new;
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
            $sql = "INSERT INTO tbl_stories(CustomerName,CustomerImage,ProductName,CustomerDescription,SuccessStatus,AddUser,AddDate) VALUES ('$hCutomerName','$file_name_new','$hProduct','$hDescription','$hStatus','$adduser','$adddate')";
            //"INSERT INTO tbl_products(ProductName,ProductCode,ProductImage,ProductCategory,Quantity,ProductPrice,Camera,Battery,Storage,Warranty,IMIE,SelectYear,ProductDescription,ProductSellingType,ProductStatus,AddUser,AddDate)VALUES ('$pName','$pCode','$file_name_new','$pCategory','$qty','$pPrice','$pCamera','$pBattery','$pStorage','$pWarranty','$pImie','$mYear','$pDescription','$sType','$pStatus','$adduser','$adddate')";
            //           $sql = "INSERT INTO tbl_products(ProductName,ProductCode,ProductCategory,Quantity,ProductPrice,SelectYear,ProductDescription,ProductSellingType,AddUser,AddDate)VALUES ('$pName','$pCode','$pCategory','$qty','$mYear','$pDescription','$pPrice','$sType','$pPrice','$adduser','$adddate') ";


            $results = $db->query($sql);
        }

        if (empty($messages)) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '<?= $hCutomerName ?>', 
                    text: '<?= $hCutomerName ?> s Success Story is Created'
                })
            </script>
        <?php ?>
        <?php
    }



    if (empty($messages)) {
        $hCutomerName = null;
        $hProduct = null;
        $hDescription = null;
        $hStatus = null;
    }
}
?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="customer_name" name="hCutomerName" value="<?= @$hCutomerName; ?>">
            <div class="text-danger"> <?= @$messages['error_cname']; ?></div>
        </div>
        <div class="mb-3">
            <label for="ProductImage" class="form-label">File upload</label>
            <input class="form-control" type="file" id="ProductImage"  name="hImage">
            <div class="text-danger"> <?= @$messages['error_himage']; ?></div>
            <div class="text-danger"> <?= @$messages['file_error']; ?></div>
        </div>
        <div class="mb-3">
            <label for="product_code" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product_code" name="hProduct" value="<?= @$hProduct; ?>">
            <div class="text-danger"> <?= @$messages['error_hproduct']; ?></div>
        </div>
        <div class="mb-3">
            <label for="product_description" class="form-label">Enter Product Description</label>
            <textarea  class="form-control" id="product_description" rows="5" name="hDescription"><?= @$hDescription; ?></textarea>
            <div id="errorPDescription" class="form-text">/100</div>
            <div class="text-danger"> <?= @$messages['error_hdescription']; ?></div>
            <!--<?php echo $p_dec_count; ?> -->
        </div>

        <div class="mb-3">
            <label>Select Status</label>
            <select id="success_status" name="hStatus" class="form-control">
                <option value="">-Select-</option>
                <option value="1" <?php if (@$hStatus == "1") {
        echo "selected";
    } ?>>Activated</option>
                <option value="2"<?php if (@$hStatus == "2") {
        echo "selected";
    } ?>>De-Activated</option>

            </select>
            <div class="text-danger"> <?= @$messages['error_hstatus']; ?></div>
        </div>




        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>