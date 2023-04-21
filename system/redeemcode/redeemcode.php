<?php $redeemcodepagemenu='active'; ?>
<?php include '../header.php'; ?>
 <?php include '../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Reedeem Codes Management</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>redeemcode/newredeemcode.php" class="btn btn-sm btn-outline-secondary">Add New code</a>

                </div>

            </div>
        </div>
        </section>
            
      <?php
        $sql = "SELECT * FROM tbl_redeemcodes";
        $db = dbConn();
        $result = $db->query($sql);

        $totalcodes = $result->num_rows;
        ?>
        <h5><span class="badge bg-primary"><?= $totalcodes ?></span> Codes</h5>
        <div class="table-responsive">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        
                        <th scope="col">Reedem  Code</th>
                        <th scope="col">Percentage</th>
                        <th scope="col">Reddemcode Status </th>                            
                        
                        <th scope="col">Add Date</th>
                        <th scope="col">Change Status</th>
                         
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td width="50"><?= $i ?></td>
                                
                             
                                <td><?= $row['RedeemCode'] ?></td>
                                <td ><?= $row['Percentage'] ?></td>
                                <td > <?php if ($row['Status']==1) {echo'Active';} else{echo 'Deactive';}?> </td>
                                
                                <td ><?= $row['AddDate'] ?></td>  
                                
                                     <td><?php
                            if ($row['Status'] == 1) {
                                ?>
                                 <p><a href="status.php?RedeemcodeID=<?= $row['RedeemcodeID']?>.&Status=0" class="text-success text-decoration-none">Active</a></p> <?php
                            } else {?>
                                <p><a href="status.php?RedeemcodeID=<?= $row['RedeemcodeID']?>.&Status=1" class="text-danger text-decoration-none">Deactive</a></p><?php
                            }
                            ?>
                            </td>
                                
                                
<!--                                <td width="50"> <a href="productdetails.php?ProductID=<?= $row['ProductID']?>">View</td>-->
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





 <?php include '../footer.php'; ?>