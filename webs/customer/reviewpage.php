<?php ob_start(); ?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>

<?php

if(!isset($_SESSION['CustomerId'])){
    header("Location:../signin/signin.php");
}

?>


<?php
extract($_POST);

print_r($productid);
//check form submit method
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    //seperate variables and values from the form
    extract($_POST);

    //data clean
    @$productreview = cleanInput($productreview);
    @$productrating = cleanInput($productrating);

    //create array variable store validation messages
    $messages = array();

    //validate required fields
    if (empty($productreview)) {
        $messages['error_productreview'] = "The product name should not be empty..!";
    }

    if (empty($productrating)) {
        $messages['error_productrating'] = "The product Rating should  be Selected..!";
    }
    
     if ((!empty($productrating)) && (!empty($productrating))) {
         
         $idofproduct=$productid;
         $idofcustomer=  $_SESSION['CustomerId'];
         $sql = "SELECT * FROM tbl_reviews WHERE ProductID='$idofproduct' AND CustomerId='$idofcustomer' ";
        $db = dbConn();
        $results = $db->query($sql);
        if ($results->num_rows > 0) {
            $messages['error_dupplicate'] = "You have submitted a revire already";
        }
         
     }
    
    
    

    if (empty($messages)) {
        $db= dbConn();
        $idofproduct=$productid;
        $status=1;
        $idofcustomer=  $_SESSION['CustomerId'];
        $sql= "INSERT INTO tbl_reviews(ProductID, CustomerId, review, reviewrating,status) VALUES ('$idofproduct','$idofcustomer','$productreview','$productrating',$status)";
        print_r($sql);
         $db->query($sql);
         header("Location:reviewsuccess.php");
         
        
    }
}
?>
<br>
<br>

<br>
<section id="acv" class="section  ">
    <div class="section-title" >
        <h2 class="">Add a review</h2>
    </div>
</section>

<section class="bg-light " >
    <div class='row container'>
        <div class='col-md-6'>
<?php
$sql = "SELECT * FROM tbl_products WHERE ProductID='$productid'";
$db = dbConn();
$result = $db->query($sql);
?>
            <?php
            if ($result->num_rows > 0) {
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div><img style="width: 40rem;" src="../../system/assets/images/products/<?= $row['ProductImage'] ?>"></div>
                    <?php
                }
            }
            ?>

        </div>
        <div class='col-md-6'>
            <div class="col-md-10">
            <?php
            $sql = "SELECT * FROM tbl_products WHERE ProductID='$productid'";
            $db = dbConn();
            $result = $db->query($sql);
            ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <?php
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>

                            <div class="mb-12">
                                <label for="product_code" class="form-label">Product Name</label>

                                <div> <h3> <?= $row['ProductName'] ?> </h3></div>
                                <div class="text-danger"> <?= @$messages['error_dupplicate']; ?></div>
                            </div>


                            <div class="mb-6">
                                <label for="product_code" class="form-label">Product Category</label>
                                <div> <h3> <?= $row['ProductCategory'] ?> </h3></div>

                            </div>
                            <input type='hidden' name='productid' value='<?= $row['ProductID'] ?>'>
        <?php
    }
}
?>

                    <div class="mb-6">
                        <label for="product_description" class="form-label">Enter Product Description</label>
                        <textarea onkeyup="countWords(this);"  class="form-control" id="product_description" rows="5" name="productreview"><?= @$productreview; ?></textarea>
                        <span id="words-counter"></span>
                        <script>
                            function countWords(self) {
                                var spaces = self.value.match(/\S+/g);
                                var words = spaces ? spaces.length : 0;

                                document.getElementById("words-counter").innerHTML = words + " words";
                            }
                        </script>

                        <div class="text-danger"> <?= @$messages['error_productreview']; ?></div>

                    </div>


                    <div class="mb-3 p-2">
                        <label for="product_code" class="form-label">Select Rating</label>
                        <select id="mYear" name="productrating" class="form-control">
                            <option value="">-Select-</option>
<?php for ($i = 1; $i <= 5; $i++) { ?>
                                <option value="<?= $i; ?>" <?php
    if (@$productrating == $i) {
        echo "selected";
    }
    ?>><?= $i; ?></option>
                            <?php } ?>


                        </select>
                        <div class="text-danger"> <?= @$messages['error_productrating']; ?></div>
                    </div>
                    <input type='hidden' name='CustomerId' value='<?= $_SESSION['CustomerId'] ?>'>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <div>



                </div>
            </div>
            </section>
<?php print_r($_SESSION); ?>
            <br><!-- comment -->
<?php print_r(@$productreview); ?>
<?php print_r(@$productrating); ?>
            <?php print_r(@$$customerid); ?>
<?phpob_end_flush();?>