
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 text-warning">Manage FrontDesk</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Cancellation Payments</a>  
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Return Payments</a>
            </div>
            <!--            <div class="btn-group me-2">
                            <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">List of Return Products</a>
                        </div>-->

        </div>
    </div>

<!--    <div class="row">
        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-titletext-center ">This month Income</h5>
                    <h5 class="card-text text-center">100000.00</h5>

                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-center">This month outcome </h5>
                    <h5 class="card-text text-center">50000.00</h5>

                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-center">Total Income </h5>
                    <h5 class="card-text text-center">50000.00</h5>

                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title text-center">Total Outcome </h5>
                    <h5 class="card-text text-center">50000.00</h5>

                </div>
            </div>
        </div>
    </div>-->

    <?= $_SESSION['FirstName'] . " " . $_SESSION['LastName'] ?>


</main>
<?php include 'footer.php'; ?>