<?= $dashboard = 'active'; ?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 text-danger">Manage Accounts Activities</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <!--                    <div class="btn-group me-2">
                                    <a href="<?= SYSTEM_PATH ?>../../products/add.php" class="btn btn-sm btn-outline-secondary">Add user</a>  
                                </div>-->
            <!--                    <div class="btn-group me-2">
                                    <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">View Customers review</a>
                                </div>
                                <div class="btn-group me-2">
                                    <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Create Redeem code</a>
                                </div>
                                <div class="btn-group me-2">
                                    <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">List of Return Products</a>
                                </div>-->

        </div>
    </div>
    <?php
    $sql = "SELECT * FROM tbl_users";
    $db = dbConn();
    $results = $db->query($sql);
    if ($results->num_rows > 0) {
        $numofUsers = $results->num_rows;
    }
    ?>
    <div class="row">
        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">

                <div class="card-body">
                    <h5 class="card-title text-center ">Total Number Of Users</h5>
                    <h5 class="card-text text-center"><?= $numofUsers ?></h5>
                    <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>users/admin/allusers.php"> All  Users</a></div>

                </div>
            </div>
        </div>
        <?php
        $sql = "SELECT * FROM tbl_users WHERE Status='1'";
        $db = dbConn();
        $results = $db->query($sql);
        if ($results->num_rows > 0) {
            $numofActiveUsers = $results->num_rows;
        }
        ?>

        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-center">Total Of Active Users </h5>
                    <h5 class="card-text text-center"><?= $numofActiveUsers ?></h5>
                    <div class="text-center text-decoration-none"><a class="text-decoration-none"  href="<?= SYSTEM_PATH ?>users/admin/activeusers.php"> Active Users</a></div>
                </div>
            </div>
        </div>
        <?php
        $sql = "SELECT * FROM tbl_users WHERE Status='0'";
        $db = dbConn();
        $results = $db->query($sql);
        if ($results->num_rows > 0) {
            $numofdeActiveUsers = $results->num_rows;
        }
        ?>

        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-center">Total Deactive Users </h5>
                    <h5 class="card-text text-center"><?= $numofdeActiveUsers ?></h5>
                    <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>users/admin/deactiveusers.php"> De-active Users</a></div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <?php
        $sql = "SELECT * FROM tbl_customers ";
        $db = dbConn();
        $results = $db->query($sql);
        if ($results->num_rows > 0) {
            $numofcustomer = $results->num_rows;
        }
        ?>
        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-center">Total customers </h5>
                    <h5 class="card-text text-center"><?= $numofcustomer ?></h5>
                    <div class="text-center text-decoration-none"><a class="text-decoration-none"  href="<?= SYSTEM_PATH ?>users/admin/customers/customers.php"> All customers</a></div>
                </div>
            </div>
        </div>
            <?php
            $sql = "SELECT * FROM tbl_customers WHERE Status='1'";
            $db = dbConn();
            $results = $db->query($sql);
            if ($results->num_rows > 0) {
                $numofActivecustomers = $results->num_rows;
            }
            ?>

            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Of Active Users </h5>
                        <h5 class="card-text text-center"><?= $numofActivecustomers ?></h5>
                        <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>users/admin/customers/activecustomers.php"> Active customers</a></div>
                    </div>
                </div>
            </div>
            <?php
            $sql = "SELECT * FROM tbl_customers WHERE Status='0'";
            $db = dbConn();
            $results = $db->query($sql);
            if ($results->num_rows > 0) {
                $numofdeActivecustomers = $results->num_rows;
            }
            ?>

            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Deactive Users </h5>
                        <h5 class="card-text text-center"><?= $numofdeActivecustomers ?></h5>
                        <div class="text-center text-decoration-none"><a class="text-decoration-none" href="<?= SYSTEM_PATH ?>users/admin/customers/deactivecustomers.php"> De-active customers</a></div>
                    </div>
                </div>
            </div>

        </div><!-- comment -->
        <?= $_SESSION['FirstName'] . " " . $_SESSION['LastName'] ?>


</main>