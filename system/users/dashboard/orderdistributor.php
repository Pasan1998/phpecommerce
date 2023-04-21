
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 text-info">Manage Oders Distributing</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">See new order</a>  
            </div>
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Pending  orders to collect  </a>
            </div>
             <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">Complete orders</a>
            </div>
             <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary"></a>
            </div>
<!--            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>products/add.php" class="btn btn-sm btn-outline-secondary">List of Return Products</a>
            </div>-->

        </div>
    </div>

  <div class="row">
            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-titletext-center ">Total Orders</h5>
                        <h5 class="card-text text-center">50</h5>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-center">Total Returned Orders </h5>
                        <h5 class="card-text text-center">5</h5>
                       
                    </div>
                </div>
            </div>
      <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-center">Completed order </h5>
                        <h5 class="card-text text-center">10</h5>
                       
                    </div>
                </div>
            </div>
      <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title text-center">Pending Orders </h5>
                        <h5 class="card-text text-center">7</h5>
                       
                    </div>
                </div>
            </div>
        </div>
    return officer 
    <?= $_SESSION['FirstName'] . " " . $_SESSION['LastName'] ?>


</main>