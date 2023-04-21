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
    <body class="text-center" >
        
     
        <main class="form-signin w-100 m-auto border border-3 border-warning">
            
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
                    $Passwordhash = sha1($Password);
                    $sql = "SELECT * FROM tbl_users WHERE Email='$UserName' AND Password='$Passwordhash' AND Status='1' ";
                    $result = $db->query($sql);
                    $result->num_rows;
                    if ($result->num_rows <= 0) {
                        $messages['error_invalid'] = "The User Name or Password is invalid!";
                    } else {
                        
                   
                        
                        $row = $result->fetch_assoc();
                        $_SESSION['UserId'] = $row['UserId'];
                        $sql = "SELECT * FROM tbl_users WHERE UserName='$UserName' AND Password='$Password' AND Status='1' ";
                        //left side form value name eka ------ right side database column name eka
                        $_SESSION['Title'] = $row['Title'];
                        $_SESSION['FirstName'] = $row['FirstName'];
                        $_SESSION['LastName'] = $row['LastName'];
                        $_SESSION['UserRole'] = $row['UserRole'];
                        $_SESSION['UserName'] = $row['UserName'];
                        $_SESSION['loggedinTime'] = time();
                        
                        echo "success";
                        print_r($_SESSION);
                         header("Location:index.php");
                    }
                }
            }
            ?>


            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
                <img class="mb-2 logoimage" src="<?= SYSTEM_PATH ?>assets/images/asd.png" style="height:150px; width: 300px; border-radius: 50%;" alt="logo" >
                <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>

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
                    <input type="text" class="form-control" placeholder="name@example.com" name="UserName" id="UserName" value="<?= @$UserName ?>">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control"  placeholder="Password" name="Password" id="Password" value="<?=@$Password ?>">
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                <p class="mt-5 mb-3 text-muted" > <a href="resetpassword.php">Forgot Password </a></p>
            </form>
        </main>
    </body>
</html>
