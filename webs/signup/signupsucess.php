<?php $signup='active';?>

<?php
include '../header.php';
include '../menu.php';

?> 

<?php
//check form submit method
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    //seperate variables and values from the form
    extract($_POST);

    //data clean
    $Title = cleanInput($Title);
    $cFirstName = cleanInput($FirstName);
    $cLastName = cleanInput($LastName);
    $cEmail = cleanInput($Email);
    $cNIC = cleanInput($NIC);
    $cPassword = cleanInput($Password);
    $cConfirmPassword = cleanInput($ConfirmPassword);
    $cMobile = cleanInput($Mobile);
//    $cGender = cleanInput($Gender);
    $cAddress = cleanInput($Address);
    $cCity = cleanInput($City);

    //create array variable store validation messages
    $messages = array();

    //validate required fields

    if (empty($Title)) {
        $messages['error_title'] = "Customer Title  should not be empty!";
    }

    if (!isset($cGender)) {
        $messages['error_gender'] = "The Gender should be selected..!";
    }

    if (empty($cFirstName)) {
        $messages['error_firstname'] = "Customer First Name should not be empty!";
    }
    if (empty($cLastName)) {
        $messages['error_lastname'] = "Customer Last Name should not be empty!";
    }
    if (empty($cEmail)) {
        $messages['error_email'] = "The email should not be empty..!";
    }
    if (empty($cNIC)) {
        $messages['error_nic'] = "The NIC  should not be empty..!";
    }
    if (empty($cPassword)) {
        $messages['error_password'] = "The Password  should not be empty..!";
    }
    if (empty($cConfirmPassword)) {
        $messages['error_confirmpassword'] = "The confirm password should not be empty..!";
    }
    if (empty($cMobile)) {
        $messages['error_mobile'] = "The mobile should not be empty..!";
    }
//    if (empty($cGender)) {
//        $messages['error_gender'] = "The gender should not be empty..!";
//    }
    if (empty($cAddress)) {
        $messages['error_address'] = "The address should be selected..!";
    }
    if (empty($cCity)) {
        $messages['error_city'] = "The city should be selected..!";
    }
    //adavnced validation

    if (!empty($cNIC)) {

        $niclength = strlen($cNIC);
        if ($niclength == 10 || $niclength == 12) {
            
        } else {
            $messages['error_nic'] = "The NIC  length should 10 or 12!";
        }
    }

    if (!empty($cEmail)) {
        $file_ext = explode(".", $cEmail);
        $file_ext = strtolower(end($file_ext));
        //select allowed file type
        $allowed = array("com", "yahoo", "me");
        //check wether the file type is allowed
        if (in_array($file_ext, $allowed)) {
            
        } else {
            $messages['file_error'] = "Invalid mail type";
        }
    }


    if (!empty($Mobile)) {
        $mobilelength = strlen($Mobile);
        if ($mobilelength == 10) {
            if ($Mobile === '0000000000') {
                $messages['error_mobile'] = "The mobile number all can not be Zeros";
            }
        } else {
            $messages['error_mobile'] = "The mobile bnumber should must have only 10 numbers";
        }
    }

    if (!empty($cEmail)) {
        if (!filter_var($cEmail, FILTER_VALIDATE_EMAIL)) {
            $messages['error_email'] = "The email is not well formatted..!";
        }
    }






    if (!empty($cPassword)) {
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $cPassword);
        $lowercase = preg_match('@[a-z]@', $cPassword);
        $number = preg_match('@[0-9]@', $cPassword);
        $specialChars = preg_match('@[^\w]@', $cPassword);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($cPassword) < 8) {
            $messages['error_password'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.!";
        }
    }

    if ((!empty($cPassword)) && (!empty($cConfirmPassword))) {

        if ($cPassword != $cConfirmPassword) {
            $messages['error_password'] = " Passwords are not match";
        }
    }


    if (!empty($cEmail)) {
        $sql = "SELECT * FROM tbl_customers WHERE Email='$cEmail'";
        $db = dbConn();
        $results = $db->query($sql);
        if ($results->num_rows > 0) {
            $messages['error_email'] = "This email is already in the database";
        }
    }






    if (empty($messages)) {

        $db = dbConn();
        $cPassword = sha1($cPassword);
        $sql = "INSERT INTO tbl_customers (Title,FirstName,LastName,Email,NIC,Password,Mobile,Gender,Address,City) VALUES ('$Title','$cFirstName','$cLastName','$cEmail','$cNIC','$cPassword','$cMobile','$cGender', '$cAddress','$cCity')";

        $results = $db->query($sql);

        if ($results) {
            echo "";
        }

        @$Title = null;
        @$cFirstName = null;
        @$cLastName = null;
        @$cEmail = null;
        @$cNIC = null;
        @$cPassword = null;
        @$cConfirmPassword = null;
        @$cMobile = null;
//    $cGender = cleanInput($Gender);
        @$cAddress = null;
        @$cCity = null;
        @$cGender = null;
    }
}





