<?php include '../header.php'; ?>
<?php include '../menu.php';  ?>


<?php
if ($_SERVER ['REQUEST_METHOD'] == "GET") {
    extract($_GET);
    $db = dbConn();
    $userID = $_SESSION['UserId'];
    $sql = "SELECT * FROM tbl_users WHERE UserId=$userID";
    $results = $db->query($sql);
    $row = $results->fetch_assoc();
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Update User Information</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>users/admin/userManagement.php" class="btn btn-sm btn-outline-secondary">View users</a>

            </div>  
        </div>
    </div>

    <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $uTtile = cleanInput($Title);
        $uFirstName = cleanInput($FirstName);
        $uLastName = cleanInput($LastName);
        
        $userimage = $_FILES['uImage'];
        
        $USERID= $_POST['useridofuser'];
        $USERNAME= $_POST['username'];

        //                      $uAddDate = date ('Y-m-d',strtotime(cleanInput($AddDate)));
        //$uAddUser = cleanInput($AddUser);
        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($CurrentPassword)) {
            $messages['error_currentpassword'] = "The User's current password should not be empty..!";
        }
        if (empty($NewConfirmPassword)) {
            $messages['error_confirmpassword'] = "The User's New confirm password should not be empty..!";
        }
        if (empty($NewPassword)) {
            $messages['error_newpassword'] = "The User's new password should not be empty..!";
        }

        if (empty($uTtile)) {
            $messages['error_uTtile'] = "The User's title should not be empty..!";
        }

        if (empty($uFirstName)) {
            $messages['error_uFirstName'] = "The User's FirstName should not be empty..!";
        }

        if (empty($uLastName)) {
            $messages['error_uLastName'] = "The User's LastName should not be empty..!";
        }

        if (empty($uUserName)) {
            $messages['error_uUserName'] = "The User's UserName should not be empty..!";
        }

      if ((!empty($NewPassword)) && (!empty($NewConfirmPassword))) {

        if ($NewPassword != $NewConfirmPassword) {
            $messages['error_password'] = " Passwords are not match";
        }
    }


        if ($_FILES['uImage']['name'] == "") {
            $messages['error_uimage'] = "The Images should not be empty..!";
        }

          if(!empty($CurrentPassword)){
              $CurrentPassword= sha1($CurrentPassword);
              
              $db= dbConn();
              
               $sql = "SELECT * FROM tbl_users WHERE Password='$CurrentPassword'  AND UserId='$USERID' ";
               $result = $db->query($sql);
                    $result->num_rows;
                if ($result->num_rows <= 0) {
                        $messages['error_currentpassword'] = "The Current password is not mathced!";
                    }
          
            
              
          }


        if (!empty($NewPassword)) {
            // Validate password strength
            $uppercase = preg_match('@[A-Z]@', $NewPassword);
            $lowercase = preg_match('@[a-z]@', $NewPassword);
            $number = preg_match('@[0-9]@', $NewPassword);
            $specialChars = preg_match('@[^\w]@', $NewPassword);
            if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($NewPassword) < 8) {
                $messages['error_password'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.!";
            }
        }

        if ($_FILES['uImage']['name'] != "") {
            $userimage = $_FILES['uImage'];
            $filename = $userimage['name'];
            $filetmpname = $userimage['tmp_name'];
            $filesize = $userimage['size'];
            $fileerror = $userimage['error'];
            //take file extension
            $file_ext = explode(".", $filename);
            $file_ext = strtolower(end($file_ext));
            //select allowed file type
            $allowed = array("jpg", "jpeg", "png", "gif", "jfif");
            //check wether the file type is allowed
            if (in_array($file_ext, $allowed)) {
                if ($fileerror === 0) {
                    //file size gives in bytes
                    if ($filesize <= 2097152) {
                        //giving appropriate file name. Can be duplicate have to validate using function
                        $file_name_new = uniqid('', true) . $uFirstName . '.' . $file_ext;
                        //directing file destination
                        $file_path = "../assets/images/users/" . $file_name_new;
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





        if (!empty($uUserName)) {
            $sql = "SELECT * FROM tbl_users WHERE UserName='$uUserName'";
            $db = dbConn();
            $results = $db->query($sql);
            if ($results->num_rows >= 1) {
                $messages['error_uUserName'] = "This Username  is already exist try different one";
            }
        }



        if (empty($messages)) {

            $db = dbConn();

           $NewPassword= sha1($NewPassword);
     
            $UpdateUser = $_SESSION['UserId'];
            $UpdateDate = date('Y-m-d');
            //$insertuser = "INSERT INTO tbl_users (Title, FirstName, LastName, UserName, Password, UserRole, Status, AddDate, AddUser) VALUES ('$uTtile','$uFirstName','$uLastName','$uPassword','$uUserRole','$uStatus','$uAddDate','$uAddUser') ";
            $updateuser = "UPDATE tbl_users SET Title='$uTtile', FirstName='$uFirstName', LastName='$uLastName',UserName='$uUserName',Password='$NewPassword',UserImage='$file_name_new' ,UpdateUser='$UpdateUser',UpdateDate='$UpdateDate' WHERE UserId='$USERID'";
//            $updateuser = "UPDATE tbl_users SET Title='$uTtile' WHERE UserId='$USERID'";

            print_r($messages);
            $result = $db->query($updateuser);

            if ($updateuser) {
                echo"<div class='text-success'><h2>User Created Succesfully<h2></div > ";
                print_r($updateuser);
            } else {
                echo "data inserted unsucess";
            }
        }
    }
    ?>


    <form method="POST" class="col-md-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  enctype="multipart/form-data" >

       
        
        <input type="hidden" name="useridofuser"  value="<?=$_SESSION['UserId']?>" >
        <input type="hidden" name="username"  value="<?=$_SESSION['UserName']?>" >
      
        
        <div class="mb-3">
            <label for="title" class="form-label">Select Title </label>
            <select id="title" name="Title" class="form-control">
                <option value="">--</option>                                
                <option value="Mr" <?= @$row['Title'] == 'Mr' ? 'selected' : '' ?>>Mr.</option>
                <option value="Miss" <?= @$row['Title'] == 'Miss' ? 'selected' : '' ?>>Miss</option>

            </select>
            <div class="text-danger"> <?= @$messages['error_uTtile']; ?></div>
        </div>


        <div class="mb-3">
            <label for="first_name" class="form-label">Enter First Name</label>
            <input type="text" class="form-control" id="first_name" name="FirstName" value="<?= @$row ['FirstName']; ?>">
            <div class="text-danger"> <?= @$messages['error_uFirstName']; ?></div>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Enter Last Name</label>
            <input type="text" class="form-control" id="last_name" name="LastName" value="<?= @$row ['LastName']; ?>">
            <div class="text-danger"> <?= @$messages['error_uLastName']; ?></div>
        </div>

        <div class="mb-3">
            <label for="UserImage" class="form-label">File upload</label>
            <input class="form-control" type="file" id="UserImage"  name="uImage">
            <div class="text-danger"> <?= @$messages['error_uimage']; ?></div>
            <div class="text-danger"> <?= @$messages['file_error']; ?></div>
        </div>

        <div class="mb-3">
            <label for="user_name" class="form-label">Enter User Name</label>
            <input type="text" class="form-control" id="user_name" name="UserName" value="<?= @$row ['UserName']; ?>">
            <div class="text-danger"> <?= @$messages['error_uUserName']; ?></div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Enter Current Password </label>
            <input type="password" class="form-control" id="password" name="CurrentPassword" value="">
            <div class="text-danger"> <?= @$messages['error_currentpassword']; ?></div>
            <div class="text-danger"> <?= @$messages['error_currentpassword']; ?></div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Enter New  Password </label>
            <input type="password" class="form-control" id="password" name="NewPassword" value="<?= @$NewPassword; ?>">
            <div class="text-danger"> <?= @$messages['error_newpassword']; ?></div>
            <div class="text-danger"> <?= @$messages['error_password']; ?></div>
            
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Enter Confirm Password </label>
            <input type="password" class="form-control" id="password" name="NewConfirmPassword" value="<?= @$NewConfirmPassword; ?>">
            <div class="text-danger"> <?= @$messages['error_confirmpassword']; ?></div>
            <div class="text-danger"> <?= @$messages['error_password']; ?></div>
        </div>

        <!--        <div class="mb-3">
                    <label for="user_role" class="form-label">Select User Role</label>
                    <select id="user_role" name="UserRole" class="form-control">
                        <option value="">--</option>                                
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="ordercollector">Order Collector</option>
                        <option value="orderdistributor">Order Distributor</option>
                        <option value="storekeeper">Store Keeper</option>
                        <option value="returnofficer">Return Officer</option>
                        <option value="accountant">Accountant</option>
                        <option value="owner">Owner</option>
                        <option value="warrantyofficer">Warranty Officer</option>
                        <option value="repiarofficer">Repair Officer</option>
                    </select>
                    <div class="text-danger"> <?= @$messages['error_uUserRole']; ?></div>
                </div>-->

        <!--        <div class="mb-3">
                    <label for="Status" class="form-label">Select User Status</label>
                    <select id="Status" name="Status" class="form-control">
                        <option value="">--</option>                                
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                        <option value="2">Blocked</option>
        
                    </select>
                    <div class="text-danger"> <?= @$messages['error_uStatus']; ?></div>
                </div>-->

        <!--        <div class="mb-3">
                    <label for="add_date" class="form-label">Adding Date</label>
                    <input type="date" class="form-control" id="add_date" name="AddDate" >
                    <div class="text-danger"> <?= @$messages['error_uAddDate']; ?></div>
                </div>-->

        <!--        <div class="mb-3">
                    <label for="adduser" class="form-label">Select add user</label>
                    <select id="adduser" name="AddUser" class="form-control">
                        <option value="">--</option>                                
                        <option value="1">Active</option>
                        <option value="0">Non Active</option>
        
                    </select>
                    <div class="text-danger"> <?= @$messages['error_uStatus']; ?></div>
                </div>-->
<?php print_r(@$updateuser); ?>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</main>