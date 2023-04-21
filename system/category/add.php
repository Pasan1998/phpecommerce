<?php $categorypagemenu = 'active'; ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>
<?php
if (($_SESSION['UserRole']) != 'manager') {
    header("Location:../login.php");
}?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add New Category</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>category/categories.php" class="btn btn-sm btn-outline-secondary">View Categories</a>

            </div>

        </div>
    </div>
    <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $cName = cleanInput($cName);
        $cDescription = cleanInput($cDescription);
        $categoryimage = $_FILES['categoryImage'];

        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($cName)) {
            $messages['error_cname'] = "The Category name should not be empty..!";
        }
        if (empty($cDescription)) {
            $messages['error_description'] = "The description should not be empty..!";
        }
        if ($_FILES['categoryImage']['name'] == "") {
            $messages['error_pimage'] = "The Images should not be empty..!";
        }



        if ($_FILES['categoryImage']['name'] != "") {
            $categoryimage = $_FILES['categoryImage'];
            $filename = $categoryimage['name'];
            $filetmpname = $categoryimage['tmp_name'];
            $filesize = $categoryimage['size'];
            $fileerror = $categoryimage['error'];
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
                        $file_name_new = uniqid('', true) . $cName . '.' . $file_ext;
                        //directing file destination
                        $file_path = "../assets/images/categories/" . $file_name_new;
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
            $status = 1;
            $adduser = $_SESSION['UserId'];
            $adddate = date('Y-m-d');

//                            $sql = "INSERT INTO tbl_category (ProductName, ProductDescription,Status,AddUser,AddDate)VALUES ('$cName','$cDescription','$adduser','$adddate') ";
            // $sql = "INSERT INTO tbl_category(ProductName, ProductDescription, Status, AddUser, AddDate) VALUES ('$cName','$cDescription','$status','$adduser','$adddate')";
            $sql = "INSERT INTO tbl_category(ProductName,categoryimage, ProductDescription, Status, AddUser, AddDate) VALUES ('$cName', '$file_name_new', '$cDescription','$status','$adduser','$adddate')";
            $results = $db->query($sql);
//            print_r($sql);
//            if ($sql) {
//                echo "<div class='text-danger'> Inserted Successfully to database</div>";
//            } else {
//                echo "data inserted unsucess";
//            }
        }

        if (empty($messages)) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '<?= $cName ?>',
                    text: '<?= $cName ?> Category is Created'
                })
            </script>
            <?php
            ?>
            <?php
        }










        if (empty($messages)) {
              $cName = null;
        $cDescription = null;
            
        }
    }
    ?>

<?php echo @$_SESSION['project_title']; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" >

        <div class="mb-3">
            <label for="category_name" class="form-label">Enter Category Name</label>
            <input type="text" class="form-control" id="category_name" name="cName" value="<?= @$cName; ?>">
            <div class="text-danger"> <?= @$messages['error_cname']; ?></div>
        </div>

        <div class="mb-3">
            <label for="categoryimage" class="form-label">File upload</label>
            <input class="form-control" type="file" id="categoryimage"  name="categoryImage">
            <div class="text-danger"> <?= @$messages['error_pimage']; ?></div>
            <div class="text-danger"> <?= @$messages['file_error']; ?></div>
        </div>

        <div class="mb-3">
            <label for="category_description" class="form-label">Enter Category Description</label>
            <textarea  class="form-control" id="category_description" rows="5" name="cDescription"><?= @$cDescription; ?></textarea>
            <div id="errorPDescription" class="form-text">/100</div>
            <div class="text-danger"> <?= @$messages['error_description']; ?></div>
            <!--<?php echo $p_dec_count; ?> 
        </div>                                                                                                                                             -->
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>
<?php include '../footer.php'; ?>            