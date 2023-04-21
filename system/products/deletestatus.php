<?php ob_start(); ?>
<?php
include '../header.php';
include '../menu.php';


extract($_POST);

$sql = "SELECT * FROM tbl_products WHERE ProductID='$ProductID'";
$db = dbConn();
$result = $db->query($sql);

if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'delete') {

    echo 'deactive' . $ProductID;
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'yes') {
    $status = 2;

    $sql = "UPDATE tbl_products SET ProductStatus=$status WHERE ProductID=$ProductID";
    $db = dbConn();
    $results = $db->query($sql);
    if($result != null){
        $message = "Product selling status changed to Deactive";
       echo"<script>window.alert('$message');</script>";
       header("Location:products.php");
    }
    else{
        $message = "Something went wrong";
       echo"<script>window.alert('$message');</script>";
       header("Location:products.php");
    }
  
}




if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'no') {

    $message = "Product selling status Did not Changed";
       echo"<script>window.alert('$message');</script>";
       header("Location:products.php");
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Manage Products</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Add Product</a>

                </div>
                <!--                <div class="btn-group me-2">
                                    <a href="<?= SYSTEM_PATH ?>products/addproductname.php" class="btn btn-sm btn-outline-secondary">Add Product Name</a>
                
                                </div>-->
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>preorders/addpreorder.php" class="btn btn-sm btn-outline-secondary">Add PreOrder Product</a>

                </div>
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>pie.php" class="btn btn-sm btn-outline-secondary">View Charts</a>

                </div>

            </div>
        </div>
    </section>
    <?php
    $sql = "SELECT * FROM tbl_products WHERE ProductID='$ProductID'";
    $db = dbConn();
    $result = $db->query($sql);
    ?>  
    <?php
    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?= SYSTEM_PATH ?>assets/images/products/<?= $row['ProductImage'] ?>" style="height: 10rem;" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <input type="hidden" name="ProductID" value="<?= $row['ProductID'] ?> ">
                        <button class="btn btn-primary" name="action" type="submit" value="yes"> Yes</button>
                        <button class="btn btn-primary" name="action" type="submit" value="no"> No </button>
                    </form>
                </div>
            </div>

        <?php
        }
    }
    ?>
</main>


<?php ob_end_flush(); ?>