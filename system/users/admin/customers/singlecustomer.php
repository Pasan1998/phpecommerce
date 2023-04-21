<?php include '../../../header.php'; ?>
<?php include '../../../menu.php'; ?>
<link href="singlecustomer.css" rel="stylesheet" type="text/css"/>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">User Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addUser.php" class="btn btn-sm btn-outline-secondary">Add Users</a>                               
            </div>
            <div class="btn-group me-2">
                <a href="addUser.php" class="btn btn-sm btn-outline-secondary">Password reset Request</a>                               
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
        $sql = "SELECT * FROM tbl_users";
        $db = dbConn();
        $result = $db->query($sql);
        
        $totalUsers=$result->num_rows;
        ?>
    <h5><span class="badge bg-primary"><?=$totalUsers ?></span> Users</h5>

    <div class="table-responsive"> 
        <?php
        $sql = "SELECT * FROM tbl_users";
        $db = dbConn();
        $results = $db->query($sql);
        ?>
        <table class="table table-striped table-sm"> 


            <thead>
                <tr>
                    <th>#</th>               
                    <th>Name</th>
                    <th>User Name</th>
                    <th>User Role</th>
<!--                    <th>Status</th>-->

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
                            <td><?= $row['Title'] . " " . $row['FirstName'] . " " . $row['LastName'] ?></td>             
                            <td><?= $row['Email'] ?></td>
                            <td><?= $row['UserRole'] ?></td>
<!--                            <td>
                            <?php
                            if ($row['Status'] == 1) {
                                ?>
                                 <p><a href="<?= SYSTEM_PATH ?>users/admin/status.php?UserId=<?=$row['UserId']?>.&Status=0" class="text-success text-decoration-none">Active</a></p> <?php
                            } else {?>
                                <p><a href="<?= SYSTEM_PATH ?>users/admin/status.php?UserId=<?=$row['UserId']?>.&Status=1" class="text-danger text-decoration-none">Deactive</a></p><?php
                            }
                            ?>
                            </td>-->
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
<?php
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
    extract($_GET);
    $db= dbConn();
     $sql= "SELECT * FROM tbl_customers WHERE CustomerId='$CustomerId'";
     $results= $db->query($sql);
     $row = $results->fetch_assoc();
             
    echo $CustomerId;
    }
?>








