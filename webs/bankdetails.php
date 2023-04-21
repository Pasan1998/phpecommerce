<?php
include 'header.php';
include 'menu.php';
$_SESSION['bankdetails']= 'yes';



?> 
<br>
<main>
    <section id="signup" class="section-bg ">

        <div class="section-title container display-flex  justify-content-center align-content-center" >
            <h2>Bank Details </h2>

        </div>

    </section>


</main>

<?php

 $referencenumbersession = $_SESSION['orderreferencenumber'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    //seperate variables and values from the form
    extract($_POST);
    $messages = array();

    $customerName = cleanInput($customerName);
    $referencenumber = cleanInput($referencenumber);
   

    if (empty($customerName)) {
        $messages['error_Customername'] = "The customer name should not be empty..!";
    }
    if (empty($referencenumber)) {
        $messages['error_reference'] = "The reference number should not be empty..!";
    }

    if ($_FILES['payementslip']['name'] == "") {
        $messages['error_slip'] = "The slip should not be empty..!";
    }


    if ($_FILES['payementslip']['name'] != "") {
        $slipImage = $_FILES['payementslip'];
        $filename = $slipImage['name'];
        $filetmpname = $slipImage['tmp_name'];
        $filesize = $slipImage['size'];
        $fileerror = $slipImage['error'];
        //take file extension
        $file_ext = explode(".", $filename);
        $file_ext = strtolower(end($file_ext));
        //select allowed file type
        $allowed = array("jpg", "jpeg", "png", "pdf");
        //check wether the file type is allowed
        if (in_array($file_ext, $allowed)) {
            if ($fileerror === 0) {
                //file size gives in bytes
                if ($filesize <= 40000000) {
                    //giving appropriate file name. Can be duplicate have to validate using function
                    $file_name_new = uniqid() . $customerName . $referencenumber . '.' . $file_ext;
                    //directing file destination
                    $file_path = "../system/assets/images/orders/" . $file_name_new;
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





    if (!empty($referencenumber)) {
        $sql = "SELECT * FROM tbl_orders WHERE orderID='$referencenumber'";
        $db = dbConn();
        $results = $db->query($sql);
        if ($results->num_rows > 0) {
            
        } else {
            $messages['error_reference'] = "This Reference number is invalid";
        }
    }


    if (empty($messages)) {
        $db = dbConn();
        $AddDate = date('Y-m-d');
        echo $sql = "INSERT INTO bankslips( ordernumber, customername, payementslip, adddate) VALUES ('$referencenumber','$customerName','$file_name_new','$AddDate')";
        $results = $db->query($sql);
    }


    if (empty($messages)) {
        $db = dbConn();
        echo $sqlz = "UPDATE tbl_orders SET bankslip='$file_name_new' WHERE orderID= '$referencenumber'";

        $result = $db->query($sqlz);
    }
}
?>


<section>
    <div class="row">
        <div class="col-md-1" ></div>
        <div class="col-md-4 p-2" style="box-shadow: 5px 5px 5px 5px #888888;">
            <h2>Bank Details </h2> 
            <h5>Name  : Bluetech Electronics</h5>
            <h5>Account Number : 1040 5760 3447 </h5>
            <h5>Bank : Sampath Bank</h5>
            <h5>Branch : Narahenpita</h5>
        </div>
        <div class="col-md-1" ></div>
        <div class="col-md-4 p-2" style="box-shadow: 5px 5px 5px 5px #888888;"> 
            <h2>Bank Details </h2> 
            <form  method="POST"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <div class="form-outline mb-2">

                    <div class="form-outline mb-2">
                        <label class="form-label" for="form1Example13">Customer Name</label>
                        <input type="text" placeholder="" class="form-control form-control-sm" id="last_name" name="customerName" value="<?= @$customerName; ?>">
                        <div class="text-danger"> <?= @$messages['error_Customername']; ?></div>
                    </div>

                    <div class="form-outline mb-2">
                        <label class="form-label" for="form1Example13">Reference number</label>
                        <input type="text" placeholder="" class="form-control form-control-sm" id="last_name" name="referencenumber" value="<?= @$referencenumbersession; ?>">
                        <div class="text-danger"> <?= @$messages['error_reference']; ?></div>
                    </div>


                    <label for="ProductImage" class="form-label">Slip upload</label>
                    <input class="form-control" type="file" id="ProductImage"  name="payementslip">
                    <div class="text-danger"> <?= @$messages['error_slip']; ?></div>
                    <div class="text-danger"> <?= @$messages['file_error']; ?></div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block">Upload</button>
            </form>

        </div>



    </div>

</section>

