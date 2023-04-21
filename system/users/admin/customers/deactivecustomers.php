<?php include '../../../header.php'; ?>
<?php include '../../../menu.php'; ?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Customer  Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
<!--                <a href="addUser.php" class="btn btn-sm btn-outline-secondary">Add Users</a>                               -->
            </div>
            <div class="btn-group me-2">
<!--                <a href="addUser.php" class="btn btn-sm btn-outline-secondary">Password reset Request</a>                               -->
            </div>
<!--            <div class="btn-group me-2">
                <a href="../products.php" class="btn btn-sm btn-outline-secondary">View Users</a>                               
            </div>-->
<!--            <div class="btn-group me-2">
                <a href="../products.php" class="btn btn-sm btn-outline-secondary">Update Users</a>                               
            </div>-->

        </div>
    </div>
    <?php
        $sql = "SELECT * FROM tbl_customers WHERE Status='0'";
        $db = dbConn();
        $result = $db->query($sql);
        
        $totalUsers=$result->num_rows;
        ?>
    <h5><span class="badge bg-primary"><?=$totalUsers ?></span> Customers </h5>

    <div class="table-responsive"> 
        <?php
        $sql = "SELECT * FROM tbl_customers WHERE Status='0'";
        $db = dbConn();
        $results = $db->query($sql);
        ?>
        <table class="table table-striped table-sm"> 


            <thead>
                <tr>
                    <th>#</th>               
                    
                    <th>Customer Name</th>
                    <th>Cutomer Email</th>
                    <th>Customer NIC</th>
                    <th>Action</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($results->num_rows > 0) {
                    $i=1;
                    while ($row = $results->fetch_assoc()) {
                        ?>
                        <tr>   
                            <td><?=$i?></td>
                            
                            <td><?= $row['FirstName'] . " " . $row['LastName'] ?></td>             
                            <td><?= $row['Email'] ?></td>
                            <td><?= $row['NIC'] ?></td>
                            <td> <a href="singlecustomer.php?CustomerId=<?= $row['CustomerId'] ?>"> View</td>
                                  <td>
                            <?php
                            if ($row['Status'] == 1) {
                                ?>
                                 <div class="text-success text-decoration-none">Active</div><?php
                            } else {?>
                                <div class="text-danger text-decoration-none">De-active</div><?php
                            }
                            ?>
                            </td>
                            
                        </tr>
                        <?php
                        $i++;
                    }
                    
                }
                ?>
            </tbody>

        </table>

    </div>










</main>