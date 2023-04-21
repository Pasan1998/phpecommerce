<?php ob_start(); ?>

<?php $signin = 'active'; ?>

<?php include '../../../header.php'; ?>
<?php include '../../../menu.php';

?>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);

    $ReferenceNumber = cleanInput($ReferenceNumber);

    $messages = array();

    if (empty($ReferenceNumber)) {
        $messages['error_reference'] = "The reference should not be blank!";
    }





    if (empty($messages)) {
        $db = dbConn();

        $sql = "SELECT * FROM tbl_customers WHERE  ReferenceNumber='$ReferenceNumber' ";
        $result = $db->query($sql);
        $result->num_rows;
        if ($result->num_rows <= 0) {
            $messages['error_invalid'] = "The REference number  is invalid!";
        } else {
             
            $row = $result->fetch_assoc();
            
            $_SESSION['verifycustomerid'] = $row['CustomerId'];
            $CustomerId = $row['CustomerId'];
            echo $CustomerId;
            $refe = 1;
            echo $refe;

            echo '<br>';
            print_r($result);
            echo '<br>';
            print_r($CustomerId);
            echo '<br>';
            print_r($refe);
            echo '<br>';
            //left side form value name eka ------ right side database column name eka
            $updateReferenceStatus = "UPDATE tbl_customers SET  ReferenceStatus=$refe WHERE CustomerId='$CustomerId'";
            $db = dbConn();
            $results = $db->query($updateReferenceStatus);
//         
//                        header("Location:../index.php");
//                        echo "success";
//               
        }
    }

    if (empty($messages)) {
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Successfully verfy the email address'
            })
        </script>
        <?php
        ?>
        <?php
    }
    ?>



    <?php
}
?>



<section class="section-bg">
    <div class="container py-5">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <img src="../../../assets/images/signin.jpg"
                     class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">


                    <div class="text-danger">  
<?php echo @$messages['error_invalid']; ?>
                    </div>
                    <!-- Email input -->

                    <!-- Password input -->
                    <div class="form-outline mb-3">

                        <label class="form-label webkit-appearance-reference" for="form1Example23">Enter ReferenceNumber</label> <div class="text-danger"> 
                            <input type="number" id="form1Example23" class="form-control form-control-lg" name="ReferenceNumber" value="<?= @$ReferenceNumber; ?>" />
<?php echo @$messages['error_reference']; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-around align-items-center mb-4">
                        <!-- Checkbox -->
                        <!--            <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                      <label class="form-check-label" for="form1Example3"> Remember me </label>
                                    </div>-->
                        <!--            <a href="#!">Forgot password?</a>-->
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                        <?php
                        if (isset($_SESSION['CustomerId'])) {
                            ?>
                        <button class="btn btn-block btn-primary"><a class="" href="../index.php">Visit To Home</a></button> <?php
                            }
                        ?>
                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0 text-muted"></p>
                    </div>



                </form>
            </div>
        </div>
    </div>
</section>


<?php ob_end_flush(); ?>