//adavanced validations
//    if (!empty($pPrice)) {
//        if ($pPrice <= 1) {
//            $messages['error_pprice'] = "The price should not be less than 1!";
//        }
//    }
//    if (!empty($pCode)) {
//        $sql = "SELECT * FROM tbl_products WHERE ProductCode='$pCode'";
//        $db = dbConn();
//        $results = $db->query($sql);
//        if ($results->num_rows > 0) {
//            $messages['error_pcode'] = "This Product code is already in the database";
//        }
//    }
//        if (empty($messages)) {
//            $productimage = $_FILES['pImage'];
//            $filename = $productimage['name'];
//            $filetmpname = $productimage['tmp_name'];
//            $filesize = $productimage['size'];
//            $fileerror = $productimage['error'];
//            //take file extension
//            $file_ext = explode(".", $filename);
//            $file_ext = strtolower(end($file_ext));
//            //select allowed file type
//            $allowed = array("jpg", "jpeg", "png", "gif");
//            //check wether the file type is allowed
//            if (in_array($file_ext, $allowed)) {
//                if ($fileerror === 0) {
//                    //file size gives in bytes
//                    if ($filesize <= 2097152) {
//                        //giving appropriate file name. Can be duplicate have to validate using function
//                        $file_name_new = uniqid('', true) . '.' . $file_ext;
//                        //directing file destination
//                        $file_path = "../assets/images/products/" . $file_name_new;
//                        //moving binary data into given destination
//                        if (move_uploaded_file($filetmpname, $file_path)) {
//                            "The file is uploaded successfully";
//                        } else {
//                            $messages['file_error'] = "File is not uploaded";
//                        }
//                    } else {
//                        $messages['file_error'] = "File size is invalid";
//                    }
//                } else {
//                    $messages['file_error'] = "File has an error";
//                }
//            } else {
//                $messages['file_error'] = "Invalid File type";
//            }
//        }
?>



<main id="main">
    <section id="signup" class="section-bg">
        <div class="container" >
            <div class="row d-flex align-items-center justify-content-center ">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="../assets/images/signup.jpg"
                         class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form  method="POST"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <!-- Email input -->
                        <h1 class="title"> Personal Details </h1>
                        <div class="form-outline mb-4">
                            <div class="form-outline mb-2">
                                <label for="title" class="form-label">Select Title </label>
                                <select id="title" name="Title" class="form-control">
                                    <option value="">- -</option>                                
                                    <option value="Mr" <?php
                                    if (@$Title == "Mr") {
                                        echo "selected";
                                    }
                                    ?>>Mr.</option>
                                    <option value="Miss"<?php
                                    if (@$Title == "Miss") {
                                        echo "selected";
                                    }
                                    ?>>Miss.</option>

                                </select>
                                <div class="text-danger"> <?= @$messages['error_title']; ?></div> 
                            </div>


                            <div class="orm-outline mb-2">
                                <label>Select Gender</label>
                                <div class="form-check form-check">
                                    <input class="form-check-input" type="radio" name="cGender" id="male" value="male" <?php
                                    if (@$cGender == 'male') {
                                        echo "checked";
                                    }
                                    ?>>
                                    <label class="form-check-label" for="sell">Male</label>
                                </div>
                                <div class="form-check form-check">
                                    <input class="form-check-input" type="radio" name="cGender" id="female" value="female" <?php
                                    if (@$cGender == 'female') {
                                        echo "checked";
                                    }
                                    ?>>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>

                                <div class="text-danger"> <?= @$messages['error_gender']; ?></div>
                            </div>


                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">First Name</label>
                                <input type="text" placeholder="" class="form-control form-control-sm" id="first_name" name="FirstName" value="<?= @$cFirstName; ?>">
                                <div class="text-danger"> <?= @$messages['error_firstname']; ?></div>  
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">Last Name</label>
                                <input type="text" placeholder="" class="form-control form-control-sm" id="last_name" name="LastName" value="<?= @$cLastName; ?>">
                                <div class="text-danger"> <?= @$messages['error_lastname']; ?></div>
                            </div>

                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">Email address</label>
                                <input type="text" placeholder="" class="form-control form-control-sm" id="email_address" name="Email" value="<?= @$cEmail; ?>">
                                <div class="text-danger"> <?= @$messages['error_email']; ?></div>
                                <div class="text-danger"> <?= @$messages['file_error']; ?></div>
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">NIC</label>
                                <input type="text" placeholder="" class="form-control form-control-sm" id="nic_number" name="NIC" value="<?= @$cNIC; ?>">
                                <div class="text-danger"> <?= @$messages['error_nic']; ?></div>
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">Password </label>
                                <input type="password" placeholder="" class="form-control form-control-sm" id="password" name="Password" value="<?= @$cPassword; ?>">
                                <div class="text-danger"> <?= @$messages['error_password']; ?></div>
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">Confirm Password</label>
                                <input type="password" placeholder="" class="form-control form-control-sm" id="confirm_password" name="ConfirmPassword" value="<?= @$cConfirmPassword; ?>">
                                <div class="text-danger"> <?= @$messages['error_confirmpassword']; ?></div>
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">Address</label>
                                <input type="text" placeholder="" class="form-control form-control-sm" id="address" name="Address" value="<?= @$cAddress; ?>">
                                <div class="text-danger"> <?= @$messages['error_address']; ?></div>
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">Mobile Number</label>
                                <input type="text" placeholder="" class="form-control form-control-sm" id="phone" name="Mobile" value="<?= @$cMobile; ?>">
                                <div class="text-danger"> <?= @$messages['error_mobile']; ?></div>
                            </div>
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form1Example13">City</label>
                                <input type="text" class="form-control form-control-sm" id="city" name="City" value="<?= @$cCity; ?>">
                                <div class="text-danger"> <?= @$messages['error_city']; ?></div>
                            </div>



                        </div>

                        <!-- Password input -->




                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0 text-muted"></p>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include '../footer.php'; ?>