<?php $product='active'; ?>

<?php include '../header.php'; ?>
 <?php include '../menu.php'; ?>
<?php
if (($_SESSION['UserRole']) != 'manager') {
    header("Location:../login.php");
}?>

    <?php
if ($_SERVER ['REQUEST_METHOD']== "GET"){
    extract($_GET);
    $db= dbConn();
    $sql= "SELECT * FROM tbl_products WHERE ProductID='$ProductID'";
        $result=$db->query($sql);
        $row=$result->fetch_assoc();
                
    echo $ProductID;
}


?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 ">Single Product Page</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Add Product</a>

                </div>

            </div>
        </div>
        </section>
            
        <section>
        <div class="row">
            
            <div class="col-3 text-center ">
                <div class="bg-warning"> 
                <h1><?= $row['ProductName']?> </h1>
                </div>
               
                    <img src="../assets/images/products/<?= $row['ProductImage']?>"    class="productsingle" data-aos="zoom-in">
                
            </div>
    

            <div class="col-md-6 bg-info">
                <h4> <?= $row['ProductName']?></h4>
                
                <table>
                    <thead>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td>product name </td>
                        </tr>
                    </tbody>
                </table>
                <?php if ($row['ProductStatus']=='1'){
                  echo  '<div class="text-success"> Active</div>';
                }else{
                    echo  '<div class="text-danger"> De-Active</div>';
                    
                    
                } ?>
            </div>
            
            
        </div>
       
      
<!--    to any text convert to lowercase use text-lowercase -->
<!--    to any text convert to uppercase use text-uppercase -->
<!--    to any text convert to first letter uppercase and rest of content lowercase use text-capitalize -->
            <section class="bg-info text-lowercase" >
                ASD
            </section>
</main>





 <?php include '../footer.php'; ?>