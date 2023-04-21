<?php ob_start(); ?>
<?php $signin = 'active'; ?>

<?php include '../header.php'; ?>
<?php
include '../menu.php';
?>



<?php
extract($_GET);
echo @$page;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);

    $Email = cleanInput($Email);

    $messages = array();

    if (empty($Email)) {
        $messages['error_email'] = "The username should not be blank!";
    }
    if (empty($Password)) {
        $messages['error_password'] = "The password should not be blank!";
    }

    if (empty($messages)) {
        $db = dbConn();
        $hashPassword = sha1($Password);
        $sql = "SELECT * FROM tbl_customers WHERE Email='$Email' AND Password='$hashPassword' ";
        $result = $db->query($sql);
        $result->num_rows;
        if ($result->num_rows <= 0) {
            $messages['error_invalid'] = "The User Name or Password is invalid!";
        } else {
            $row = $result->fetch_assoc();
            $_SESSION['CustomerId'] = $row['CustomerId'];
            $_SESSION['signedinTime'] = time();
            //left side form value name eka ------ right side database column name eka
            $_SESSION['First_Name'] = $row['FirstName'];
            $_SESSION['Last_Name'] = $row['LastName'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['NIC'] = $row['NIC'];
            $_SESSION['Mobile'] = $row['Mobile'];
            $_SESSION['Address'] = $row['Address'];
            $_SESSION['Address2'] = $row['Address2'];
            $_SESSION['City'] = $row['City'];
            $_SESSION['Title'] = $row['Title'];

            $_SESSION['CustomerImage'] = $row['CustomerImage'];
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Session expired',
                    text: 'Session '
                })
            </script><?php
            if (@$page == 'checkout') {
                header('Location:../processcheckout.php');
            } else {
                header("Location:../index.php");
            }
        }
    }
}
?>



<section class="section-bg">
    <div class="container py-5">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="../assets/images/signin.jpg"
                     class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">


                    <div class="text-danger">  
<?php echo @$messages['error_invalid']; ?>
                    </div>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form1Example13" class="form-control form-control-lg" name="Email" value="<?= @$Email; ?>"/>
                        <label class="form-label" for="form1Example13">Email address</label>
                        <div class="text-danger" >  
<?php echo @$messages['error_email']; ?>
                        </div>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="form1Example23" class="form-control form-control-lg" name="Password" value="<?= @$Password; ?>" />
                        <label class="form-label" for="form1Example23">Password</label> <div class="text-danger"> 
<?php echo @$messages['error_password']; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-around align-items-center mb-4">
                        <!-- Checkbox -->
                        <!--            <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                      <label class="form-check-label" for="form1Example3"> Remember me </label>
                                    </div>-->
                        <a href="resetpassword.php">Forgot password?</a>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0 text-muted"></p>
                    </div>


                    <input type="hidden" name="page" value="<?= $page ?>">
                </form>
            </div>
        </div>
    </div>
</section>
<?php include '../footer.php'; ?>
<?php ob_end_flush(); ?>