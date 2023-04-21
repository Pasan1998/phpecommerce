<?php $redeemcodepagemenu='active'; ?>
<?php include '../header.php'; ?>
 <?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Add New Reedeem Code</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>redeemcode/redeemcode.php" class="btn btn-sm btn-outline-secondary">View  codes</a>

                </div>

            </div>
        </div>
        </section>
            
       <?php
    //check form submit method
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        //seperate variables and values from the form
        extract($_POST);

        //data clean
        $rCode = cleanInput($rCode);
        $rPercentage = cleanInput($rPercentage);
        $rStatus = cleanInput($rStatus);
     

        //create array variable store validation messages
        $messages = array();

        //validate required fields
        if (empty($rCode)) {
            $messages['error_rcode'] = "The Redeemcode  should not be empty..!";
        }

        if (empty($rPercentage)) {
            $messages['error_rpercentage'] = "The RedeemCode Percentageshould not be empty..!";
        }
        if (empty($rStatus)) {
            $messages['error_rstatus'] = "The Reedeem Code Status should not be empty..!";
        }

        //adavanced validations
        if (!empty($rPercentage)) {
            if ($rPercentage <= 1) {
                $messages['error_rpercentage'] = "The price should not be less than 1!";
            }
        }
        if (!empty($rCode)) {
            $sql = "SELECT * FROM tbl_redeemcodes WHERE RedeemCode='$rCode'";
            $db = dbConn();
            $results = $db->query($sql);
            if ($results->num_rows > 0) {
                $messages['error_rcode'] = "This Reedeem code is already in the database";
            }
        }
  
        if (empty($messages)) {

            $db = dbConn();
            $adduser = $_SESSION['UserId'];
            $adddate = date('Y-m-d');
            echo $sql = "INSERT INTO tbl_redeemcodes(RedeemCode,Percentage,Status,AddUser,AddDate)VALUES ('$rCode','$rPercentage','$rStatus','$adduser','$adddate')";      
          $results = $db->query($sql);
         
        }
    }

    ?>

    <?php echo @$_SESSION['project_title']; ?>

    <form method="post" class="col-md-5" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" >

        <div class="mb-3">
            <label for="product_name" class="form-label">Enter Redeem Code </label>
            <input type="text" class="form-control" id="redeem_code" name="rCode" value="<?= @$rCode; ?>">
             <div class="text-danger"> <?= @$messages['error_rcode']; ?></div>
        </div>

        <div class="mb-3">
            <label for="product_code" class="form-label">Enter percentage Code</label>
            <input type="number" class="form-control" id="redeem_percentage" name="rPercentage" value="<?= @$rPercentage; ?>">
            <div class="text-danger"> <?= @$messages['error_rpercentage']; ?></div>
        </div>
      
        
        <div class="mb-3">
            <label>Select Status</label>
            <select id="redeem_status" name="rStatus" class="form-control">
                <option value="">-Select-</option>
                    <option value="1">Activated</option>
                    <option value="2">De-Activated</option>

            </select>
            <div class="text-danger"> <?= @$messages['error_rstatus']; ?></div>
        </div>

       
       
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>




</main>





 <?php include '../footer.php'; ?>