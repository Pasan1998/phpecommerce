
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>




<?php
if ($_SERVER ['REQUEST_METHOD'] == "GET") {
    extract($_GET);
    $db = dbConn();
    $sql = "SELECT * FROM tbl_users WHERE UserId='$UserId'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!--<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">User Profile Page</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Add Product</a>

                </div>

            </div>
        </div>
        </section>
            
        <section>
        <div class="row">
            
            <div class="col-3">
                <div class=" d-flex align-items-center justify-content-center about-img">
                
               
                <img src="../assets/images/products/<?= $row['ProductImage'] ?>"  alt="" class="productsingle" data-aos="zoom-in">
                </div>
            </div>
            <div class="col-md-6">
                <h4> <?= $row['FirstName'] ?></h4>
<?php
if ($row['FirstName'] == '') {
    echo '<div class="text-danger"> Active</div>';
} else {
    echo '<div class="text-danger"> De-Active</div>';
}
?>
            </div>
            
            
        </div>
       
      
    </section>

</main>-->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" >
    
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">User Profile Page</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>users/updateUser.php?UserId=<?= $row ['UserId']?>" class="btn btn-sm btn-outline-secondary">Update Profile</a>

                </div>

            </div>
        </div>
    <section class=" bg-dark">

        <main>
            <section class="bodyprofile">
                <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center ">
                                
<!--                                <img src="../assets/images/products/<?= $row['ProductImage']?>"  alt="" class="productsingle" data-aos="zoom-in">-->
                                <img class="usersingle  "  src="../assets/images/users/<?= $row['UserImage'] ?>" data-aos="zoom-in"  style="width: 20rem; height: auto;" alt="">
                                <span class="font-weight-bold"><?= $row['Title'] ?>  <?= $row['FirstName'] ?> <?= $row['LastName'] ?></span><span class="text-black-50">
                                    <?= $row['Email'] ?></span><span> </span></div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">View Profile</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4"><label class="labels"><strong>Title</strong></label><br><?= $row['Title'] ?></div>


                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4"><label class="labels"> <strong>Fisrt Name</strong></label><br><?= $row['FirstName'] ?></div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4"><label class="labels"><strong>Last Name</strong></label><br><?= $row['LastName'] ?></div>
                                </div>


                                <div class="row mt-2">
                                    <div class="col-md-4"><label class="labels"><strong>User Name</strong></label><br><?= $row['Email'] ?></div>
                                </div>
                                <div class="row mt-2">

                                    <div class="col-md-5"><label class="labels"><strong>User Role</strong></label><br><?= $row['UserRole'] ?></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-5"><label class="labels"><strong>Current Status</strong></label><br>  <?php
                                        if ($row['Status'] == '1') {
                                            echo '<div class="text-success"> Active</div>';
                                        } else {
                                            echo '<div class="text-danger"> De-Active</div>';
                                        }
                                        ?></div>
                                </div>
                                <div class="row mt-3">

                                </div>


                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                </div>
                </div>
                </div>




            </section>
        </main>




    </section>
</main>