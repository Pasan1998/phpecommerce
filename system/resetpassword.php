<?php
session_start();
include 'config.php';
include 'function.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BIT PROJECT-LOGIN</title>
        <link href="assets/images/asd.png" rel="icon">
        <link href="<?= SYSTEM_PATH ?>assets/css/bootstrap.min.css" rel="stylesheet" >
        <link href="<?= SYSTEM_PATH ?>assets/css/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="text-center">
        <main class="form-signin w-100 m-auto border border-3 border-info">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                extract($_POST);
                $UserName = cleanInput($UserName);

                $messages = array();

                if (empty($UserName)) {
                    $messages['error_username'] = "The email should not be blank!";
                }


                if (empty($messages)) {
                    $db = dbConn();

                    $sql = "SELECT * FROM tbl_users WHERE Email='$UserName' ";
                    $result = $db->query($sql);
                    $result->num_rows;
                    if ($result->num_rows <= 0) {
                        $messages['error_invalid'] = "Invalid email Address!";
                    } else {



                        $row = $result->fetch_assoc();
//                        Sessions creating for user

                        $_SESSION['UserId'] = $row['UserId'];
                        $resetuserid = $_SESSION['UserId'];
                        $sql = "SELECT * FROM tbl_users WHERE UserId= $resetuserid ";

                        //left side form value name eka ------ right side database column name eka
//                        $_SESSION['Title'] = $row['Title'];
//                        $_SESSION['FirstName'] = $row['FirstName'];
//                        $_SESSION['LastName'] = $row['LastName'];
//                        $_SESSION['UserRole'] = $row['UserRole'];

//                        create session to check users table password colum values
                        $_SESSION['passwordreset'] = $row['passwordreset'];
                        $resetuserdatabase = $_SESSION['passwordreset'];

                        $resettoken = uniqid();
                        $_SESSION['resettoken'] = $resettoken;
                        
//                        create session to capture the users login time to use session time
                        $_SESSION['loggedinTime'] = time();

//                        insert the reset token for the first time
//                        check if the users table password reset column is empty or not
                        if ($resetuserdatabase == null ) {
                            $UpdateDate = date('Y-m-d');
//                            if empty nm password reset that means first time resetting the password soe have to insert the value of resettoken to users table
                            echo $sql = "UPDATE tbl_users SET passwordreset = '$resettoken' WHERE UserId = '$resetuserid' ";
                            $sql2 = "UPDATE tbl_users SET UpdateDate = '$UpdateDate' WHERE UserId = '$resetuserid' ";
                            $db = dbConn();
                            $results = $db->query($sql);
                            $results = $db->query($sql2);
                            
                            header("Location:resetpassword2.php");
                            
                            //print_r($sql);
                            echo '123';
                        } else {
                            $UpdateDate = date('Y-m-d');
//                            if not empty mean this is not the first password is resetting so have to update the table of user with the new reset token
                                echo $sql = "UPDATE tbl_users SET passwordreset = '$resettoken', UpdateDate=$UpdateDate WHERE UserId = '$resetuserid' ";
                                $sql3 = "UPDATE tbl_users SET UpdateDate = '$UpdateDate' WHERE UserId = '$resetuserid' ";
                            $db = dbConn();
                            $results = $db->query($sql);
                            $results = $db->query($sql3);
                            
                            header("Location:resetpassword2.php");
                            echo 'abc';
                        }


                        echo "success";
                        print_r($_SESSION);
                    }
                }
            }
            ?>


            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
               <img class="mb-2 logoimage" src="<?= SYSTEM_PATH ?>assets/images/asd.png" style="height:150px; width: 300px; border-radius: 50%;" alt="logo" >
                <h1 class="h3 mb-3 fw-normal">Reset Password</h1>

                <div class="text-danger" >  
                    <?php echo @$messages['error_username']; ?>
                </div>
                <div class="text-danger"> 
                    <?php echo @$messages['error_password']; ?>
                </div>
                <div class="text-danger">  
                    <?php echo @$messages['error_invalid']; ?>
                </div>

                <div class="form-floating mb-2" >
                    <input type="text" class="form-control" placeholder="name@example.com" name="UserName" id="UserName">
                    <label for="floatingInput">Enter Previous mail address</label>
                </div>



                <button class="w-100 btn btn-lg btn-primary" type="submit">Reset</button>

            </form>
        </main>
    </body>
</html>
