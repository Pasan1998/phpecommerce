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
        <link rel="stylesheet" href="https://cdn.lineicons.com/2.0/LineIcons.css">
        <link href="assets/images/asd.png" rel="icon">
   
        <link href="assets/css/logins.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body class="text-center">
        <main class="form-signin w-100 m-auto border border-3 border-info">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                extract($_POST);
                $UserName = cleanInput($UserName);

                $messages = array();

                if (empty($UserName)) {
                    $messages['error_username'] = "The username should not be blank!";
                }
                if (empty($Password)) {
                    $messages['error_password'] = "The password should not be blank!";
                }

                if (empty($messages)) {
                    $db = dbConn();
                    $Password = sha1($Password);
                    $sql = "SELECT * FROM tbl_users WHERE UserName='$UserName' AND Password='$Password' AND Status='1' ";
                    $result = $db->query($sql);
                    $result->num_rows;
                    if ($result->num_rows <= 0) {
                        $messages['error_invalid'] = "The User Name or Password is invalid!";
                    } else {



                        $row = $result->fetch_assoc();
                        $_SESSION['UserId'] = $row['UserId'];
                        //left side form value name eka ------ right side database column name eka
                        $_SESSION['Title'] = $row['Title'];
                        $_SESSION['FirstName'] = $row['FirstName'];
                        $_SESSION['LastName'] = $row['LastName'];
                        $_SESSION['UserRole'] = $row['UserRole'];
                        $_SESSION['UserName'] = $row['UserName'];

                        echo "success";
                        print_r($_SESSION);
                        header("Location:index.php");
                    }
                }
            }
            ?>


            <div class="demo-container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12 mx-auto">
                            <div class="text-center image-size-small position-relative">
                                <img src="https://annedece.sirv.com/Images/user-vector.jpg" class="rounded-circle p-2 bg-white">
                                <div class="icon-camera">
                                    <a href="" class="text-primary"><i class="lni lni-camera"></i></a>
                                </div>
                            </div>
                            <div class="p-5 bg-white rounded shadow-lg">
                                <h3 class="mb-2 text-center pt-5">Sign In</h3>
                                <p class="text-center lead">Sign In to manage all your devices</p>
                                <form>
                                    <label class="font-500">Email</label>
                                    <input name="" class="form-control form-control-lg mb-3" type="email">
                                    <label class="font-500">Password</label>
                                    <input name="" class="form-control form-control-lg" type="password">
                                    <p class="m-0 py-4"><a href="" class="text-muted">Forget password?</a></p>
                                    <button class="btn btn-primary btn-lg w-100 shadow-lg">SIGN IN</button>
                                </form>
                                <div class="text-center pt-4">
                                    <p class="m-0">Do not have an account? <a href="" class="text-dark font-weight-bold">Sign Up</a></p>
                                </div>          
                            </div>        
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
